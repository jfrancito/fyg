<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title">
		 EDITAR DIRECTOR
	</h3>
</div>
<div class="modal-body">
	<div  class="row regla-modal">
		    <div class="col-md-12">

            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label"><b>Tipo Documento : </b></label>
                {!! Form::select( 'tdg', $combotd, $selecttd,
                                  [
                                    'class'       => 'select3 form-control control input-xs combo ctipodocumento',
                                    'id'          => 'tdg',
                                    'disabled'    => true
                                  ]) !!}
              </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group my-group">
                  <label class="control-label"><b>DNI : </b></label>
                  <input  type="text"
                          id="dni" 
                          name='dni'                        
                          placeholder="DNI"
                          value="{{old('dni',$director->dni)}}"
                          required = ""
                          maxlength="10"                     
                          autocomplete="off" class="form-control input-sm"/>

                    <span class="input-group-btn">
                      <button class="btn btn-primary btn_buscar_dni_director"
                              data_dni_m = 'dni'
                              data_nombre_m = 'nombresg'
                              type="button" 
                              style="margin-top: 26px;height: 37px;">
                              Buscar Reniec</button>
                    </span>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label"><b>NOMBRES : </b></label>
                <input  type="text"
                        id="nombres" 
                        name='nombres'                        
                        placeholder="NOMBRES"
                        value="{{old('nombres',$director->nombres)}}"
                        required = ""
                        maxlength="300"                     
                        autocomplete="off" class="form-control input-sm" readonly />

              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label"><b>TELEFONO : </b></label>
                <input  type="number"
                        id="telefono" 
                        name='telefono'                        
                        placeholder="TELEFONO"
                        value="{{old('telefono',$director->telefono)}}"
                        required = ""
                        maxlength="300"                     
                        autocomplete="off" class="form-control input-sm"/>

              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label"><b>CORREO : </b></label>

                <input  type="email"
                        id="correo" name='correo' 
                        value="{{old('correo',$director->correo)}}"
                        placeholder="CORREO"
                        required = ""
                        autocomplete="off" 
                        class="form-control textpucanegro fuente-recoleta-regular input-sm"
                        data-aw="1"/>


              </div>
            </div>


		    </div>
	    <div class="col-md-6">
	    </div>
	</div>
</div>

<div class="modal-footer">
  <button type="submit" 
  				data-dismiss="modal" class="btn btn-success btn_guardar_editar"
  				>
  	Editar
  </button>
</div>

@if(isset($ajax))
  <script type="text/javascript">
		$(".select3").select2({
	      width: '100%'
	  });
  </script>
@endif



