<div class="col-md-12">
  <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
    <div class="panel-heading panel-heading-divider"><b>PERIODO</b>
    </div>
    <div class="panel-body">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="be-checkbox inline">
          <input id="checkconei" type="checkbox" @if($disabled) disabled @endif @if($checked) checked @endif >
          <label for="checkconei">SOLO PERIODO INICIO</label>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label class="control-label"><b>PERIODO INICIAL : </b></label>
          {!! Form::select( 'periodo_id', $comboperiodo, $selectperiodo,
                            [
                              'class'       => 'select2 form-control control input-xs buscar_periodo_sgt',
                              'id'          => 'periodo_id',
                            ]) !!}
        </div>
      </div>
      <div class="msj_consulta_periodo">
        @include('requerimiento.ajax.aperiodofin')
      </div>
    </div>
  </div>
</div>