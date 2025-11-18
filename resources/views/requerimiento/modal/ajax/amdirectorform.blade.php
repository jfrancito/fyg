<div class="input-group my-group">

    <label class="control-label"><b>{{$item->nombre}} : <small class="obligatorio">(*) Obligatorio</small></b></label>

    <input  type="text"
            id="{{$item->codigo}}_nombres" name="{{$item->codigo}}_nombres"                          
            placeholder="{{$item->nombre}}"
            value = "{{$director_i_documento}} - {{$director_i_nombres}}"
            required = ""                   
            autocomplete="off" class="form-control input-sm {{$item->codigo}}_nombres" data-aw="4" readonly/>

    <span class="input-group-btn">
      <button class="btn btn-success editardirector"
              type="button" 
              style="margin-top: 26px;height: 38px;">
              Editar</button>
    </span>



    <input type="hidden" class='_i_representante_id' name="{{$item->codigo}}_i_representante_id" value="{{$director_i_representante_id}}" id = "{{$item->codigo}}_i_representante_id">
    <input type="hidden" class='_i_representante_nombre' name="{{$item->codigo}}_i_representante_nombre" value="{{$director_i_representante_nombre}}" id = "{{$item->codigo}}_i_representante_nombre">

    <input type="hidden" class='_i_tipodocumento_nombre' name="{{$item->codigo}}_i_tipodocumento_nombre" value="{{$director_i_tipodocumento_nombre}}" id = "{{$item->codigo}}_i_tipodocumento_nombre">
    <input type="hidden" class='_i_tipodocumento_id' name="{{$item->codigo}}_i_tipodocumento_id" value="{{$director_i_tipodocumento_id}}" id = "{{$item->codigo}}_i_tipodocumento_id">
    <input type="hidden" class='_i_documento' name="{{$item->codigo}}_i_documento" value="{{$director_i_documento}}" id = "{{$item->codigo}}_i_documento">
    <input type="hidden" class='_i_nombres' name="{{$item->codigo}}_i_nombres" value="{{$director_i_nombres}}" id = "{{$item->codigo}}_i_nombres">

</div>