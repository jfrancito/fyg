@extends('template_lateral')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery-confirm.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/file/fileinput.css') }} "/>



@stop
@section('section')

<div class="be-content apafa">
  <div class="main-content container-fluid">
    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">
            <span class="panel-subtitle">Modificar un nuevo requerimiento APAFA </span>

            <span style="font-size:16px;" class="label label-danger">{{$certificado->observacion}}</span>
          </div>
          <div class="panel-body">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <form method="POST" action="{{ url('/gestion-observacion-apafa/'.$idopcion.'/'.Hashids::encode(substr($conei->id, -8))) }}" style="border-radius: 0px;" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('requerimiento.form.modificarrequerimientoapafa')
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('requerimiento.modal.mconeiapafa')
</div>  

@stop

@section('script')



  <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>



  <script src="{{ asset('public/js/file/fileinput.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/file/locales/es.js') }}" type="text/javascript"></script>


  <script src="{{ asset('public/js/general/jquery-confirm.min.js?v='.$version) }}" type="text/javascript"></script>


  <script type="text/javascript">


    $.fn.niftyModal('setDefaults',{
      overlaySelector: '.modal-overlay',
      closeSelector: '.modal-close',
      classAddAfterOpen: 'modal-show',
    });

    $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();

      $('[data-toggle="tooltip"]').tooltip();
      $('form').parsley();

      $(':input[readonly]').css({'background-color':'#f6f6f6'});
      $('.form-control[disabled]').css({'background-color':'#f6f6f6'});



    });

  </script>

  <script type="text/javascript">

      @if($otro_doc == '')
        $('#file-000009').fileinput({
          theme: 'fa5',
          language: 'es',
          allowedFileExtensions: ['pdf'],
        });
      @endif


  </script>


  <script>

    @foreach($archivos as $index => $item) 
                var initialPreview = [];
                var initialPreviewConfig = [];
                
                @if(!empty($item->nombre_archivo))
                    initialPreview.push('{{ asset($rutafoto.'/'.$item->nombre_archivo) }}');
                    initialPreviewConfig.push(
                        {
                            type: "pdf", 
                            caption: "{{$item->nombre_archivo}}", 
                            downloadUrl: "{{$rutafoto.'/'.$item->nombre_archivo}}"
                        }
                    );
                @endif

                $('#file-{{$item->codigo_doc}}').fileinput({

                    theme: 'fa5',
                    language: 'es',
                    allowedFileExtensions: ['pdf'],
                    initialPreviewAsData: true,
                    initialPreview: initialPreview,
                    initialPreviewConfig: initialPreviewConfig
                });
                
                $('.file-es').on('filedeleted', function(event, key) {
                    removedFiles.push(key);
                });


    @endforeach

  </script>



  <script src="{{ asset('public/js/archivos.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/requerimiento/apafa.js?v='.$version) }}" type="text/javascript"></script>

@stop