<!-- <div class="col-md-12">
  <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
    <div class="panel-heading panel-heading-divider"><b>REPRESENTANTE</b>
    </div>
    <div class="panel-body">
            @include('requerimiento.form.representante')
    </div>
  </div>
</div>   -->    

<div class="col-md-12">
  <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
    <div class="panel-heading panel-heading-divider"><b>REPRESENTANTES</b>
    </div>
    <div class="panel-body">
        <div class = 'listaajaxoi'>
          @include('requerimiento.ajax.alistaoiconei')
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="institucion_id" id = 'institucion_id' value='{{$institucion->id}}'>
