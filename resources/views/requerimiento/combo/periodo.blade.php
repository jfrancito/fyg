<div class="form-group">
  <label class="col-sm-3 control-label">Periodo : </label>
  <div class="col-sm-6">
    {!! Form::select( 'periodo_id', $comboperiodo, array($selectperiodo),
                      [
                        'class'       => 'form-control control select3' ,
                        'id'          => 'periodo_id',
                        'required'    => '',
                        'data-aw'     => '2'
                      ]) !!}
  </div>
</div> 

@if(isset($ajax))
<script type="text/javascript">
  $(".select3").select2({
      width: '100%'
    });
</script> 
@endif