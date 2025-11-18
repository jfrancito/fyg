<div class="form-group" >
    <label class="col-sm-3 control-label">Contrato Anterior : </label>
    <div class="col-sm-6">
        <div class="input-group my-group">                                      
            <input  type="text"
                    id="contrato_anterior" name='contrato_anterior'                 
                    value="{{ old('contrato_anterior') }}"                                 
                    placeholder="Contrato Anterior"                                 
                    disabled 
                    maxlength="1000"                     
                    autocomplete="off" class="form-control input-sm" data-aw="7"/>
            <span class="input-group-btn">
              <button class="btn btn-primary btn_buscar_contrato"                              
                      data_nombre_m = 'contrato_anterior'
                      type="button" 
                      style="height: 37px;">
                      Buscar Contrato</button>
            </span>
        </div>
    </div>
</div>