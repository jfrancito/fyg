
<div class="container">
  <div class="main-content container-fluid">
          <div class="row">
            <div class="col-xs-12 col-md-4">

              <div class="widget be-loading" style="background-color: #eeefff;">
                <div class="panel-heading panel-heading-divider xs-pb-15" style="padding-top: 0px;font-size: 13px;"><b>CERTIFICADO RESUMEN</b>
                  <span class="badge badge-default cecer">{{count($listaiscertificado)}}</span>
                </div>
                <div class="chart-legend">
                  <table>
                      <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2 primary" style="background: #f7d292;"></span></td>
                        <td>TOTAL INSTITUCIONES</td>
                        <td class="chart-legend-value"><span class="badge badge-primary">{{count($listainstituciones)}}</span></td>
                      </tr>

                      <tr>
                        <td class="chart-legend-color"><span data-color="top-sales-color2 primary" style="background: #f7d292;"></span></td>
                        <td>INSTITUCIONES SIN CERTIFICADO</td>
                        <td class="chart-legend-value"><span class="badge badge-primary">{{count($listaiscertificado)}}</span></td>
                      </tr>


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
                  <span class="badge badge-default cecer">{{count($listaiscertificado)}}</span>
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
      <th>DISTRITO</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listaiscertificado as $index => $item)
      <tr data_certificado_id = "{{$item->id}}">
        <td>{{$index +1}}</td>
        <td>{{$item->codigo}}</td>
        <td>{{$item->nombre}}</td>
        <td>{{$item->nivel}}</td>

        <td>{{$periodo->nombre}}</td>
        <td>{{$procedencia->nombre}}</td>
        <td>{{$item->fecha_crea}}</td>
        <td>{{$item->distrito}}</td>
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