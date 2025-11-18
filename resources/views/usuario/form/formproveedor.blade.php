<h5 class='mensaje'>{{$mensaje}}</h5>
<input type="hidden" name="idactivo" id='idactivo' value = '{{$idactivo}}'>
<div class='inputr'>
  <div class="control-label">Institucion Educativa <span class='requerido'>*</span>:</div>
  <div class="abajocaja">
    <input  type="text"
            id="institucion" name='institucion' 
            value="@if(isset($institucion)){{old('institucion' ,$institucion->nombre)}}@else{{old('institucion')}}@endif"
            placeholder="Institucion Educativa"
            required = ""
            autocomplete="off" class="form-control input-sm" data-aw="4" readonly/>

  </div>
</div>

<div class='inputr'>
  <div class="control-label">Nivel <span class='requerido'>*</span>:</div>
  <div class="abajocaja">
    <input  type="text"
            id="nivel" name='nivel' 
            value="@if(isset($institucion)){{old('nivel' ,$institucion->nivel)}}@else{{old('nivel')}}@endif"
            placeholder="Dirección Fiscal"
            required = ""
            autocomplete="off" class="form-control input-sm" data-aw="4" readonly/>

  </div>
</div>

<div class='inputr'>
  <div class="control-label">Direccion <span class='requerido'>*</span>:</div>
  <div class="abajocaja">
    <input  type="text"
            id="direccion" name='direccion' 
            value="@if(isset($institucion)){{old('direccion' ,$institucion->direccion)}}@else{{old('direccion')}}@endif"
            placeholder="Dirección Fiscal"
            required = ""
            autocomplete="off" class="form-control input-sm" data-aw="4" readonly/>

  </div>
</div>


<div class='inputr'>
  <div class="control-label">Tipo Institucion <span class='requerido'>*</span>:</div>
  <div class="abajocaja">
          {!! Form::select( 'tipo_institucion', $combo_tipo_institucion, $sel_tipo_institucion,
                            [
                              'class'       => 'select form-control control input-xs' ,
                              'id'          => 'tipo_institucion',
                              'required'    => '',
                              'data-aw'     => '1'
                            ]) !!}

  </div>
</div>

<div class='inputr'>
  <div class="control-label">Contraseña : (entre 8 a 20 caracteres) <span class='requerido'>*</span>:</div>
  <div class="abajocaja">

    <input  type="password"
            id="lblcontrasena" name='lblcontrasena' value="{{ old('lblcontrasena') }}" placeholder="Ingresa una contraseña"
            required = ""
            data-parsley-minlength="8"
            data-parsley-maxlength="20"
            autocomplete="off" 
            data-parsley-equalto="#lblcontrasenaconfirmar"
            class="form-control textpucanegro fuente-recoleta-regular input-sm"
            data-aw="1"/>


  </div>
</div>

<div class='inputr'>
  <div class="control-label">Confirmar Contraseña <span class='requerido'>*</span>:</div>
  <div class="abajocaja">

      <input  type="password"
              id="lblcontrasenaconfirmar" name='lblcontrasenaconfirmar' value="{{ old('lblcontrasenaconfirmar') }}" placeholder="Confirmar contraseña"
              required = ""
              autocomplete="off"
              data-parsley-equalto="#lblcontrasena"
              class="form-control textpucanegro fuente-recoleta-regular input-sm"
              data-aw="1"/>


  </div>
</div>



<input type="hidden" name="institucion_id"  value="@if(isset($institucion)){{old('institucion_id' ,$institucion->id)}}@else{{old('institucion_id')}}@endif">