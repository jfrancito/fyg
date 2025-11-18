@extends('template_lateral')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/file/fileinput.css') }} "/>

@stop

@section('section')
<div class="be-content certificado">
  <div class="main-content container-fluid">
    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">{{ $titulo }}<span class="panel-subtitle">Modificar Cerfitificado : {{$certificado->codigo}}</span></div>
          <div class="panel-body">
            <form method="POST" action="{{ url('/modificar-certificado/'.$idopcion.'/'.Hashids::encode(substr($certificado->id, -8))) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                    {{ csrf_field() }}


              <div class="form-group">
                <label class="col-sm-3 control-label">Institucion : </label>
                <div class="col-sm-6">

                  <input  type="text"
                          id="institucion_codigo" name='institucion_codigo' 
                          value="{{$certificado->institucion_codigo}} - {{$certificado->institucion_nombre}} - {{$certificado->institucion_nivel}}"                                           
                          autocomplete="off" class="form-control input-sm nombre_director" data-aw="1" readonly/>

                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Procedencia : </label>
                <div class="col-sm-6">
                  <input  type="text"
                          id="procedente_nombre" name='procedente_nombre' 
                          value="{{$certificado->procedente_nombre}}"                                           
                          autocomplete="off" class="form-control input-sm nombre_director" data-aw="1" readonly/>

                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Procedencia : </label>
                <div class="col-sm-6">
                  <input  type="text"
                          id="periodos_nombres" name='periodos_nombres' 
                          value="{{$certificado->periodo_nombre}}"                                           
                          autocomplete="off" class="form-control input-sm nombre_director" data-aw="1" readonly/>

                </div>
              </div>


              <input type="hidden" id = 'institucion_id' name="institucion_id" value="{{$certificado->institucion_id}}">
              <input type="hidden" id = 'procedencia_id' name="procedencia_id" value="{{$certificado->procedente_id}}">


              <div class="form-group sectioncargarimagen @if($selectestado <> 'CEES00000001') ocultar @endif" >
                  <label class="col-sm-3 control-label">Certificado</label>
                  <div class="col-sm-6">
                      <div class="file-loading">
                          <input id="file-es" name="certificado[]" class="file-es" type="file" multiple data-max-file-count="1">
                      </div>
                  </div>
              </div>

              <div class="ajax_periodo">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Estado : </label>
                  <div class="col-sm-6">
                    {!! Form::select( 'activo', $comboestado, array($selectestado),
                                      [
                                        'class'       => 'form-control control select2' ,
                                        'id'          => 'activo',
                                        'required'    => '',
                                        'data-aw'     => '2'
                                      ]) !!}
                  </div>
                </div> 
              </div>


              <div class="form-group bajaextorno  @if($certificado->estado_id<>'CEES00000003') ocultar @endif">
                <label class="col-sm-3 control-label">Motivo de BAJA :</label>
                <div class="col-sm-6">
                      <textarea 
                      name="bjamsj"
                      id = "bjamsj"
                      class="form-control input-sm validarmayusculas"
                      rows="5" 
                      cols="50"    
                      data-aw="2">{{$certificado->msj_extorno}}</textarea>
                </div>
              </div>



              <div class="form-group bajaextornov @if($selectestado <> 'CEES00000008') ocultar @endif" >
                <label class="col-sm-3 control-label">Nro Tramite : </label>
                <div class="col-sm-6">
                    <input  type="text"
                            id="nro_tramite" name='nro_tramite' 
                            value="{{$certificado->numero_tramite}}"                         
                            placeholder="Nro Tramite"                 
                            autocomplete="off" class="form-control input-sm nro_tramite" data-aw="4"/>
                </div>
              </div>

              <div class="form-group bajaextornov  @if($selectestado <> 'CEES00000008') ocultar @endif">
                <label class="col-sm-3 control-label">Motivo de Observacion :</label>
                <div class="col-sm-6">
                      <textarea 
                      name="descripcion"
                      id = "descripcion"
                      class="form-control input-sm validarmayusculas"
                      rows="5" 
                      cols="50"    
                      data-aw="2">{{$certificado->observacion}}</textarea>
                </div>
              </div>




              
              <div class="row xs-pt-15">
                <div class="col-xs-6">
                    <div class="be-checkbox">

                    </div>
                </div>
                <div class="col-xs-6">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary btn-guardar-certificado">Guardar</button>
                  </p>
                </div>
              </div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('requerimiento.modal.mcertificado')

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
    
    <script src="{{ asset('public/js/file/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/file/fileinput.js?v='.$version) }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/file/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/general/general.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>

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
        $('form').parsley();
      });
    </script> 

    @if($rutafoto=='')
      <script type="text/javascript">    
           $('#file-es').fileinput({
              theme: 'fa5',
              language: 'es',
              allowedFileExtensions: ['pdf'],
        });
      </script>
    @else
      <script type="text/javascript">    
        $('#file-es').fileinput({
            theme: 'fa5',
            language: 'es',
            allowedFileExtensions: ['pdf'],
            initialPreviewAsData: true,
            initialPreview: [
              '{{$rutafoto}}'
            ],
            initialPreviewConfig: [
              {type: "pdf", description: "<h5>PDF File</h5> This is a representative description number ten for this file.", size: 8000, caption: "About.pdf", url: "/file-upload-batch/2", key: 10, downloadUrl: false},
            ],

        });
      </script>
    @endif

     <script src="{{ asset('public/js/requerimiento/certificado.js?v='.$version) }}" type="text/javascript"></script>

    
@stop