<div class="col-sm-12">
  <div class="panel panel-default panel-table">
    </div>
    <div class="panel-body">
      <table class="table table-striped table-borderless">
        <thead>
          <tr>
            <th>Fila</th>
            <th>Representante</th>
            <th>Nivel</th>
            <th>Tipo documento</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Cargo</th>
          </tr>
        </thead>
        <tbody class="no-border-x">
          @foreach($listaoicvi as $index => $item)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$item->representante_nombre}}</td>
              <td>{{$item->nivel_nombre}}</td>
              <td>{{$item->tipo_documento_nombre}}</td>
              <td>{{$item->documento}}</td>
              <td>{{$item->nombres}}</td>
              <td>{{$item->cargo}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
