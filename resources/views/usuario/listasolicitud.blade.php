@extends('template_lateral')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/buttons.dataTables.min.css') }} "/>
@stop
@section('section')
  <div class="be-content">
    <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-success">
                <div class="panel-heading">Lista de Usuarios
                  <div class="tools">
                    <a href="{{ url('/agregar-usuario/'.$idopcion) }}" data-toggle="tooltip" data-placement="top" title="Crear Usuario">
                      <span class="icon mdi mdi-plus-circle-o"></span>
                    </a>
                  </div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>Institucion</th> 
                        <th>Codigo Local</th>  
                        <th>Tipo Institucion</th>
                        <th>Dni Director</th>
                        <th>Nombre Director</th>
                        <th>Celular Director</th>
                        <th>Correo Director</th>
                        <th>Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($listasolicitud as $item)
                        <tr>
                            <td>{{$item->nombre}} </td>
                            <td>{{$item->codigo_local}} </td>

                            <td class="cell-detail sorting_1" style="position: relative;">
                              <span><b>Real : {{$item->tireal}} </b> </span>
                              <span><b>Nuevo  : {{$item->tipoo_instituccion}}</b></span>
                            </td>
                            <td class="cell-detail sorting_1" style="position: relative;">
                              <span><b>Real : {{$item->dni}} </b> </span>
                              <span><b>Nuevo  : {{$item->dni_director}}</b></span>
                            </td>
                            <td class="cell-detail sorting_1" style="position: relative;">
                              <span><b>Real : {{$item->nombres}} </b> </span>
                              <span><b>Nuevo  : {{$item->nombres_director}}</b></span>
                            </td>
                            <td class="cell-detail sorting_1" style="position: relative;">
                              <span><b>Real : {{$item->telefono}} </b> </span>
                              <span><b>Nuevo  : {{$item->telefono_director}}</b></span>
                            </td>
                            <td class="cell-detail sorting_1" style="position: relative;">
                              <span><b>Real : {{$item->correo}} </b> </span>
                              <span><b>Nuevo  : {{$item->correo_director}}</b></span>
                            </td>
                            <td class="rigth">
                              <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                  <li>
                                    <a href="{{ url('/enviar-correo-solicitud/'.$idopcion.'/'.Hashids::encode(substr($item->idreal, -8))) }}">
                                      Enviar Correo
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/descargar-archivo-resolucion/'.Hashids::encode(substr($item->idreal, -8))) }}">
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

@stop

@section('script')

  <script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/jszipoo.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/vfs_fonts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-tables-datatables.js?v='.$version) }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.dataTables();
      $('[data-toggle="tooltip"]').tooltip(); 
    });
  </script> 
@stop