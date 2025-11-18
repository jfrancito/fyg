




<div class='inputr'>

      <div class="input-group my-group">
          <label class="control-label cblanco">DNI <span class='requerido'>*</span>:</label>
		   <input  type="text"
		            id="dni" name='dni' 
		            value="@if(isset($director)){{old('dni' ,$director->dni)}}@else{{old('dni')}}@endif"
		            placeholder="Dni"
		            required = ""
		            autocomplete="off" class="form-control input-sm" data-aw="4" readonly/>

            <span class="input-group-btn">
              <button class="btn btn-success btn_buscar_dni_oi"
                      data_dni_m = 'documentogoi'
                      data_nombre_m = 'nombresgoi'
                      type="button" 
                      style="margin-top: 23px;height: 37px;">
                      Buscar Reniec</button>
            </span>
      </div>


</div>

<div class='inputr'>
  <div class="control-label cblanco">Nombre <span class='requerido'>*</span>:</div>
  <div class="abajocaja">

    <input  type="text"
            id="nombre" name='nombre' 
            value="@if(isset($director)){{old('nombre' ,$director->nombres)}}@else{{old('nombre')}}@endif"
            placeholder="Nombre"
            required = ""
            autocomplete="off" class="form-control input-sm" data-aw="4" readonly/>

  </div>
</div>

<div class='inputr'>
  <div class="control-label cblanco">Celular <span class='requerido'>*</span>:</div>
  <div class="abajocaja">

    <input  type="text"
            id="lblcelular" name='lblcelular' 
            value="@if(isset($director)){{old('lblcelular' ,$director->telefono)}}@else{{old('lblcelular')}}@endif"
            placeholder="Ingrese su celular"
            required = ""
            data-parsley-type="number"
            autocomplete="off" 
            class="form-control textpucanegro fuente-recoleta-regular input-sm"
            data-aw="1" readonly/>

  </div>
</div>
<div class='inputr'>
  <div class="control-label cblanco">Correo electronico <span class='requerido'>*</span>:</div>
  <div class="abajocaja">

    <input  type="email"
            id="lblemail" name='lblemail' 
            value="@if(isset($director)){{old('lblcelular' ,$director->correo)}}@else{{old('lblcelular')}}@endif"
            placeholder="Ingresa tu correo electronico"
            required = ""
            autocomplete="off" 
            class="form-control textpucanegro fuente-recoleta-regular input-sm"
            data-aw="1" readonly/>

  </div>
</div>

<div class='inputr'>
  <div class="control-label cblanco">Confirmar Correo electronico <span class='requerido'>*</span>:</div>
  <div class="abajocaja">

    <input  type="email"
            id="lblconfirmaremail" name='lblconfirmaremail' 
            value="@if(isset($director)){{old('lblcelular' ,$director->correo)}}@else{{old('lblcelular')}}@endif"
            placeholder="Ingresa confirmacion de correo electronico"
            required = ""
            autocomplete="off" 
            data-parsley-equalto="#lblemail"
            class="form-control textpucanegro fuente-recoleta-regular input-sm"
            data-aw="1" readonly/>

  </div>
</div>



