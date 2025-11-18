<table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7 listatabla">
  <thead>
    <tr>
      <th>ITEM</th>

      <th>COMPROBANTE</th>
      <th>DOCUMENTO</th>
      <th>CATEGORIA</th>




      <!-- <th>OBSERVACION</th>       -->
      <th>ESTADO</th>      
      <th>OPCION</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listadatos as $index => $item)
      <tr data_certificado_id = "{{$item->id}}">
        <td>{{$index +1}}</td>

        <td class="cell-detail sorting_1" style="position: relative;"> 
          <span><b>TRIMESTRE  : </b>{{$item->trimestre_nombre}}</span>
          <span><b>FECHA : </b>{{date_format(date_create($item->fecha_comprobante), 'd-m-Y')}} </span> 
          <span><b>TIPO  : </b>{{$item->tipo_comprobante_nombre}}</span>
          <span><b>NUMERO  : </b>{{$item->serie}}-{{$item->numero}}</span>
        </td>

        <td class="cell-detail sorting_1" style="position: relative;"> 
          <span><b>TIPO : </b>{{$item->tipo_documento_nombre}} </span> 
          <span><b>NUMERO  : </b>{{$item->dni}}</span>
          <span><b>RAZON SOCIAL  : </b>{{$item->razon_social}}</span>
        </td>


        <td class="cell-detail sorting_1" style="position: relative;"> 
          <span><b>CONCEPTO : </b>{{$item->tipo_concepto_nombre}}</span> 
          <span><b>DETALLE : </b>{{$item->detalle_concepto}}</span> 
          <span><b>NUMERO DEPOSITO BANCARIO : </b>{{$item->numero_deposito_bancario}}</span>          
          <span><b>TOTAL : </b>{{number_format($item->total, 2)}}</span>    
        </td>

        <!-- <td>{{$item->observacion}}</td>         -->
        <td>
          @if($item->estado_id=='ESIN00000001')
            <span class="badge badge-light">{{$item->estado_nombre}}</span>
          @else
            @if($item->estado_id=='ESIN00000002')
              <span class="badge badge-success">{{$item->estado_nombre}}</span><br>            
            @endiF
          @endiF
        </td>        
        <td class="rigth">
          <div class="btn-group btn-hspace">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu pull-right">              
              @if(isset($item->archivo_id))
              <li>
                <a href="{{ url('/descargar-archivo-ingreso/'.$idopcion.'/'.Hashids::encode(substr($item->archivo_id, -8))) }}">
                  Descargar
                </a>  
              </li>              
              @endif
              @if($item->estado_id == 'ESIN00000001') 
                <li>
                  <a href="{{ url('/modificar-ingreso/'.$idopcion.'/'.Hashids::encode(substr($item->id, -8))) }}">
                    Modificar
                  </a>  
                </li>
              @endif
              @if($item->estado_id == 'ESIN00000001') 
                <li>
                  <a href="{{ url('/emitir-ingreso/'.$idopcion.'/'.Hashids::encode(substr($item->id, -8))) }}">
                    Emitir
                  </a>  
                </li>
              @endif
            </ul>
          </div>
        </td>
      </tr>                    
    @endforeach


  </tbody>
</table>

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif