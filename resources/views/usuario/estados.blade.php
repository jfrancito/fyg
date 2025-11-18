@if($estado=='APROBADO')
	<span class="label label-success">{{$estado}}</span>
@else
	@if($estado=='NOTIFICADO' || $estado=='EN PROCESO' || $estado=='EN PROCESO')
		<span class="label label-warning">{{$estado}}</span>
	@else
		<span class="label label-danger">{{$estado}}</span>
	@endif
@endif
