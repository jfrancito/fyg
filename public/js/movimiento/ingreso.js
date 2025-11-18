$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $(".ingreso").on('keyup','.seriekeypress', function() {
        var valueserie              =   $(this).val().toUpperCase();
        $(this).val(valueserie);

    });

    $(".ingreso").on('keyup','#numero , #dni , #numero_deposito_bancario', function() {
        var valuennumero              =   $(this).val().replace(/\D/g, '');
        $(this).val(valuennumero);

    });

    $(".ingreso").on('focusout','#numero', function() {

        var valuennumero              =   $(this).val().toString().padStart(8,0);
        $(this).val(valuennumero);

    });

    $('.ingreso').on('change','#fecha_comprobante', function() {
        var _token                  =   $('#token').val();
        debugger;
        var fecha_comprobante = $('#fecha_comprobante').val();        
        
        $.ajax({
                    type    :   "POST",
                    url     :   carpeta+"/ajax-cargar-trimestre-ingreso",
                    data    :   {
                                    _token  : _token,
                                    fecha_comprobante : fecha_comprobante,
                                },
                    success: function (data) {
                        $(".ingreso .trimestre").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
            });
    });

    $(".ingreso").on('click','.btn_buscar_dni', function(e) {
        event.preventDefault();

        
        var data_dni_m              =   $(this).attr('data_dni_m');
        var data_nombre_m           =   $(this).attr('data_nombre_m');
        var dni                     =   $('#dni').val();
        var tipodoc                 =   $('#tipo_documento_id').select2('data');
        var tipodoc_text            =   tipodoc[0].text;
        var tipodoc_id              =   tipodoc[0].id;
        
        var _token                  =   $('#token').val();

        if(tipodoc_id ==''){ alerterrorajax("Seleccione un Tipo de Documento."); return false;}        

        if(tipodoc_text == 'DNI'){
            actualizar_ajax_dni(_token,carpeta,dni,data_nombre_m);
        }else{
            actualizar_ajax_ruc(_token,carpeta,dni,data_nombre_m);
        }
    });

    function actualizar_ajax_dni(_token,carpeta,data_dni_m,data_nombre_m){

        abrircargando();
        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-buscar-dni-ugel",
            data    :   {
                            _token          : _token,
                            dni             : data_dni_m
                        },
            success: function (data){
                cerrarcargando();
                var array        = $.parseJSON(data);

                debugger;

                var nombrea      = array[1];
                var apellidopa   = array[2];
                var apellidoma   = array[3];

                if(nombrea == null){
                    alerterrorajax('DNI NO EXISTE');
                    $('#'+data_nombre_m).val('');
                }else{
                    $('#'+data_nombre_m).val(nombrea+' '+apellidopa+' '+apellidoma);
                }
            },
            error: function (data) {
                cerrarcargando();
                error500(data);
            }
        });
    }

    function actualizar_ajax_ruc(_token,carpeta,data_dni_m,data_nombre_m){

        abrircargando();
        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-buscar-ruc-ugel",
            data    :   {
                            _token          : _token,
                            dni             : data_dni_m
                        },
            success: function (data){
                cerrarcargando();
                debugger;
                if(data == ""){
                    alerterrorajax('RUC NO EXISTE');
                    $('#'+data_nombre_m).val('');
                }else{
                    $('#'+data_nombre_m).val(data);
                }
            },
            error: function (data) {
                cerrarcargando();
                error500(data);
            }
        });
    }   

    $(".ingreso").on('change','#tipo_documento_id', function() {
        $('#dni').val('');
        $('#razon_social').val('');
    });    

    $(".ingreso").on('change','#contrato_id', function() {

        var _token                  =   $('#token').val();

        var contrato                =   $('#contrato_id').select2('data');
        var contrato_id             =   $('#contrato_id').val();
        
        if(contrato)
        {
            contrato_id   =   contrato[0].id;
            if(contrato_id=='1'){
                $('.ingreso .ajaxcontrato').show(200);
                $('.ingreso .ajaxcontratoanterior').hide(200);                             
            }else if(contrato_id=='3'){
                $('.ingreso .ajaxcontrato').hide(200);             
                $('.ingreso .ajaxcontratoanterior').show(200);                
            }else{
                $('.ingreso .ajaxcontrato').hide(200);             
                $('.ingreso .ajaxcontratoanterior').hide(200);                             
            }           
        }              
    });

    $(".ingreso").on('click','.btn-agregar-ingreso , .btn-guardar-ingreso', function() {
        event.preventDefault()
       
        var serie                   =   $('#serie').val();
        var numero                  =   $('#numero').val();        
        var tipo_comprobante_id     =   $('#tipo_comprobante_id').val();        
        var dni                     =   $('#dni').val();        
        var registro_id             =   $('#registro_id').val();     
        var accion                  =   'I';        
        var formclass               =   'formingreso';

        var _token                  =   $('#token').val();
        debugger;
        abrircargando();
        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-comparar-serie-numero",
            data    :   {
                            _token                  : _token,
                            serie                   : serie,
                            numero                  : numero,
                            tipo_comprobante_id     : tipo_comprobante_id,
                            dni                     : dni,
                            registro_id             : registro_id,
                            accion                  : accion
                        },
            success: function (data){                            
                debugger;
                cerrarcargando();
                if(data == '1'){                    
                    alerterrorajax('El Numero de Comprobante ya fue registrado para esta Institucion.');
                    return false;
                }else{                    
                    $('.'+formclass).submit();
                    return true;
                    
                }
            },
            error: function (data) {                                
                cerrarcargando();
                error500(data);
            }
        });
    });   

    $(".ingreso").on('click','.btn_buscar_contrato', function() {
        event.preventDefault();
        var _token                  =   $('#token').val();
        var dni                     =   $('#dni').val();        
        var idopcion                =   $('#idopcion').val();        
        debugger;
        if(dni ==''){ alerterrorajax("Ingrese un Numero de Documento."); return false;}        
        

        data                        =   {
                                            _token       : _token,
                                            idopcion     : idopcion,                                            
                                            dni          : dni                                            
                                        };
                              
        ajax_modal(data,"/ajax-modal-contrato-anterior",
                  "modal-contrato-anterior","modal-contrato-anterior-container");

    });

    // Evento para marcar un solo checkbox dentro del modal
    $(".ingreso").on('click', 'input[type="checkbox"]', function() {
        // Desmarcar todos los checkboxes excepto el que está siendo marcado
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });


    $(".ingreso").on('click','.btn_asignar_contrato_ant', function(e) {        
        event.preventDefault();
        debugger;
        var contrato_anterior_id        = '';
        var contrato_anterior_nombre    = '';
        $(".listatabla tr").each(function(){
            check                       = $(this).find('input');
            contrato_anterior_id        = $(this).find('input').attr('id');
            contrato_anterior_nombre    = $(this).find('input').attr('data-nombre-file');

            if($(check).is(':checked')){
                $('#contrato_anterior').val(contrato_anterior_nombre);
                $('#contrato_anterior_id').val(contrato_anterior_id);
                $('#modal-contrato-anterior').niftyModal('hide');
            }            
        });
        
    });


});