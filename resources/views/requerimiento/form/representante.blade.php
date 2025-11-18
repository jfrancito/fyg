
<input type="hidden" name="institucion_id" id = 'institucion_id' value='{{$institucion->id}}'>

@foreach($lrepresentantes as $index => $item)
  @if($item->id != 'ESRP00000009')
    @if($item->id == 'ESRP00000001')
      <div class="col-sm-6 ajax_input_director itemrepresentante" data_obligatorio='1'>
          @include('requerimiento.modal.ajax.amdirectorform')
      </div>
    @else
      <div class="col-sm-6 itemrepresentante" 
        data_nombre_section   = "{{$item->nombre}}"
        data_obligatorio   = "@if(in_array($item->id, $arrayrepresentante)) 1 @else 0 @endif"
      >
        <div class="input-group my-group">

            <label class="control-label"><b>{{$item->nombre}} : <small class="obligatorio">
              @if(in_array($item->id, $arrayrepresentante))
                (*) Obligatorio
              @endif
            </small></b></label>

            <input  type="text"
                    id="{{$item->codigo}}_nombres" name="{{$item->codigo}}_nombres"                          
                    placeholder="{{$item->nombre}}"                  
                    autocomplete="off" 
                    class="form-control input-sm {{$item->codigo}}_nombres" 
                    data-aw="4" 
                    readonly = 'readonly'
                    @if(in_array($item->id, $arrayrepresentante))
                      required
                    @endif
                    />

            <span class="input-group-btn">
              <button class="btn btn-success modal-registro-oi btn-plus"
                      data_representante_id='{{$item->id}}'
                      type="button" 
                      style="margin-top: 26px;height: 38px;">
                      <span class="mdi mdi-plus-circle" style="font-size: 18px;"></span></button>
            </span>

            <span class="input-group-btn">
              <button class="btn btn-primary modal-registro-variable btn-buscar"
                      data_rp_id_val        = "{{$item->id}}"
                      data_rp_no_val        = "{{$item->nombre}}"
                      data_rp_id            = "{{$item->codigo}}_i_representante_id"
                      data_rp_no            = "{{$item->codigo}}_i_representante_nombre"
                      data_td_id            = "{{$item->codigo}}_i_tipodocumento_id"
                      data_td_no            = "{{$item->codigo}}_i_tipodocumento_nombre"
                      data_docu             = "{{$item->codigo}}_i_documento"
                      data_nombre           = "{{$item->codigo}}_i_nombres"
                      data_cod_modular      = "{{$item->codigo}}_i_codigo_modular"
                      data_nivel            = "{{$item->codigo}}_i_nivel"

                      data_nombre_visible   = "{{$item->codigo}}_nombres"
                      data_titulo = '{{$item->nombre}}'
                      type="button" 
                      style="margin-top: 26px;height: 38px;">
                      Buscar</button>
            </span>

            <input type="hidden" class='_i_representante_id' name="{{$item->codigo}}_i_representante_id" id = "{{$item->codigo}}_i_representante_id">
            <input type="hidden" class='_i_representante_nombre' name="{{$item->codigo}}_i_representante_nombre" id = "{{$item->codigo}}_i_representante_nombre">
            <input type="hidden" class='_i_tipodocumento_nombre' name="{{$item->codigo}}_i_tipodocumento_nombre" id = "{{$item->codigo}}_i_tipodocumento_nombre">
            <input type="hidden" class='_i_tipodocumento_id' name="{{$item->codigo}}_i_tipodocumento_id" id = "{{$item->codigo}}_i_tipodocumento_id">
            <input type="hidden" class='_i_documento' name="{{$item->codigo}}_i_documento" id = "{{$item->codigo}}_i_documento">
            <input type="hidden" class='_i_nombres' name="{{$item->codigo}}_i_nombres" id = "{{$item->codigo}}_i_nombres">

            <input type="hidden" class='_i_codigo_modular' name="{{$item->codigo}}_i_codigo_modular" id = "{{$item->codigo}}_i_codigo_modular">
            <input type="hidden" class='_i_nivel' name="{{$item->codigo}}_i_nivel" id = "{{$item->codigo}}_i_nivel">

        </div>
      </div>
    @endif
  @endif
@endforeach



