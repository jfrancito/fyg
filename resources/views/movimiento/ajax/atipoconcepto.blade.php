<div class="form-group">
    <label class="col-sm-3 control-label">Tipo de Concepto : </label>
    <div class="col-sm-6">
      {!! Form::select( 'tipo_concepto_id', $combo_tipo_concepto, array($select_tipo_concepto),
                        [
                          'class'       => 'form-control control select2 select3' ,
                          'id'          => 'tipo_concepto_id',
                          'required'    => '',
                          'data-aw'     => '9'
                        ]) !!}
    </div>
</div>

@if(isset($ajax))
	<script type="text/javascript">
	$(document).ready(function(){
		$(".select3").select2();
	});
	</script>
@endif