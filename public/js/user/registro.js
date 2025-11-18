    
$(document).ready(function(){

    var carpeta = $("#carpeta").val();



      $('input[name="accion"]').on('change', function() {

        var valorSeleccionado = $('input[name="accion"]:checked').val();


        //editar
        if (valorSeleccionado == '1') {
          // Remover readonly de los input que desees
          $('input[name="dni"]').removeAttr('readonly');
          $('input[name="nombre"]').removeAttr('readonly');
          $('input[name="lblcelular"]').removeAttr('readonly');
          $('input[name="lblemail"]').removeAttr('readonly');
          $('input[name="lblconfirmaremail"]').removeAttr('readonly');
          //$('select[name="tipo_institucion"]').removeAttr('disabled');
          $('.inputresolucion').removeClass('ocultar');
          $('#file-es').attr('required', 'required');

        } else {
          // Agregar readonly nuevamente si se selecciona la opción '0'
          $('input[name="dni"]').attr('readonly', 'readonly');
          $('input[name="nombre"]').attr('readonly', 'readonly');
          $('input[name="lblcelular"]').attr('readonly', 'readonly');
          $('input[name="lblemail"]').attr('readonly', 'readonly');
          $('input[name="lblconfirmaremail"]').attr('readonly', 'readonly');
          //$('select[name="tipo_institucion"]').attr('disabled', 'disabled');
          $('.inputresolucion').addClass('ocultar');
          $('.buscarruc').trigger('click');
          $('#file-es').removeAttr('required');
        }


      });




    $(".registroruc").on('click','.btn_buscar_dni_oi', function(e) {
        event.preventDefault();

        var dni                     =   $('#dni').val();
        var _token                  =   $('#token').val();
        debugger;

        abrircargando();
        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-buscar-dni-ugel-libre",
            data    :   {
                            _token          : _token,
                            dni             : dni
                        },
            success: function (data){
                cerrarcargando();

                debugger;

                var array        = $.parseJSON(data);
                var nombrea      = array[1];
                var apellidopa   = array[2];
                var apellidoma   = array[3];
                if(nombrea == null){
                    $('#nombre').val('');
                }else{
                    $('#nombre').val(apellidopa+' '+apellidoma+' '+nombrea);
                }
            },
            error: function (data) {
                cerrarcargando();
                error500(data);
            }
        });

    });


    $(".registroruc").on('click','.buscarruc', function(e) {

        var _token          = $('#token').val();
        var codigolocal     = $('#codigolocal').val();
        $.ajax({

            type    :   "POST",
            url     :   carpeta+"/ajax-buscar-proveedor",
            data    :   {
                            _token          : _token,
                            codigolocal             : codigolocal,
                        },
            success: function (data) {
                debugger;
                $('.encontro_proveedor').html(data); 
                debugger;                
            },
            error: function (data) {
                if(data.status = 500){
                    var contenido = $(data.responseText);
                    alerterror505ajax($(contenido).find('.trace-message').html()); 
                    console.log($(contenido).find('.trace-message').html());     
                }
            }
        });


        $.ajax({

            type    :   "POST",
            url     :   carpeta+"/ajax-buscar-director",
            data    :   {
                            _token          : _token,
                            codigolocal             : codigolocal,
                        },
            success: function (data) {
                $('.encontro_director').html(data);                 
            },
            error: function (data) {
                if(data.status = 500){
                    var contenido = $(data.responseText);
                    alerterror505ajax($(contenido).find('.trace-message').html()); 
                    console.log($(contenido).find('.trace-message').html());     
                }
            }
        });




    });

    $(".registroruc").on('click','.btn-registrate', function(e) {

        event.preventDefault();
        var idactivo       =   $('#idactivo').val();
        var mensaje       =   $('.mensaje').html();
        debugger;
        if(idactivo == 0){ alerterrorajax(mensaje); return false;}
        return true;

    });






});


