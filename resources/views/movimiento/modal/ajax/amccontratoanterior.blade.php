
<div class="modal-header" style="padding: 12px 20px;">
  <button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
  <div class="col-xs-12">
    <h5 class="modal-title" style="font-size: 1.2em;">
      CONTRATOS ANTERIORES
    </h5>
  </div>
</div>
<div class="modal-body">

  <div class="scroll_text scroll_text_heigth_aler" style = "padding: 0px !important;"> 

    <table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7 listatabla">
      <thead>
        <tr>
          <th></th>
          <th>COMPROBANTE</th>
          <th>NOMBRE ARCHIVO</th>
          <th>DESCARGAR</th>          
        </tr>
      </thead>
      <tbody>
        @foreach($listadatos as $index => $item)
          <tr data_contrato_id = "{{$item->archivo_contrato_id}}">
            <td >  
              <div class="text-center be-checkbox be-checkbox-sm" >
                <input  type="checkbox"
                        class="{{Hashids::encode(substr($item->archivo_contrato_id, -8))}} input_check_pe_ln check{{Hashids::encode(substr($item->archivo_contrato_id, -8))}}" 
                        id="{{Hashids::encode(substr($item->archivo_contrato_id, -8))}}"   
                        data-nombre-file = "{{$item->nombre_archivo}}"                     
                >
                <label  for="{{Hashids::encode(substr($item->archivo_contrato_id, -8))}}"
                      data-atr = "ver"
                      class = "checkbox"                    
                      name="{{Hashids::encode(substr($item->archivo_contrato_id, -8))}}">
                </label>
              </div>
            </td>
            <td class="cell-detail sorting_1" style="position: relative;"> 
              <span><b>NUMERO  : </b>{{$item->serie}}-{{$item->numero}}</span>
              <span><b>FECHA : </b>{{date_format(date_create($item->fecha_comprobante), 'd-m-Y')}} </span> 
              <span><b>TOTAL : </b>{{number_format($item->total, 2)}}</span>
            </td>            
            <td>{{$item->nombre_archivo}}</td>
            <td class="rigth">
              <a href="{{ url('/descargar-archivo-contrato/'.$idopcion.'/'.Hashids::encode(substr($item->archivo_contrato_id, -8))) }}" target="_blank">
                <button type="button" class="btn btn-space btn-default"><i class="icon icon-left mdi mdi-download"></i> Descargar</button>
              </a>              
            </td>
          </tr>                    
        @endforeach
      </tbody>
    </table>



  </div>
</div>

<div class="modal-footer">

  <button type="button" data-dismiss="modal" class="btn btn-default btn-space modal-close">Cerrar</button>
  <button type="submit" data-dismiss="modal" class="btn btn-success btn-confirmar btn_asignar_contrato_ant">Confirmar</button>


</div>



