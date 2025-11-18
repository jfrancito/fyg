$(document).ready(function(){

    var carpeta = $("#carpeta").val();


    $(".certificado").on('click','.btn_asignar_periodo', function(e) {

        event.preventDefault();

        var periodo_id              =   $('#periodo_id').val(); 
        var periodofin_id           =   $('#periodofin_id').val();
        var indb                    =   $('#indb').val();
        var checkconei              =   $('#checkconei').prop("checked");


        if(periodo_id ==''){ alerterrorajax("Seleccione un periodo Inicial."); return false;}

        if(checkconei==false){
            if(periodofin_id ==''){ alerterrorajax("Seleccione un periodo Final."); return false;}
        }

        if(indb =='0'){ alerterrorajax("Hay errores en la seleccion de periodos."); return false;}

        var periodo_nombre = $('#periodo_id option:selected').text();
        var periodofin_nombre = $('#periodofin_id option:selected').text();
        var nombre_periodo = periodo_nombre + '-' + periodofin_nombre;
        if(checkconei==true){
             nombre_periodo = periodo_nombre;
        }

        $('#periodo_inicio_id').val(periodo_id);
        $('#periodo_fin_id').val(periodofin_id);
        $('#periodos_nombres').val(nombre_periodo);
        $('#modal-certificado').niftyModal('hide');


    });


    $(".certificado").on('click','#checkconei', function(e) {

        var checkconei              =   $(this).prop("checked");

        $("#periodo_id").select2().val("");
        $("#periodo_id").select2().val("");
        //alert(checkconei);

    });




    $(".certificado").on('click','.modal-registro', function() {
        event.preventDefault();
        var _token                  =   $('#token').val();
        var institucion_id          =   $('#institucion_id').val();
        var procedencia_id          =   $('#procedencia_id').val();

        if(institucion_id ==''){ alerterrorajax("Seleccione una institucion."); return false;}
        if(procedencia_id ==''){ alerterrorajax("Seleccione una procedencia."); return false;}
        //debugger;

        data                        =   {
                                            _token                  : _token,
                                            institucion_id          : institucion_id,
                                            procedencia_id          : procedencia_id
                                        };
                              
        ajax_modal(data,"/ajax-modal-periodo-xinstitucion-xprocedencia",
                  "modal-certificado","modal-certificado-container");

    });


    $(".certificado").on('change','.buscar_periodo_sgt', function() {

        event.preventDefault();
        var periodo_id           =   $('#periodo_id').val();
        var periodofin_id        =   $('#periodofin_id').val();
        var checkconei           =   $('#checkconei').prop("checked");

        var institucion_id          =   $('#institucion_id').val();
        var procedencia_id          =   $('#procedencia_id').val();

        var _token               =   $('#token').val();
        //validacioones
        if(periodo_id ==''){ alerterrorajax("Seleccione periodo inicial."); return false;}


        data            =   {
                                _token              : _token,
                                periodo_id          : periodo_id,
                                periodofin_id       : periodofin_id,
                                institucion_id          : institucion_id,
                                procedencia_id       : procedencia_id,
                                checkconei       : checkconei,

                            };

        ajax_normal_section(data,"/ajax-periodo-fin-certificado","msj_consulta_periodo")                    

    });




    $(".certificado").on('change','#institucion_id_antes', function() {

        event.preventDefault();
        var institucion_id       =   $('#institucion_id').val();
        var procedencia_id       =   $('#procedencia_id').val();

        var _token               =   $('#token').val();
        //validacioones
        if(institucion_id ==''){ alerterrorajax("Seleccione una institucion."); return false;}

        data            =   {
                                _token              : _token,
                                institucion_id      : institucion_id,
                                procedencia_id      : procedencia_id,
                            };

        ajax_normal_combo(data,"/ajax-combo-periodo-xinstitucion","ajax_periodo")                    

    });


    $(".certificado").on('click','.btn-guardar-certificado', function() {

        var activo       =   $('#activo').val();
        var descripcion       =   $('#bjamsj').val();
        if(activo == 'CEES00000003'){
            if(descripcion == ''){ alerterrorajax("Ingrese un Motivo de Baja."); return false;}
        }            
        return true;
        

    });

    $(".certificado").on('click','.btn-agregar-certificado', function() {

        var estado_id         =   $('#estado_id').val();
        var descripcion       =   $('#descripcion').val();
        var nro_tramite       =   $('#nro_tramite').val();
        var certificado       =   $('#certificado');

        if(estado_id == 'CEES00000001'){
            console.log(filesSelected);
            if (!filesSelected) {alerterrorajax("Ingrese un Certificado.");return false;}
        }
        // else{
        //     if(descripcion == ''){ alerterrorajax("Ingrese un Motivo de obseravion."); return false;}
        //     if(nro_tramite == ''){ alerterrorajax("Ingrese un Nro de Tramite."); return false;}
        // }            

        abrircargando();
        return true;
        
    });






    $(".certificado").on('change','.aestado_id', function() {

        event.preventDefault();
        var aestado_id       =   $('.aestado_id').val();
                
        if(aestado_id == 'CEES00000008'){

            $( ".bajaextorno" ).addClass( "mostrar" );
            $( ".bajaextorno" ).removeClass( "ocultar" );
            $( ".iaprobado" ).addClass( "ocultar" );
            $( ".iaprobado" ).removeClass( "mostrar" );


        }else{
            $( ".bajaextorno" ).addClass( "ocultar" );
            $( ".bajaextorno" ).removeClass( "mostrar" );

           $( ".iaprobado" ).addClass( "mostrar" );
            $( ".iaprobado" ).removeClass( "ocultar" );

        }



    });


    $(".certificado").on('change','#activo', function() {

        event.preventDefault();
        var activo       =   $('#activo').val();
                

        if(activo == 'CEES00000003'){
            $( ".bajaextorno" ).addClass( "mostrar" );
            $( ".bajaextorno" ).removeClass( "ocultar" );
        }else{
            $( ".bajaextorno" ).addClass( "ocultar" );
            $( ".bajaextorno" ).removeClass( "mostrar" );
        }



    });

    $(".certificado").on('change','#procedencia_id_antes', function() {

        event.preventDefault();
        var procedencia_id       =   $('#procedencia_id').val();
        var institucion_id       =   $('#institucion_id').val();

        var _token               =   $('#token').val();
        //validacioones

        if(procedencia_id ==''){ alerterrorajax("Seleccione una procedencia."); return false;}

        data            =   {
                                _token              : _token,
                                institucion_id      : institucion_id,
                                procedencia_id      : procedencia_id,
                            };

        ajax_normal_combo(data,"/ajax-combo-periodo-xinstitucion","ajax_periodo")                    

    });






});