
<div class="modal-header" style="padding: 12px 20px;">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
	<div class="col-xs-12">
		<h5 class="modal-title" style="font-size: 1.2em;">
			CERITIFICADO
		</h5>
	</div>
</div>
<div class="modal-body">

	<div class="scroll_text scroll_text_heigth_aler" style = "padding: 0px !important;"> 
	<table class="table table-condensed table-striped">
	    <tbody>
	      	<tr>
	      	   <td><b>NRO ORDEN</b></td>
	      	   <td>FALTA</td>
	      	</tr>    
	      	<tr>
	      	   <td><b>REGION</b></td>
	      	   <td>{{$institucion->departamento}}</td>
	      	</tr>  
	      	<tr>
	      	   <td><b>PROVINCIA</b></td>
	      	   <td>{{$institucion->provincia}}</td>
	      	</tr>  
	      	<tr>
	      	   <td><b>DISTRITO/P.J/CENTRO POBLADO </b></td>
	      	   <td>{{$institucion->distrito}}</td>
	      	</tr>  
	      	<tr>
	      	   <td><b>INSTITUCIÓN EDUCATIVA </b></td>
	      	   <td>{{$institucion->nombre}}</td>
	      	</tr>  
	      	<tr>
	      	   <td><b>DIRECTORA </b></td>
	      	   <td>{{$director->nombres}}</td>
	      	</tr>  
	      	<tr>
	      	   <td><b>DIRECCION </b></td>
	      	   <td>{{$institucion->direccion}}</td>
	      	</tr>  
	    </tbody>
	</table>

	<table class="table table-condensed table-striped">
	    <tbody>
	      	<tr>
	      	   <td colspan="4" style="text-align: center;"><b>CONSEJO DIRECTIVO </b></td>
	      	</tr>  
	      	<tr>
	      	   <td class=""><b>REPRESENTANTE </b></td>
      		 	 <td class=""><b>NIVEL </b></td>

	      		 <td class=""><b>DOCUMENTO </b></td>
	      	   <td class=""><b>NOMBRES Y APELLIDOS </b></td>
	      	   <td class=""><b>CARGO </b></td>
	      	</tr> 

          @foreach($array_detalle_producto as $index => $item)
            <tr>
            	<td class="">{{$item['representante_txt']}}</td>
            	<td class="">{{$item['niveltexto']}}</td>
            	<td class="">{{$item['documentog']}}</td>
              <td class="">{{$item['nombresg']}}</td>
              <td class="">{{$item['dcargoni']}}</td>

            </tr>
          @endforeach
	    </tbody>
	</table>




	</div>
</div>

<div class="modal-footer">

	<button type="button" data-dismiss="modal" class="btn btn-default btn-space modal-close">Cerrar</button>
	<button type="submit" data-dismiss="modal" class="btn btn-success btn-confirmar">Confirmar</button>


</div>




