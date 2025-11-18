$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $(".reportecertificado").on('click','.buscarcertificado', function() {

        event.preventDefault();
        var periodo_id              =   $('#periodo_id').val();
        var periodofin_id              =   $('#periodofin_id').val();

        var procedencia_id          =   $('#procedencia_id').val();
        var idopcion                =   $('#idopcion').val();
        var _token                  =   $('#token').val();
        var estado_id               =   $('#estado_id').val();


        //validacioones
        if(periodo_id ==''){ alerterrorajax("Seleccione un Periodo Inicio."); return false;}
        if(periodofin_id ==''){ alerterrorajax("Seleccione un Periodo Fin."); return false;}
        if(procedencia_id ==''){ alerterrorajax("Seleccione un Procedencia."); return false;}
        if(estado_id ==''){ alerterrorajax("Seleccione un Estado."); return false;}


        data            =   {
                                _token                  : _token,
                                periodo_id              : periodo_id,
                                periodofin_id           : periodofin_id,
                                estado_id               : estado_id,                      
                                procedencia_id          : procedencia_id,
                                idopcion                : idopcion,
                            };
        ajax_normal(data,"/ajax-lista-instituciones-certificado");

    });

    $(".reportesincertificado").on('click','.buscarcertificado', function() {

        event.preventDefault();
        var periodo_id              =   $('#periodo_id').val();
        var procedencia_id          =   $('#procedencia_id').val();
        var idopcion                =   $('#idopcion').val();
        var _token                  =   $('#token').val();
        //validacioones
        if(periodo_id ==''){ alerterrorajax("Seleccione un Periodo Inicio."); return false;}
        if(procedencia_id ==''){ alerterrorajax("Seleccione un Procedencia."); return false;}

        data            =   {
                                _token                  : _token,
                                periodo_id              : periodo_id,                
                                procedencia_id          : procedencia_id,
                                idopcion                : idopcion,
                            };
        ajax_normal(data,"/ajax-lista-instituciones-sin-certificado");

    });



});