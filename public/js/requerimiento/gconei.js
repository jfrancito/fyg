$(document).ready(function(){

    var carpeta = $("#carpeta").val();


    $(".gconei").on('change','.aestado_id', function() {

        event.preventDefault();
        var aestado_id       =   $('.aestado_id').val();
                
        if(aestado_id == 'CEES00000008'){
            $( ".bajaextorno" ).addClass( "mostrar" );
            $( ".bajaextorno" ).removeClass( "ocultar" );
            $( ".iaprobado" ).addClass( "ocultar" );
            $( ".iaprobado" ).removeClass( "mostrar" );
        }else{


            if(aestado_id == 'CEES00000007'){
                $( ".bajaextorno" ).addClass( "ocultar" );
                $( ".bajaextorno" ).removeClass( "mostrar" );
                $( ".iaprobado" ).addClass( "ocultar" );
                $( ".iaprobado" ).removeClass( "mostrar" );
            }else{
                $( ".bajaextorno" ).addClass( "ocultar" );
                $( ".bajaextorno" ).removeClass( "mostrar" );
                $( ".iaprobado" ).addClass( "mostrar" );
                $( ".iaprobado" ).removeClass( "ocultar" );
            }

        }

    });






});