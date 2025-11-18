@extends('template_lateral')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/file/fileinput.css') }} "/>
@stop

@section('section')
<div class="be-content egreso">
  <div class="main-content container-fluid">
    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">{{ $titulo }}<span class="panel-subtitle">Crear un nuevo Egreso</span></div>
          <div class="panel-body">

            <form method="POST" action="{{ url('/agregar-egreso/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed formegreso" enctype="multipart/form-data">
                {{ csrf_field() }}

              <input type="hidden" name="registro_id" id = 'registro_id' value=''>

              <div class="trimestre">
                @include('movimiento.ajax.atrimestre')              
              </div>


              <div class="form-group">
                  <label class="col-sm-3 control-label">Fecha de Comprobante : </label>                  
                  <div class="col-sm-6"> 
                    <div data-min-view="2" data-date-format="dd-mm-yyyy"  class="input-group date datetimepicker">
                              <input size="16" type="text"  placeholder="Fecha de Comprobante"
                              id='fecha_comprobante' name='fecha_comprobante' 
                              value="@if(isset($egreso)){{old('fecha_comprobante' ,date_format(date_create($egreso->fecha_comprobante),'d-m-Y'))}}@else{{old('fecha_comprobante')}}@endif"
                              required = ""
                              class="form-control input-sm" data-aw="1">
                              <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>             
                    </div>
                  </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Tipo de Comprobante : </label>
                <div class="col-sm-6">
                  {!! Form::select( 'tipo_comprobante_id', $combo_tipo_comprobante, array($select_tipo_comprobante),
                                    [
                                      'class'       => 'form-control control select2' ,
                                      'id'          => 'tipo_comprobante_id',
                                      'required'    => '',
                                      'data-aw'     => '2'
                                    ]) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Número de Comprobante : </label>
                <div class="col-sm-1">
                  <input  type="text"
                          style="width: 70px;" 
                          id="serie" name='serie' 
                          value="@if(isset($egreso)){{old('serie' ,$egreso->serie)}}@else{{old('serie')}}@endif"
                          value="{{ old('serie') }}"                         
                          placeholder="Serie"
                          required = ""
                          maxlength="4" 
                          autocomplete="off" class="form-control input-sm seriekeypress" data-aw="3"/>

                  @include('error.erroresvalidate', [ 'id' => $errors->has('serie')  , 
                                                'error' => $errors->first('serie', ':message') , 
                                                'data' => '2'])
                </div>                
                <div class="col-sm-5">
                  <input  type="text"
                          id="numero" name='numero' 
                          value="@if(isset($egreso)){{old('numero' ,$egreso->numero)}}@else{{old('numero')}}@endif"
                          value="{{ old('numero') }}"                         
                          placeholder="Numero"
                          required = ""
                          maxlength="8"                     
                          autocomplete="off" class="form-control input-sm numero" data-aw="4"/>

                  @include('error.erroresvalidate', [ 'id' => $errors->has('numero')  , 
                                                'error' => $errors->first('numero', ':message') , 
                                                'data' => '3'])
                </div>
              </div>              


              <div class="form-group">
                <label class="col-sm-3 control-label">Tipo de Documento : </label>
                <div class="col-sm-6">
                  {!! Form::select( 'tipo_documento_id', $combo_tipo_documento, array($select_tipo_documento),
                                    [
                                      'class'       => 'form-control control select2' ,
                                      'id'          => 'tipo_documento_id',
                                      'required'    => '',
                                      'data-aw'     => '5'
                                    ]) !!}
                </div>
              </div>

              <div class="form-group" >
                <label class="col-sm-3 control-label">Número de Documento : </label>
                <div class="col-sm-6">
                  <div class="input-group my-group">     
                    <input  type="text"
                            id="dni" name='dni' 
                            value="@if(isset($egreso)){{old('dni' ,$egreso->dni)}}@else{{old('dni')}}@endif"
                            value="{{ old('dni') }}"                                 
                            placeholder="Número de Documento"                 
                            required = ""
                            maxlength="11"                     
                            autocomplete="off" class="form-control input-sm nro_tramite" data-aw="6"/>
                    <span class="input-group-btn">
                      <button class="btn btn-primary btn_buscar_dni"
                              data_dni_m = 'dni'
                              data_nombre_m = 'razon_social'
                              type="button" 
                              style="height: 37px;">
                              Buscar Reniec</button>
                    </span>
                  </div>
                </div>
              </div>


              <div class="form-group" >
                <label class="col-sm-3 control-label">Proveedor : </label>
                <div class="col-sm-6">
                    <input  type="text"
                            id="razon_social" name='razon_social' 
                            value="@if(isset($egreso)){{old('razon_social' ,$egreso->razon_social)}}@else{{old('razon_social')}}@endif"
                            value="{{ old('razon_social') }}"                                 
                            placeholder="Proveedor"                 
                            required = ""
                            readonly 
                            maxlength="200"                     
                            autocomplete="off" class="form-control input-sm nro_tramite" data-aw="7"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Tipo de Gasto : </label>
                <div class="col-sm-6">
                  {!! Form::select( 'tipo_gasto_id', $combo_tipo_gasto, array($select_tipo_gasto),
                                    [
                                      'class'       => 'form-control control select2' ,
                                      'id'          => 'tipo_gasto_id',
                                      'required'    => '',
                                      'data-aw'     => '7'
                                    ]) !!}
                </div>
              </div>

              <div class="form-group datosegreso">
                <label class="col-sm-3 control-label">Tipo de Compra : </label>
                <div class="col-sm-6">
                  {!! Form::select( 'tipo_compra_id', $combo_tipo_compra, array($select_tipo_compra),
                                    [
                                      'class'       => 'form-control control select2' ,
                                      'id'          => 'tipo_compra_id',                                      
                                      'data-aw'     => '8'
                                    ]) !!}
                </div>
              </div>

              <div class="tipoconcepto">
                @include('movimiento.ajax.atipoconcepto')
              </div>              

              <div class="form-group" >
                <label class="col-sm-3 control-label">Detalle : </label>
                <div class="col-sm-6">
                    <input  type="text"
                            id="detalle_concepto" name='detalle_concepto' 
                            value="@if(isset($egreso)){{old('detalle_concepto' ,$egreso->detalle_concepto)}}@else{{old('detalle_concepto')}}@endif"
                            value="{{ old('detalle_concepto') }}"                                 
                            placeholder="Detalle"                 
                            required = ""
                            maxlength="500"                     
                            autocomplete="off" class="form-control input-sm nro_tramite" data-aw="10"/>
                </div>
              </div>                          

              <div class="form-group">
                <label class="col-sm-3 control-label">Total : </label>
                <div class="col-sm-6">
                    <input  type="text"
                            id="total" name='total' 
                            value="@if(isset($egreso)){{old('total' ,$egreso->total)}}@endif" 
                            placeholder="Total"
                            required = ""
                            autocomplete="off" class="form-control input-sm importe" data-aw="11"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Observacion : </label>
                <div class="col-sm-6">
                      <textarea 
                      name="observacion"
                      id = "observacion"                      
                      class="form-control input-sm validarmayusculas"
                      placeholder="Observacion"                      
                      rows="5" 
                      cols="50"    
                      data-aw="12"></textarea>
                </div>
              </div>
              <span class="obligatorio" style="margin-left: 11px">Nota: Este campo es opcional</span>
              <div class="col-sm-3"></div>
              

      				<div class="form-group sectioncargarimagen iaprobado">
      						<label class="col-sm-3 control-label">Sustento :</label>
      						<div class="col-sm-6">
      								<div class="file-loading">
      				        		<input id="file-es" name="egreso[]" class="file-es" required = "" type="file" multiple data-max-file-count="1">
      				        </div>
      						</div>
      				</div>
              <span class="obligatorio" style="margin-left: 11px">Nota: Solo se permite archivos hasta de 10MB</span>
              <div class="col-sm-3"></div>             


              <div class="row xs-pt-15">
                <div class="col-xs-6">
                    <div class="be-checkbox">

                    </div>
                </div>
                <div class="col-xs-6">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary btn-agregar-egreso">Guardar</button>
                  </p>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>  
@stop

@section('script')

    <script src="{{ asset('public/js/general/inputmask/inputmask.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('public/js/general/inputmask/inputmask.extensions.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('public/js/general/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('public/js/general/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('public/js/general/inputmask/jquery.inputmask.js') }}" type="text/javascript"></script>

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

        $(".select3").select2({
              width: '100%'
        });

        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();

        $('.importe').inputmask({ 'alias': 'numeric', 
        'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 
        'digitsOptional': false, 
        'prefix': '', 
        'placeholder': '0'});
        $('.formegreso .datosegreso').hide();
               

      });



      var fileInput = $('#file-es').fileinput({
            theme: 'fa5',
            language: 'es',
            allowedFileExtensions: ['pdf'],
            initialPreviewAsData: true,
            showUpload: false,
            showRemove: false,
            maxFileCount: 1,
            maxFileSize: 10240  // Limita el tamaño del archivo a 10 MB (10240 KB)
      });
      var filesSelected = false;

      // Evento de cambio en el input de archivo
      fileInput.on('fileselect', function(event, numFiles, label) {
          filesSelected = true;
      });

      // Evento cuando se limpia la selección de archivos
      fileInput.on('fileclear', function(event) {
          filesSelected = false;
      });



    </script> 
    <script src="{{ asset('public/js/movimiento/egreso.js?v='.$version) }}" type="text/javascript"></script>

    @stop

