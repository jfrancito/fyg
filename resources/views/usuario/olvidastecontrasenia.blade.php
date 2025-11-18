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


    <title>Ugel Chiclayo - Olvidaste Contraseña</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/material-design-icons/css/material-design-iconic-font.min.css') }} "/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('public/css/style.css?v='.$version) }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('public/css/login.css?v='.$version) }}" type="text/css"/>

  </head>
  <body class="be-splash-screen login-top">

    @include('success.ajax-alert')
    @include('success.bienhecho', ['bien' => Session::get('bienhecho')])
    @include('error.erroresurl', ['error' => Session::get('errorurl')])
    @include('error.erroresbd', ['id' => Session::get('errorbd')  , 'error' => Session::get('errorbd'), 'data' => '2'])

    <div class="be-wrapper be-login">
      <div class="be-content ajaxpersonal">  
        <div class="main-content container-fluid">
          <div class="splash-container" style="margin: 25px auto;">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading">
              <h3 >
                <b>Recupera tu cuenta</b>
              </h3>
                Introduce tu correo electrónico y te enviaremos un enlace para que recuperes el acceso a tu cuenta
              </div>
              <div class="panel-body">
                <form method="POST" action="{{ url('olvidaste-contrasenia') }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <input  type="email"
                            id="lblemail" name='lblemail' 
                            value=""
                            placeholder="Ingresa tu correo electronico"
                            required = ""
                            autocomplete="off" 
                            class="form-control textpucanegro fuente-recoleta-regular input-sm"
                            data-aw="1"/>

                    @include('error.erroresvalidate', [ 'id' => $errors->has('name')  , 
                                                        'error' => $errors->first('name', ':message') , 
                                                        'data' => '1'])

                    @include('error.erroresvalidate', [ 'id' => Session::get('errorbd')  , 
                                                        'error' => Session::get('errorbd') , 
                                                        'data' => '1'])
                  </div>

                  <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit"  class="btn btn-primary btn-xl">ENVIAR ENLACE</button>
                  </div>

                  <input type='hidden' id='carpeta' value="{{$capeta}}"/>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('public/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
        $('form').parsley();
      });
    </script>

    <script src="{{ asset('public/js/user/user.js') }}" type="text/javascript"></script>

  </body>
</html>