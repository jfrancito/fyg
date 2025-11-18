<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';
    

    public function scopeIdBuscar($query,$registro_id){
        if(trim($registro_id) != ''){
            $query->where('id','!=',$registro_id);
        }
    }


}
