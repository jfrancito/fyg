<div class="form-group" >
    <label class="col-sm-3 control-label">Trimestre : </label>
    <div class="col-sm-6">
        <input  type="text"
                id="trimestre_nombre" name='trimestre_nombre'                 
                value="@if(isset($trimestre_nombre)){{old('trimestre_nombre' ,$trimestre_nombre)}}@else{{old('trimestre_nombre')}}@endif"
                value="{{ old('trimestre_nombre') }}"                                                       
                placeholder="Trimestre"                 
                required = ""
                disabled 
                maxlength="500"                     
                autocomplete="off" class="form-control input-sm nro_tramite" data-aw="0"/>
    </div>
</div>


