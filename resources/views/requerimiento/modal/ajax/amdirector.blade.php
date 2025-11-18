<input type="hidden" name="director_id" id = 'director_id' value='{{$director->id}}'>
<input type="hidden" name="procedencia_id" id = 'procedencia_id' value='{{$procedencia_id}}'>
<div class="panel panel-default" style="border: 3px solid #EEEEEE;">
  <div class="panel-heading panel-heading-divider"><b>Información del director</b>
    <div class="tools"><span class="icon btneditar editardirector">Editar</span></div>
  </div>
  <div class="panel-body">
    <br><br>

    <div class="col-sm-6">
      <div class="col-sm-4">
          <b>INSTITUCION:</b>
      </div>
      <div class="col-sm-8" style="text-align: right;">
          {{$institucion->nombre}}
      </div>
    </div>
    <br><br>
    <div class="col-sm-6">
      <div class="col-sm-4">
          <b>DNI:</b>
      </div>
      <div class="col-sm-8" style="text-align: right;">
          {{$director->dni}}
      </div>
    </div>

    <div class="col-sm-6">
      <div class="col-sm-4">
          <b>NOMBRE:</b>
      </div>
      <div class="col-sm-8" style="text-align: right;">
          {{$director->nombres}}
      </div>
    </div>

    <br><br>
    <div class="col-sm-6">
      <div class="col-sm-4">
          <b>TELEFONO:</b>
      </div>
      <div class="col-sm-8" style="text-align: right;">
          {{$director->telefono}}
      </div>
    </div>
    <div class="col-sm-6">
      <div class="col-sm-4">
          <b>CORREO:</b>
      </div>
      <div class="col-sm-8" style="text-align: right;">
          {{$director->correo}}
      </div>
    </div>
    <br><br>
  </div>
</div>