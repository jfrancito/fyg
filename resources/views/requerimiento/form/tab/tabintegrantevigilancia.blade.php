  
<div class="col-md-12">
  <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
    <div class="panel-heading panel-heading-divider"><b>CONSEJO VIGILANCIA</b>
    </div>
    <div class="panel-body">
        <div class = 'listaajaxoivi'>
          @include('requerimiento.ajax.alistaoiapafavi')
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="institucion_id" id = 'institucion_id' value='{{$institucion->id}}'>
