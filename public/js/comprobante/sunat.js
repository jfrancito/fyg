$(document).ready(function(){
    var carpeta = $("#carpeta").val();

    $(".cfedocumento").on('click','.buscardocumento', function() {

        event.preventDefault();

        var empresa_id           =   $('#empresa_id').val();
        var periodo              =   $('#periodo').val();
        var idopcion             =   $('#idopcion').val();
        var _token               =   $('#token').val();

        //validacioones
        if(empresa_id ==''){ alerterrorajax("Seleccione una empresa."); return false;}
        if(periodo ==''){ alerterrorajax("Seleccione un periodo."); return false;}

        data            =   {
                                _token                  : _token,
                                empresa_id              : empresa_id,
                                periodo                 : periodo,
                                idopcion                : idopcion
                            };
        ajax_normal(data,"/ajax-buscar-documento-fe");

    });

    $(".cfedocumento").on('click','#descargarcomprobantemasivopdf', function() {

        var empresa_id           =   $('#empresa_id').val();
        var periodo              =   $('#periodo').val();
        var idopcion             =   $('#idopcion').val();
        var _token               =   $('#token').val();

        //validacioones
        if(empresa_id ==''){ alerterrorajax("Seleccione una empresa."); return false;}
        if(periodo ==''){ alerterrorajax("Seleccione un periodo."); return false;}

        href = $(this).attr('data-href')+'/'+empresa_id+'/'+periodo+'/'+idopcion;
        $(this).prop('href', href);
        return true;


    });



});




