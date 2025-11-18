@extends('template_lateral')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/jqvmap/jqvmap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/responsive.dataTables.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

@stop
@section('section')

  <div class="be-content contenido reportesincertificado">
    <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-success">
                <div class="panel-heading">{{$titulo}}

                  <div class="tools tooltiptop">
                    <div class="dropdown">

                      <a href="#" class="tooltipcss opciones buscarcertificado">
                        <span class="tooltiptext">Buscar certificados</span>
                        <span class="icon mdi mdi-search"></span>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="panel-body">
                  <div class='filtrotabla row'>
                    <div class="col-xs-12">

                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 cajareporte">

                          <div class="form-group">
                            <label class="col-sm-12 control-label">Periodo Inicio: </label>
                            <div class="col-sm-12">
                              {!! Form::select( 'periodo_id', $comboperiodo, array($selectperiodo),
                                                [
                                                  'class'       => 'form-control control select2' ,
                                                  'id'          => 'periodo_id',
                                                  'required'    => '',
                                                  'data-aw'     => '2'
                                                ]) !!}
                            </div>
                          </div> 

                      </div>


                      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 cajareporte">
                        <div class="form-group">
                          <label class="col-sm-12 control-label">Procedencia : </label>
                          <div class="col-sm-12">
                            {!! Form::select( 'procedencia_id', $comboprocedencia, array($selectprocedencia),
                                              [
                                                'class'       => 'form-control control select2' ,
                                                'id'          => 'procedencia_id',
                                                'required'    => '',
                                                'data-aw'     => '3'
                                              ]) !!}
                          </div>
                        </div>
                      </div>


                      <input type="hidden" name="idopcion" id='idopcion' value='{{$idopcion}}'>

                    </div>
                  </div>

                  <div class='listajax'>
                    @include('reportes.ajax.alistasincertificadoinstitucion')
                  </div>


                </div>
              </div>
            </div>
          </div>
    </div>
  </div>

@stop

@section('script')


  <script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/jszipoo.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/vfs_fonts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-tables-datatables.js?v='.$version) }}" type="text/javascript"></script>

  <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>
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
      App.dataTables();

      $('[data-toggle="tooltip"]').tooltip();


    });

  </script>
  <script src="{{ asset('public/js/reporte/certificado.js?v='.$version) }}" type="text/javascript"></script>

@stop