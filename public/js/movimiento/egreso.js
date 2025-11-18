$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $(".egreso").on('keyup','.seriekeypress', function() {
        var valueserie              =   $(this).val().toUpperCase();
        $(this).val(valueserie);

    });

    $(".egreso").on('keyup','#numero , #dni , #numero_deposito_bancario', function() {
        var valuennumero              =   $(this).val().replace(/\D/g, '');
        $(this).val(valuennumero);

    });

    $(".egreso").on('focusout','#numero', function() {

        var valuennumero              =   $(this).val().toString().padStart(8,0);
        $(this).val(valuennumero);

    });    

    $(".formegreso").on('change','#tipo_gasto_id', function() {

        var _token                  =   $('#token').val();

        var tipogasto               =   $('#tipo_gasto_id').select2('data');
        var tipo_gasto_id           =   $('#tipo_gasto_id').val();
        
        if(tipogasto)
        {
            tipo_gasto_id   =   tipogasto[0].id;
            if(tipo_gasto_id=='TGEG00000001'){
                $('.formegreso .datosegreso').show(200);
            }
            else{
                $('.formegreso .datosegreso').hide(200);             
            }
            
            debugger;
            $.ajax({
                    type    :   "POST",
                    url     :   carpeta+"/ajax-cargar-tipo-concepto",
                    data    :   {
                                    _token  : _token,
                                    tipo_gasto_id : tipo_gasto_id,
                                },
                    success: function (data) {
                        $(".formegreso .tipoconcepto").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
            });
        }              
    });

    $('.egreso').on('change','#fecha_comprobante', function() {
        var _token                  =   $('#token').val();
        debugger;
        var fecha_comprobante = $('#fecha_comprobante').val();        
        
        $.ajax({
                    type    :   "POST",
                    url     :   carpeta+"/ajax-cargar-trimestre-egreso",
                    data    :   {
                                    _token  : _token,
                                    fecha_comprobante : fecha_comprobante,
                                },
                    success: function (data) {
                        $(".egreso .trimestre").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
            });
    });

    $(".egreso").on('click','.btn_buscar_dni', function(e) {
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

    $(".egreso").on('change','#tipo_documento_id', function() {
        $('#dni').val('');
        $('#razon_social').val('');
    });

    $(".egreso").on('click','.btn-agregar-egreso , .btn-guardar-egreso', function() {
        event.preventDefault()
       
        var serie                   =   $('#serie').val();
        var numero                  =   $('#numero').val();        
        var tipo_comprobante_id     =   $('#tipo_comprobante_id').val();        
        var dni                     =   $('#dni').val();        
        var registro_id             =   $('#registro_id').val();     
        var tipo_compra_id          =   $('#tipo_compra_id').val();     
        var accion                  =   'E';        
        var formclass               =   'formegreso';

        var _token                  =   $('#token').val();        

        if ($('.'+formclass+' .datosegreso').is(':visible')) {
            if(tipo_compra_id ==''){ alerterrorajax("Seleccione un Tipo de Compra."); return false;}
        }
        
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
                
                cerrarcargando();
                if(data == '1'){                    
                    alerterrorajax('El Numero de Comprobante ya fue registrado para este Proveedor.');
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
});