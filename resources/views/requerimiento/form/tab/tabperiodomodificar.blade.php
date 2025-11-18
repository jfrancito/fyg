<div class="col-md-12">
  <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
    <div class="panel-heading panel-heading-divider"><b>PERIODO</b>
    </div>
    <div class="panel-body">

      <div class="col-sm-6">
        <div class="form-group">
          <label class="control-label"><b>PERIODO INICIAL : </b></label>
          {!! Form::select( 'periodo_id', $comboperiodo, $selectperiodo,
                            [
                              'class'       => 'select2 form-control control input-xs buscar_periodo_sgt',
                              'id'          => 'periodo_id',
                              'disabled'    => true
                            ]) !!}
        </div>
      </div>
      <div class="msj_consulta_periodo">
        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label"><b>PERIODO FIN : </b></label>
            {!! Form::select( 'periodofin_id', $comboperiodofin, $selectperiodofin,
                              [
                                'class'       => 'select2 form-control control input-xs',
                                'id'          => 'periodofin_id',
                                'disabled'    => true
                              ]) !!}
          </div>
        </div>
        <input type="hidden" name="periodofin_r_id" value="{{$selectperiodofin}}">
      </div>
    </div>
  </div>
</div>