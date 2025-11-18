<div class="tab-container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#conei" class="conei" data-toggle="tab"><b> REPRESENTANTE </b></a></li>
    <li ><a href="#archivo" class="conei" data-toggle="tab"><b> EXPEDIENTES </b></a></li>
  </ul>
  <div class="tab-content">

    <div id="conei" class="tab-pane active cont">
      @include('requerimiento.form.tab.tabperiodo')
      @include('requerimiento.form.tab.tabintegrante')
      <br><br>
      <input type="hidden" name="director_id" id = 'director_id' value='{{$director->id}}'>
      <input type="hidden" name="procedencia_id" id = 'procedencia_id' value='{{$procedencia_id}}'>
      <div style="text-align: right;">
        <button type="button" class="btn btn-space btn-success btn-next">Siguiente</button>
      </div>
    </div>

    <div id="archivo" class="tab-pane cont">
      @include('requerimiento.form.tab.tabarchivos')
      <div class="row xs-pt-15">
        <div class="col-xs-6">
            <div class="be-checkbox">
            </div>
        </div>
        <div class="col-xs-6">
          <p class="text-right">
            <button type="submit" class="btn btn-space btn-primary btn-guardar-conei">Guardar</button>
          </p>
        </div>
      </div>
    </div>



  </div>
</div>

