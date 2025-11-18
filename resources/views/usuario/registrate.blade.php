<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistemas de Ventas">
    <meta name="author" content="Jorge Francelli Saldaña Reyes">
    <link rel="icon" href="{{ asset('public/img/icono/ugel.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/meta.css?v='.$version) }} "/>

    
    <title>Registrate - Inicio Sessión</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/material-design-icons/css/material-design-iconic-font.min.css') }} "/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/styleregistrate.css?v='.$version) }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

    <link rel="stylesheet" href="{{ asset('public/css/registrate.css?v='.$version) }}" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/file/fileinput.css') }} "/>

    <style type="text/css">
      .file-drop-zone{
        min-height: 100px !important;
      }
      .file-drop-zone-title{
        color: #fff;
      }

      .form-v10-content .form-detail h2 {
          padding: 11px 50px 0 60px;
      }
      .ocultar{
        display: none;
      }
      .button.close{
        color: #fff;
      }
      .alertaw{
        top: 1px !important;
      }
    </style>


  </head>
  <body class="form-v10 wrapper registroruc">
    @include('success.ajax-alert')
    @include('success.bienhecho', ['bien' => Session::get('bienhecho')])
    @include('error.erroresurl', ['error' => Session::get('errorurl')])
    @include('error.erroresbd', ['id' => Session::get('errorbd')  , 'error' => Session::get('errorbd'), 'data' => '2'])

    <div class="page-content">
      <div class="form-v10-content">
        <form class="form-detail" action="{{ url('registrate') }}" method="POST" id="myform" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-left">
            <h2>DATOS DE LA INSTITUCION </h2> 
                <div class="row regla-modal">
                    <div class="col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="inputr">
                                <div class="control-label">
                                  <div class="tooltipfr">Codigo Local <span class='requerido'>*</span>
                                    <span class="tooltiptext">Ingrese Codigo del Local.</span>
                                  </div>  
                                </div>
                                <div class="abajocaja">
                                      <div class="input-group">
                                            <input  type="text"
                                                    id="codigolocal" name='codigolocal' value="{{ old('codigolocal') }}" placeholder="CodigoLocal"
                                                    required = ""
                                                    autocomplete="off" class="form-control input-sm" data-aw="4"/>
                                            <span class="input-group-btn">
                                              <button type="button" class="buscarruc btn btn-success input-sm" style="height: 37px;">
                                                Buscar
                                              </button>
                                          </span>       

                                      </div>
                                </div>
                              </div>

                              <div class='inputr'>
                                <div class="control-label">Accion <span class='requerido'>*</span>:</div>
                                <div class="abajocaja">
                                  <div class="be-radio be-radio-color inline">
                                    <input type="radio" checked="" name="accion" id="rad9" class='accion' value = '0'>
                                    <label for="rad9">Registro</label>
                                  </div>
                                  <div class="be-radio be-radio-color inline">
                                    <input type="radio" name="accion" id="rad10" class='accion' value = '1'>
                                    <label for="rad10">Cambio de Director</label>
                                  </div>
                                </div>
                              </div>

                              <div class='encontro_proveedor'>
                                @include('usuario.form.formproveedor')
                              </div>
                              <span class='requerido'>* Datos obligatorios</span>
                              <br>
                        </div>
                    </div>
                </div>
          </div>
        <div class="form-right">
          <h2>DATOS DEL DIRECTOR</h2>
          <div class="row regla-modal">
              <div class="col-md-12">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class='encontro_director'>
                      @include('usuario.form.formdirector')
                    </div>
                    <div class='inputr inputresolucion ocultar'>
                      <div class="control-label cblanco">Resolución directorial : <span class='requerido'>*</span></div>
                      <div class="abajocaja">

                            <div class="file-loading cblanco">
                                <input id="file-es" name="resolucion[]" class="file-es" type="file" multiple data-max-file-count="1">
                            </div>

                      </div>
                    </div>

                    <input type='hidden' id='carpeta' value="{{$capeta}}"/>
                    <input type="hidden" id="token" name="_token"  value="{{csrf_token()}}"> 
                   </div>
                </div>
          </div>
          <div class="form-group login-submit">
            <button data-dismiss="modal" type="submit"  class="btn btn-success btn-xl btn-registrated"><b>REGISTRATE</b></button>
          </div>
        </div>
        </form>
      </div>
    </div>


    <script src="{{ asset('public/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>



    <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>        
    <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/js/file/fileinput.js?v='.$version) }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/file/locales/es.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/js/general/general.js?v='.$version) }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/general/gmeta.js?v='.$version) }}" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();

        $('#file-es').fileinput({
          theme: 'fa5',
          language: 'es',
          allowedFileExtensions: ['pdf'],
        });


      });
    </script> 


    <script src="{{ asset('public/js/user/registro.js?v='.$version) }}" type="text/javascript"></script>

  </body>
</html>