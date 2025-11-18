<div class="tab-container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#conei" class="conei" data-toggle="tab"><b> RGISTRO CONEI </b></a></li>
    <!-- <li><a href="#archivo" class="conei" data-toggle="tab"><b> EXPEDIENTES </b></a></li> -->
  </ul>
  <div class="tab-content">
    <div id="conei" class="tab-pane active cont">
      <div class="col-md-12">
        <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
          <div class="panel-heading panel-heading-divider"><b>PERIODO</b>
          </div>
          <div class="panel-body">

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label"><b>Periodo : </b></label>
                    <input  type="text"
                            id="director_nombres" name='director_nombres' 
                            value="{{$conei->periodo_nombre}}"                         
                            required = ""                   
                            autocomplete="off" class="form-control input-sm director_nombres" data-aw="4" readonly/>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label class="control-label">Estado : </label>

                    {!! Form::select( 'estado_id', $comboestado, array($selectestado),
                                      [
                                        'class'       => 'form-control control select2 aestado_id' ,
                                        'id'          => 'estado_id',
                                        'required'    => '',
                                        'data-aw'     => '3'
                                      ]) !!}

                </div>
              </div>

            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group bajaextorno  @if($selectestado <> 'CEES00000008') ocultar @endif">
                <label class=" control-label">Motivo de Observacion :</label>

                      <textarea 
                      name="descripcion"
                      id = "descripcion"
                      class="form-control input-sm validarmayusculas"
                      rows="5" 
                      cols="50"    
                      data-aw="2"></textarea>

              </div>
              <div class="form-group sectioncargarimagen iaprobado @if($selectestado <> 'CEES00000001') ocultar @endif">
                  <label class="control-label">Certificado :</label>
                      <div class="file-loading">
                          <input id="file-es" name="certificado[]" class="file-es" type="file" multiple data-max-file-count="1">
                      </div>
              </div>
            </div>



            <div class="col-xs-12">
              <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary btn-agregar-certificado">Guardar</button>
              </p>
            </div>



          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
          <div class="panel-heading panel-heading-divider"><b>REPRESENTANTES</b>
          </div>
          <div class="panel-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('requerimiento.lista.ajax.alistaoidetconei')
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-12">
        <div class="panel panel-default" style="border: 3px solid #EEEEEE;">
          <div class="panel-heading panel-heading-divider"><b>ARCHIVOS</b>
          </div>
          <div class="panel-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7 listatabla">
            <thead>
              <tr>
                <th>Nro</th>
                <th>Descripcion</th>      
                <th>Extension</th>      
                <th>Tamaño(MB)</th>      
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($larchivos as $index => $item)
                <tr data_precotizacion_id = "{{$item->id}}">
                  <td>{{ $index+1 }}</td>
                  <td class="cell-detail" >
                    <span><b>Lote : </b> {{$item->lote}}</span>
                    <span><b>Fecha Subida: </b> {{date_format(date_create($item->fecha_crea), 'd-m-Y H:i')}} </span>
                    <span><b>Nombre Documento : </b> {{$item->nombre_doc}} </span>
                    <span><b>Periodo : </b> {{$item->periodo_nombre}} </span>
                  </td>
                  <td>
                    <img src="{{ asset('/public/img/icono/'.$item->extension.'.png')}}" width="40px" height="50px" alt="{{ $item->extension }}">
                  </td>
                  <td>
                    {{ round($item->size/pow(1024,$unidad),2) }}
                  </td>


                  <td class="rigth">
                    <div class="btn-group btn-hspace">
                      <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                      <ul role="menu" class="dropdown-menu pull-right">
                        <li>
                          <a href="{{ url('/descargar-archivo-requerimiento/'.$idopcion.'/'.Hashids::encode(substr($item->id, -8)).'/'.Hashids::encode(substr($item->id, -8))) }}">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

