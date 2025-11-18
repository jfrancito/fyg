<div class="col-sm-12">
  <div class="panel panel-default panel-table">
    <div class="panel-heading">
      <p class="xs-mt-10 xs-mb-10 cto">
          @foreach($robligatorios as $index => $item)

            <a class="btn tag_obligado btn-rounded btn-space @if(count($array_detalle_producto)<=0) btn-default @endif
            @foreach($array_detalle_producto as $index2 => $item2)
              @if($item->id == $item2['representante_id'])
                btn-success
              @else
                btn-default
              @endif
            @endforeach
            "   data_nombre_section='{{$item->nombre}}'>
                {{$item->nombre}}
            </a>
          @endforeach
      </p>
      <div class="tools">
        <button class="btn btn-rounded btn-space btn-success modal-registro-oi" data_representante_id='ESRP00000009'>Agregar</button>
      </div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-borderless totrosrepresentante">
        <thead>
          <tr>
            <th>Fila</th>
            <th>Representante</th>
            <th>Nivel</th>
            <th>Tipo documento</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th class="center">Accion</th>
          </tr>
        </thead>
        <tbody class="no-border-x">
          @foreach($array_detalle_producto as $index => $item)
            <tr t_nivel="{{$item['codigo_modular_id']}}" t_representante_id="{{$item['representante_id']}}" t_documento="{{$item['documentog']}}">
              <td>{{$index+1}}</td>
              <td><b>{{$item['representante_txt']}}</b></td>
              <td>{{$item['niveltexto']}}</td>
              <td>{{$item['tdgtexto']}}</td>
              <td>{{$item['documentog']}}</td>
              <td>{{$item['nombresg']}}</td>
              <td>{{$item['dcargoni']}}</td>
              <td>
                @if($item["representante_id"]!='ESRP00000001')

                  <button class="btn btn-danger eliminaroi"
                          type="button" 
                          data-fila= "{{$item['fila']}}"
                          style="text-align: center;margin: 0 auto;">
                          Eliminar</button>
                @else
                  <button class="btn btn-success editardirector"
                          type="button" 
                          style="text-align: center;margin: 0 auto;">
                          Editar</button>
                @endif
              </td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<input type="hidden" name="array_detalle_producto" id='array_detalle_producto' value='{{json_encode($array_detalle_producto)}}'>