<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title">
		 {{$institucion->codigo}} - {{$institucion->nombre}} - {{$institucion->nivel}} || {{$procedencia->nombre}}
	</h3>
</div>
<div class="modal-body">
	<div  class="row regla-modal">
		    <div class="col-md-12">

            <div class="col-sm-12">
              <div class="be-checkbox inline">
                <input id="checkconei" type="checkbox" @if($disabled) disabled @endif @if($checked) checked @endif >
                <label for="checkconei">Solo periodo incio</label>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label"><b>Periodo Inicial : </b></label>
                {!! Form::select( 'periodo_id', $comboperiodo, $selectperiodo,
                                  [
                                    'class'       => 'select3 form-control control input-xs buscar_periodo_sgt',
                                    'id'          => 'periodo_id',
                                  ]) !!}
              </div>
            </div>

            <div class="msj_consulta_periodo">
          
              @include('requerimiento.ajax.aperiodofin')

            </div>


		    </div>
	    <div class="col-md-6">
	    </div>
	</div>
</div>

<div class="modal-footer">
  <button type="submit" 
  				data-dismiss="modal" class="btn btn-success btn_asignar_periodo"
  				>
  	Asignar
  </button>
</div>

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
			$(".select3").select2({
		      width: '100%'
		  });
    });
  </script>
@endif



