<div class="container">
  <div class="main-content container-fluid">
          <div class="row">
            <div class="col-xs-12 col-md-3">

              <div class="widget be-loading" style="background-color: #eeefff;">
                <div class="panel-heading panel-heading-divider xs-pb-15" style="padding-top: 0px;font-size: 13px;"><b>CERTIFICADO X PERIODO</b>
                  <span class="badge badge-default cecer">{{count($listadatos)}}</span>
                </div>
                <div class="chart-legend">
                  <table>
                    @foreach($listacertificadoperiod as $index => $item)
                      <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2 primary" style="background: #f7d292;"></span></td>
                        <td>{{$item->periodo_nombre}} </td>
                        <td class="chart-legend-value"><span class="badge badge-primary">{{$item->cantidad}}</span></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div class="be-spinner">
                  <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-md-3">
              <div class="widget be-loading" style="background-color: #eeefff;">
                <div class="panel-heading panel-heading-divider xs-pb-15" style="padding-top: 0px;font-size: 13px;"><b>CERTIFICADO X PROCEDENCIA</b>
                  <span class="badge badge-default cecer">{{count($listadatos)}}</span>
                </div>
                <div class="chart-legend">
                  <table>
                    @foreach($listacertificadoproced as $index => $item)
                      <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2 primary" style="background: #f7d292;"></span></td>
                        <td>{{$item->procedencia->nombre}} </td>
                        <td class="chart-legend-value"><span class="badge badge-primary">{{$item->cantidad}}</span></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div class="be-spinner">
                  <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg>
                </div>
              </div>


            </div>

            <div class="col-xs-12 col-md-3">
              <div class="widget be-loading" style="background-color: #eeefff;">
                <div class="panel-heading panel-heading-divider xs-pb-15" style="padding-top: 0px;font-size: 13px;"><b>CERTIFICADO X ESTADOS</b>
                  <span class="badge badge-default cecer">{{count($listadatos)}}</span>
                </div>
                <div class="chart-legend">
                  <table>

                    @foreach($listacertificadoestado as $index => $item)
                      <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2 primary" style="background: #f7d292;"></span></td>
                        <td>{{$item->estado_nombre}} </td>
                        <td class="chart-legend-value"><span class="badge badge-primary">{{$item->cantidad}}</span></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div class="be-spinner">
                  <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-3">
              <div class="widget be-loading" style="background-color: #eeefff;">
                <div class="panel-heading panel-heading-divider xs-pb-15" style="padding-top: 0px;font-size: 13px;"><b>CERTIFICADO X DISTRITO</b>
                  <span class="badge badge-default cecer">{{count($listadatos)}}</span>
                </div>
                <div class="chart-legend">
                  <table>
                    @foreach($listacertificadodistrito as $index => $item)
                      <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2 primary" style="background: #f7d292;"></span></td>
                        <td>{{$item->distrito}} </td>
                        <td class="chart-legend-value"><span class="badge badge-primary">{{$item->cantidad}}</span></td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div class="be-spinner">
                  <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                  </svg>
                </div>
              </div>
            </div>
          </div>


  </div>
</div>


<table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7 listatabla">
  <thead>
    <tr>
      <th>ITEM</th>
      <th>CODIGO.</th>
      <th>INSTITUCION</th>
      <th>NIVEL</th>

      <th>PERIODO</th>
      <th>PROCEDENCIA</th>
      <th>FECHA CREA</th>
      <th>NRO TRAMITE</th>
      <th>OBSERVACION</th>      
      <th>DISTRITO</th>
      <th>ESTADO</th>
      <th>OPCION</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listadatos as $index => $item)
      <tr data_certificado_id = "{{$item->id}}">
        <td>{{$index +1}}</td>
        <td>{{$item->codigo}}</td>
        <td>{{$item->institucion->nombre}}</td>
        <td>{{$item->institucion->nivel}}</td>

        <td>{{$item->periodo_nombre}}</td>
        <td>{{$item->procedencia->nombre}}</td>
        <td>{{$item->fecha_crea}}</td>
        <td>{{$item->observacion}}</td> 
        <td>{{$item->numero_tramite}}</td>   
        <td>{{$item->distrito}}</td>
        <td>
          @include('requerimiento.ajax.estados')
        </td>
        <td class="rigth">
          <div class="btn-group btn-hspace">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu pull-right">
              <li>
                <a href="{{ url('/descargar-archivo-certificado/'.Hashids::encode(substr($item->id, -8)).'/'.Hashids::encode(substr($item->archivo_id, -8))) }}">
                  Descargar
                </a>  
              </li>
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