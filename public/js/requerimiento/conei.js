$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
      if ($(this).parent().hasClass("disabled")) {
        e.preventDefault();
        return false;
      }
    });



    // $(".conei").on('click','.btn_guardar_editar', function(e) {

    //     event.preventDefault();
    //     var _token                  =   $('#token').val();
    //     var dni                     =   $('#dni').val();
    //     var nombres                 =   $('#nombres').val();
    //     var telefono                =   $('#telefono').val();
    //     var correo                  =   $('#correo').val();
    //     if(dni ==''){ alerterrorajax("Ingrese un DNI."); return false;}
    //     if(nombres ==''){ alerterrorajax("Ingrese un nombre."); return false;}
    //     if(telefono ==''){ alerterrorajax("Ingrese un telefono."); return false;}
    //     if(correo ==''){ alerterrorajax("Ingrese un correo."); return false;}
    //     var director_id             =   $('#director_id').val();
    //     var procedencia_id          =   $('#procedencia_id').val();
    //     data            =   {
    //                             _token              : _token,
    //                             dni                 : dni,
    //                             nombres             : nombres,
    //                             telefono            : telefono,
    //                             correo              : correo,
    //                             director_id         : director_id,
    //                             procedencia_id      : procedencia_id,
    //                         };

    //     ajax_normal_section(data,"/ajax-guardar-registro-director","ajax_input_director") 
    //     $('#modal-conei-apafa').niftyModal('hide');

    // });


    $(".conei").on('click','.btn_guardar_editar', function(e) {

        event.preventDefault();
        var _token                  =   $('#token').val();
        var dni                     =   $('#dni').val();
        var nombres                 =   $('#nombres').val();
        var telefono                =   $('#telefono').val();
        var correo                  =   $('#correo').val();
        if(dni ==''){ alerterrorajax("Ingrese un DNI."); return false;}
        if(nombres ==''){ alerterrorajax("Ingrese un nombre."); return false;}
        if(telefono ==''){ alerterrorajax("Ingrese un telefono."); return false;}
        if(correo ==''){ alerterrorajax("Ingrese un correo."); return false;}
        var director_id             =   $('#director_id').val();
        var procedencia_id          =   $('#procedencia_id').val();
        var array_detalle_producto  =   $('#array_detalle_producto').val();


        data            =   {
                                _token              : _token,
                                dni                 : dni,
                                nombres             : nombres,
                                telefono            : telefono,
                                correo              : correo,
                                director_id         : director_id,
                                procedencia_id      : procedencia_id,
                                array_detalle_producto      : array_detalle_producto,

                            };

        ajax_normal_section(data,"/ajax-guardar-registro-director-nuevo","listaajaxoi") 
        $('#modal-conei-apafa').niftyModal('hide');

    });




    $(".conei").on('click','.btn_asignar_nombre_oi', function(e) {

        event.preventDefault();
        var tdg                     =   $('#tdgoi').val();
        var tdgtexto                =   $('select[name="tdgoi"] option:selected').text();

        var representante_id        =   $('#representante_id').val();
        var representante_txt       =   $('select[name="representante_id"] option:selected').text();

        var codigo_modular_id       =   '';
        var niveltexto              =   '';
        var swnivel                 =   0;
        if(representante_id == 'ESRP00000002'){
            codigo_modular_id       =   $('#codigo_modular_id').val();
            niveltexto              =   $('select[name="codigo_modular_id"] option:selected').text();
            //validar que el nivel no ya seleccionado
            swnivel = validar_no_existe_nivel(codigo_modular_id,representante_id);

        }
        var documentog              =   $('#documentogoi').val();
        var swdni                   =   0;
        swdni = validar_dni_repetido(documentog);




        var nombresg                =   $('#nombresgoi').val();
        var cargo                   =   $('#cargo').val();
        var _token                  =   $('#token').val();
        var array_detalle_producto  =   $('#array_detalle_producto').val();


        if(swdni ==1){ alerterrorajax("Existe ya este documento registrado"); return false;}
        if(swnivel ==1){ alerterrorajax("Existe ya un registro con el mismo nivel"); return false;}
        if(representante_id ==''){ alerterrorajax("Seleccione un representante."); return false;}
        if(tdg ==''){ alerterrorajax("Seleccione un tipo documento."); return false;}
        if(documentog ==''){ alerterrorajax("Ingrese un documento de identidad."); return false;}
        if(nombresg ==''){ alerterrorajax("Ingrese un nombre."); return false;}
        if(representante_id=='ESRP00000009'){
            if(cargo ==''){ alerterrorajax("Seleccione un cargo."); return false;}
        }
        actualizar_ajax_oi(_token,carpeta,tdg,tdgtexto,documentog,nombresg,
                            cargo,array_detalle_producto,representante_id,representante_txt,codigo_modular_id,niveltexto
                          );

        $('#modal-conei-apafa').niftyModal('hide');

    });


    $(".conei").on('change','#representante_id', function() {
        event.preventDefault();
        var representante_id           =   $('#representante_id').val();

        if(representante_id=='ESRP00000009'){
            $(".invitados").removeClass("ocultar");
        }else{
            $(".invitados").addClass("ocultar");
        }

        if(representante_id=='ESRP00000002' || representante_id=='ESRP00000003'){
            $(".nivel").removeClass("ocultar");
        }else{
            $(".nivel").addClass("ocultar");
        }

    });



    $(".conei").on('change','.buscar_periodo_sgt', function() {

        event.preventDefault();


        var periodo_id           =   $('#periodo_id').val();
        var periodofin_id        =   $('#periodofin_id').val();
        var checkconei           =   $('#checkconei').prop("checked");
        var institucion_id       =   $('#institucion_id').val();
        var procedencia_id       =   $('#procedencia_id').val();
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


    $(".conei").on('click','#checkconei', function() {

        $('#periodo_id').val('').trigger('change.select2');
        $('#periodofin_id').val('').trigger('change.select2');
    });


    $(".conei").on('click','.editardirector', function() {

        event.preventDefault();
        var _token                  =   $('#token').val();
        var director_id             =   $('#director_id').val();
        var procedencia_id          =   $('#procedencia_id').val();

        data                        =   {
                                            _token                  : _token,
                                            director_id             : director_id,
                                            procedencia_id          : procedencia_id,
                                        };
                              
        ajax_modal(data,"/ajax-modal-editar-director",
                  "modal-conei-apafa","modal-conei-apafa-container");

    });




    $(".conei").on('click','.btn-guardar-conei', function() {


        // $.confirm({
        //     title: '¿Confirma el Registro?',
        //     content: 'CONEI',
        //     buttons: {
        //         confirmar: function () {
        //             return true;
        //         },
        //         cancelar: function () {
        //             $.alert('Se cancelo el registro');
        //             return false;
        //         }
        //     }
        // });

        // return true;

    });


// 


    $(".conei").on('click','.btn-next-tab01', function() {
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
        $('.nav-tabs a[href="#conei"]').tab('show');

    });



    $(".conei").on('click','.btn-next', function() {
        event.preventDefault();

        var _token                                          =   $('#token').val();
        var error = 0;
        var data_o = [];

        $(".cto .tag_obligado").each(function(){


            color = $(this).hasClass('btn-success');

            debugger;

            if(color == false && error == 0){
                data_nombre_section = $(this).attr('data_nombre_section');
                error = 1;
            }
        });


        // $(".conei .itemrepresentante").each(function(){

        //     _i_tipodocumento_id  = $(this).find('._i_tipodocumento_id').val();
        //     _i_documento  = $(this).find('._i_documento').val();
        //     _i_nombres  = $(this).find('._i_nombres').val();
        //     _i_tipodocumento_nombre  = $(this).find('._i_tipodocumento_nombre').val();
        //     _i_representante_nombre  = $(this).find('._i_representante_nombre').val();
        //     data_obligatorio = $(this).attr('data_obligatorio').trim();


        //     if(data_obligatorio=="1" && error == 0){
        //         if(_i_nombres ==''){
        //             data_nombre_section = $(this).attr('data_nombre_section');
        //             error = 1;
        //         }
        //     }

        //     if(_i_documento != ''){
        //         data_o.push({
        //             _i_tipodocumento_id                      : _i_tipodocumento_id,
        //             _i_documento                             : _i_documento,
        //             _i_nombres                               : _i_nombres,
        //             _i_tipodocumento_nombre                  : _i_tipodocumento_nombre,
        //             _i_representante_nombre                  : _i_representante_nombre,    
        //         });
        //     }
  
        // });

        var periodo_id              =   $('#periodo_id').val(); 
        var periodofin_id           =   $('#periodofin_id').val();
        var indb                    =   $('#indb').val();
        var checkconei              =   $('#checkconei').prop("checked");
        if(periodo_id ==''){ alerterrorajax("Seleccione un periodo Inicial."); return false;}
        if(checkconei==false){
            if(periodofin_id ==''){ alerterrorajax("Seleccione un periodo Final."); return false;}
        }
        if(indb =='0'){ alerterrorajax("Hay errores en la seleccion de periodos."); return false;}
        var array_detalle_producto                          =   $('#array_detalle_producto').val();
        var institucion_id                                  =   $('#institucion_id').val();
        var director_id                                     =   $('#director_id').val();
        if(error == 1){ alerterrorajax("Ingrese un "+data_nombre_section); return false;}

        data                        =   {
                                            _token                        : _token,
                                            data_o                        : data_o,
                                            institucion_id                : institucion_id,
                                            director_id                   : director_id,
                                            periodo_id                    : periodo_id,
                                            periodofin_id                 : periodofin_id,
                                            array_detalle_producto        : array_detalle_producto,

                                        };
                              
        ajax_modal(data,"/ajax-modal-confirmar-registro",
                  "modal-conei-apafa","modal-conei-apafa-container");

    });

    $(".conei").on('click','.btn-confirmar', function() {

        event.preventDefault();
        $('.nav-tabs a[href="#archivo"]').tab('show');
        $('.nav-tabs a[href="#archivo"]').trigger('click');
        $('#modal-conei-apafa').niftyModal('hide');
    });


    $(".conei").on('change','#tdgoi', function() {
        var tdg        =   $(this).val();
        if(tdg =='TIDO00000001'){ 
            $(".btn_buscar_dni_oi").css("display", "block");
        }else{
            $(".btn_buscar_dni_oi").css("display", "none");
        } 
    });


    $(".conei").on('change','#tdg', function() {
        var tdg        =   $(this).val();
        if(tdg =='TIDO00000001'){ 
            $(".btn_buscar_dni").css("display", "block");
        }else{
            $(".btn_buscar_dni").css("display", "none");
        } 
    });



    $(".conei").on('click','.modal-registro', function() {
        event.preventDefault();
        var _token                  =   $('#token').val();

        var data_td                 =   $(this).attr('data_td');
        var data_dni                =   $(this).attr('data_dni');
        var data_nombre             =   $(this).attr('data_nombre');
        var data_titulo             =   $(this).attr('data_titulo');


        var data_nombre_visible     =   $(this).attr('data_nombre_visible');

        data                        =   {
                                            _token                  : _token,
                                            data_td                 : data_td,
                                            data_dni                : data_dni,
                                            data_nombre             : data_nombre,
                                            data_nombre_visible     : data_nombre_visible,
                                            data_titulo             : data_titulo,
                                        };
                              
        ajax_modal(data,"/ajax-modal-registro",
                  "modal-conei-apafa","modal-conei-apafa-container");

    });



    $(".conei").on('click','.modal-registro-variable', function() {
        event.preventDefault();
        var _token                  =   $('#token').val();

        var data_td_id              =   $(this).attr('data_td_id');
        var data_td_no              =   $(this).attr('data_td_no');
        var data_docu               =   $(this).attr('data_docu');
        var data_nombre             =   $(this).attr('data_nombre');

        var data_cod_modular        =   $(this).attr('data_cod_modular');
        var data_nivel              =   $(this).attr('data_nivel');

        var data_nombre_visible     =   $(this).attr('data_nombre_visible');
        var data_titulo             =   $(this).attr('data_titulo');

        var data_rp_id_val          =   $(this).attr('data_rp_id_val');
        var data_rp_no_val          =   $(this).attr('data_rp_no_val');
        var data_rp_id              =   $(this).attr('data_rp_id');
        var data_rp_no              =   $(this).attr('data_rp_no');

        debugger;
        
        var data_nombre_visible     =   $(this).attr('data_nombre_visible');

        data                        =   {
                                            _token                  : _token,
                                            data_td_id              : data_td_id,
                                            data_td_no              : data_td_no,
                                            data_docu               : data_docu,
                                            data_nombre             : data_nombre,
                                            data_nombre_visible     : data_nombre_visible,
                                            data_titulo             : data_titulo,

                                            data_rp_id_val          : data_rp_id_val,
                                            data_rp_no_val          : data_rp_no_val,
                                            data_rp_id              : data_rp_id,
                                            data_rp_no              : data_rp_no,
                                            data_cod_modular        : data_cod_modular,
                                            data_nivel              : data_nivel,

                                            
                                        };
                              
        ajax_modal(data,"/ajax-modal-registro",
                  "modal-conei-apafa","modal-conei-apafa-container");

    });




    $(".conei").on('click','.modal-registro-oi', function() {
        event.preventDefault();
        var _token                  =   $('#token').val();
        var representante_sel_id    =   $(this).attr('data_representante_id');

        debugger;

        data                        =   {
                                            _token                  : _token,
                                            representante_sel_id                  : representante_sel_id
                                        };
                              
        ajax_modal(data,"/ajax-modal-registro-oi",
                  "modal-conei-apafa","modal-conei-apafa-container");

    });


    $(".conei").on('click','.btn_buscar_dni_oi', function(e) {
        event.preventDefault();

        
        var data_dni_m              =   $(this).attr('data_dni_m');
        var data_nombre_m           =   $(this).attr('data_nombre_m');
        var dni                     =   $('#documentogoi').val();
        var _token                  =   $('#token').val();
        actualizar_ajax_dni_conei_oi(_token,carpeta,dni,data_nombre_m);


    });



    $(".conei").on('click','.btn_buscar_dni', function(e) {
        event.preventDefault();


        var data_dni_m              =   $(this).attr('data_dni_m');
        var data_nombre_m           =   $(this).attr('data_nombre_m');
        var dni                     =   $('#documentog').val();
        var _token                  =   $('#token').val();
        actualizar_ajax_dni_conei(_token,carpeta,dni,data_nombre_m);


    });


    $(".conei").on('click','.btn_buscar_dni_director', function(e) {
        event.preventDefault();

        debugger;
        var dni                     =   $('#dni').val();
        var _token                  =   $('#token').val();
        actualizar_ajax_dni_conei_director(_token,carpeta,dni);


    });


    $(".conei").on('click','.btn-limpiar', function(e) {

        event.preventDefault();

        var data_td                 =   $(this).attr('data_td');
        var data_dni                =   $(this).attr('data_dni');
        var data_nombre             =   $(this).attr('data_nombre');
        var data_nombre_visible     =   $(this).attr('data_nombre_visible');

        $('#'+data_td).val("");
        $('#'+data_dni).val("");
        $('#'+data_nombre).val("");
        $('#'+data_nombre_visible).val("");


    });


    $(".conei").on('click','.btn_asignar_nombre', function(e) {

        event.preventDefault();
        var tdg                     =   $('#tdg').val();
        var documentog              =   $('#documentog').val();
        var nombresg                =   $('#nombresg').val();
        var tdgtexto                =   $('select[name="tdg"] option:selected').text();
        var data_rp_id_val          =   $(this).attr('data_rp_id_val');

        var codigo_modular_id       =   '';
        var niveltexto              =   '';

        if(data_rp_id_val == 'ESRP00000002' || data_rp_id_val == 'ESRP00000003'){
            codigo_modular_id       =   $('#codigo_modular_id').val();
            niveltexto              =   ' - ' + $('select[name="codigo_modular_id"] option:selected').text();
            swnivel = validar_no_existe_nivel(codigo_modular_id,data_rp_id_val);
            
        }

        var data_td_id              =   $(this).attr('data_td_id');
        var data_td_no              =   $(this).attr('data_td_no');
        var data_docu               =   $(this).attr('data_docu');
        var data_nombre             =   $(this).attr('data_nombre');
        var data_nombre_visible     =   $(this).attr('data_nombre_visible');
        var data_rp_id              =   $(this).attr('data_rp_id');
        var data_rp_no              =   $(this).attr('data_rp_no');

        var data_rp_no_val          =   $(this).attr('data_rp_no_val');

        var data_cod_modular        =   $(this).attr('data_cod_modular');
        var data_nivel              =   $(this).attr('data_nivel');

        if(swnivel ==1){ alerterrorajax("Existe ya un registro con el mismo nivel"); return false;}
        if(tdg ==''){ alerterrorajax("Seleccione un tipo documento."); return false;}
        if(documentog ==''){ alerterrorajax("Ingrese un documento de identidad."); return false;}
        if(nombresg ==''){ alerterrorajax("Ingrese un nombre."); return false;}

        $('#'+data_td_id).val(tdg);
        $('#'+data_docu).val(documentog);
        $('#'+data_nombre).val(nombresg);
        $('#'+data_nombre_visible).val(documentog + ' - ' +nombresg + niveltexto);
        $('#'+data_td_no).val(tdgtexto);
        $('#'+data_rp_id).val(data_rp_id_val);
        $('#'+data_rp_no).val(data_rp_no_val);

        $('#'+data_cod_modular).val(codigo_modular_id);
        $('#'+data_nivel).val(niveltexto);

        $('#modal-conei-apafa').niftyModal('hide');


    });





    function validar_no_existe_nivel(codigo_modular_id,representante_id){
            var sw = 0;
            $(".totrosrepresentante  tbody tr").each(function(){
                t_nivel  = $(this).attr('t_nivel');
                t_representante_id  = $(this).attr('t_representante_id');
                if(representante_id==t_representante_id){
                    if(t_nivel==codigo_modular_id){
                        sw = 1;
                    }
                }
            });
            return sw;
    }
    function validar_dni_repetido(documento){
            var sw = 0;
            $(".totrosrepresentante  tbody tr").each(function(){
                t_documento  = $(this).attr('t_documento');
                if(documento==t_documento){
                        sw = 1;
                }
            });
            return sw;
    }




    $(".conei").on('click','.eliminaroi', function(e) {

        event.preventDefault();
        var fila                   =   $(this).attr('data-fila');
        var _token                  =   $('#token').val();
        var array_detalle_producto  =   $('#array_detalle_producto').val();
        eliminar_ajax_oi(_token,carpeta,fila,array_detalle_producto);


    });



    function actualizar_ajax_dni_conei_director(_token,carpeta,data_dni_m){

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
                    $('#nombres').val('');
                }else{
                    $('#nombres').val(nombrea+' '+apellidopa+' '+apellidoma);
                }
            },
            error: function (data) {
                cerrarcargando();
                error500(data);
            }
        });
    }


    function actualizar_ajax_dni_conei(_token,carpeta,data_dni_m,data_nombre_m){

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
                    $('#nombresg').val('');
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

    function actualizar_ajax_dni_conei_oi(_token,carpeta,data_dni_m,data_nombre_m){

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
                    $('#nombresgoi').val('');
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

    function actualizar_ajax_oi(_token,carpeta,tdg,tdgtexto,documentog,nombresg,cargo,array_detalle_producto,representante_id,representante_txt,codigo_modular_id,niveltexto){

        abrircargando();
        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-lista-tabla-oi",
            data    :   {
                            _token              : _token,
                            tdg                 : tdg,
                            tdgtexto            : tdgtexto,
                            documentog          : documentog,
                            nombresg            : nombresg,
                            dcargoni            : cargo,
                            representante_id    : representante_id,
                            representante_txt   : representante_txt,
                            codigo_modular_id    : codigo_modular_id,
                            niveltexto           : niveltexto,

                            array_detalle_producto : array_detalle_producto
                        },
            success: function (data){
                cerrarcargando();
                $('.listaajaxoi').html(data);
            },
            error: function (data) {
                cerrarcargando();
                error500(data);
            }
        });
    }


    function eliminar_ajax_oi(_token,carpeta,fila,array_detalle_producto){

        abrircargando();
        $.ajax({
            type    :   "POST",
            url     :   carpeta+"/ajax-elminar-fila-tabla-oi",
            data    :   {
                            _token          : _token,
                            fila            : fila,
                            array_detalle_producto : array_detalle_producto
                        },
            success: function (data){
                cerrarcargando();
                $('.listaajaxoi').html(data);
            },
            error: function (data) {
                cerrarcargando();
                error500(data);
            }
        });
    }




});




