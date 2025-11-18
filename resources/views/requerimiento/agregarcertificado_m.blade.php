@extends('template_lateral_m')
@section('style')


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/file/fileinput.css') }} "/>
@stop

@section('section')
<div class="be-content certificado">
  <div class="main-content container-fluid">
    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">{{ $titulo }}<span class="panel-subtitle">Crear un nuevo Certificado</span></div>
          <div class="panel-body">

            <form method="POST" action="{{ url('/agregar-certificado/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                {{ csrf_field() }}

              <div class="form-group">
                <label class="col-sm-3 control-label">Institucion : </label>
                <div class="col-sm-6">
                  {!! Form::select( 'institucion_id', $comboinstituciones, array($selectinstituciones),
                                    [
                                      'class'       => 'form-control control select2' ,
                                      'id'          => 'institucion_id',
                                      'required'    => '',
                                      'data-aw'     => '1'
                                    ]) !!}
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Procedencia : </label>
                <div class="col-sm-6">
                  {!! Form::select( 'procedencia_id', $comboprocedencia, array($selectprocedencia),
                                    [
                                      'class'       => 'form-control control select2' ,
                                      'id'          => 'procedencia_id',
                                      'required'    => '',
                                      'data-aw'     => '3'
                                    ]) !!}
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Periodos : </label>
                <div class="col-sm-6">
                  <div class="input-group my-group">
                      <input  type="text"
                              id="periodos_nombres" name='periodos_nombres' 
                              value="{{ old('periodos_nombres') }}"                         
                              placeholder="PERIODOS"
                              required = ""                   
                              autocomplete="off" class="form-control input-sm periodos_nombres" data-aw="4" readonly/>
                      <span class="input-group-btn">
                        <button class="btn btn-primary modal-registro"
                                data_periodo_inicio     = 'periodo_inicio'
                                data_periodo_fin    = 'periodo_fin'
                                type="button" 
                                style="height: 38px;">
                                Buscar periodo</button>
                      </span>

                      <input type="hidden" name="periodo_inicio_id" id = 'periodo_inicio_id'>
                      <input type="hidden" name="periodo_fin_id" id = 'periodo_fin_id'>
                  </div>

                </div>
              </div>


<!--               <div class="ajax_periodo">

                <div class="form-group">
                  <label class="col-sm-3 control-label">Periodo Inicio : </label>
                  <div class="col-sm-6">
                    {!! Form::select( 'periodo_id', $comboperiodo, array($selectperiodo),
                                      [
                                        'class'       => 'form-control control select2' ,
                                        'id'          => 'periodo_id',
                                        'required'    => '',
                                        'data-aw'     => '2'
                                      ]) !!}
                  </div>
                </div> 

                <div class="form-group">
                  <label class="col-sm-3 control-label">Periodo Fin: </label>
                  <div class="col-sm-6">
                    {!! Form::select( 'periodofin_id', $comboperiodo_fin, array($selectperiodo_fin),
                                      [
                                        'class'       => 'form-control control select2' ,
                                        'id'          => 'periodofin_id',
                                        'required'    => '',
                                        'data-aw'     => '2'
                                      ]) !!}
                  </div>
                </div> 

              </div> -->


              <div class="form-group sectioncargarimagen">
                  <label class="col-sm-3 control-label">Certificado</label>
                  <div class="col-sm-6">
                      <div class="file-loading">
                          <input id="file-es" name="certificado[]" class="file-es" type="file" multiple data-max-file-count="1">
                      </div>
                  </div>
              </div>
              <div class="row xs-pt-15">
                <div class="col-xs-6">
                    <div class="be-checkbox">

                    </div>
                </div>
                <div class="col-xs-6">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Guardar</button>
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

        $(".select3").select2({
          width: '100%'
        });


      });

      $('#file-es').fileinput({
            theme: 'fa5',
            language: 'es',
            allowedFileExtensions: ['pdf'],
            initialPreviewAsData: true,

      });




    </script> 
     <script src="{{ asset('public/js/requerimiento/certificado.js?v='.$version) }}" type="text/javascript"></script>

    @stop

