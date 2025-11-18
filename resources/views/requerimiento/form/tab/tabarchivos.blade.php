<div class="col-md-12">
  <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
    <div class="panel-heading panel-heading-divider"><b>ARCHIVOS</b>
    </div>
    <div class="panel-body">

      @foreach($tarchivos as $index => $item) 
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 10px;">
            <div class="form-group sectioncargarimagen">
              <label class="col-sm-12 control-label tituloarchivo" style="text-align: left;">
                <b >{{$item->nombre_archivo}} ({{$item->formato}})</b><br>

                @if($item->cod_archivo != '000006')
                  <a href="{{ route('descargar.pdf', ['filename' => $item->archivo_ejemplo]) }}">
                      DESCARGAR PLANTILLA
                  </a>
                @endif

              </label>


                <div class="col-sm-12">
                    <div class="file-loading">
                        <input 
                        id="file-{{$item->cod_archivo}}" 
                        name="{{$item->cod_archivo}}[]" 
                        class="file-es"  
                        type="file" 
                        multiple data-max-file-count="1"
                        @if($item->ind_obligatorio == 1) required @endif>
                    </div>
                </div>
                
            </div>
          </div>
      @endforeach







    </div>
  </div>
</div>
