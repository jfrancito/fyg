<table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7 listatabla">
  <thead>
    <tr>
      <th>ITEM</th>
      <th>EMPRESA</th>
      <th>RUC PROVEEDOR</th>
      <th>PROVEEDOR</th>
      <th>PERIODO</th>
      <th>FECHA_EMISION</th>
      <th>TIPO DOCUMENTO</th>
      <th>DOCUMENTO</th>
      <th>TOTAL</th>
      <th>SUNAT PDF</th>
      <!-- <th>OPCION</th> -->
    </tr>
  </thead>
  <tbody>
    @foreach($listadatos as $index => $item)
      <tr data_requerimiento_id = "{{$item->ID}}">
        <td>{{$index + 1}}</td>
        <td>{{$item->TXT_EMPRESA}}</td>
        <td>{{$item->RUC_EMPRESA_PROVEEDOR}}</td>
        <td>{{$item->TXT_EMPRESA_PROVEEDOR}}</td>
        <td>{{$item->PERIODO}}</td>
        <td>{{date_format(date_create($item->FECHA_EMISION), 'd-m-Y')}}</td>
        <td>{{$item->TXT_TIPODOCUMENTO}}</td>
        <td>{{$item->SERIE}} - {{$item->NUMERO}}</td>
        <td>{{$item->TOTAL}}</td>
        <td> 
            @if($item->IND_PDF == 1)  
              <span class="icon mdi mdi-check"></span> 
            @else 
              <span class="icon mdi mdi-close"></span> 
            @endif
        </td>
<!--         <td class="rigth">
          <div class="btn-group btn-hspace">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu pull-right">
              <li>
                <a href="{{ url('/detalle-comprobante-oc-validado/'.$idopcion.'/'.$item->ID) }}">
                    Descargar
                </a>
              </li>
            </ul>
          </div>
        </td> -->
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