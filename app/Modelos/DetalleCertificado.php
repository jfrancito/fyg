<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleCertificado extends Model
{
    protected $table = 'detallecertificados';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';


    public function institucion()
    {
        return $this->belongsTo('App\Modelos\Institucion', 'institucion_id', 'id');
    }


    public function periodo()
    {
        return $this->belongsTo('App\Modelos\Estado', 'periodo_id', 'id');
    }

    public function periodoinicio()
    {
        return $this->belongsTo('App\Modelos\Estado', 'periodoinicio_id', 'id');
    }

    public function periodofin()
    {
        return $this->belongsTo('App\Modelos\Estado', 'periodofin_id', 'id');
    }



    public function procedencia()
    {
        return $this->belongsTo('App\Modelos\Estado', 'procedente_id', 'id');
    }





    public function scopePeriodo($query,$periodo_id){
        if(trim($periodo_id) != 'TODO'){
            $query->where('periodo_id','=',$periodo_id);
        }
    }

    public function scopeProcedencia($query,$procedencia_id){
        if(trim($procedencia_id) != 'TODO'){
            $query->where('procedente_id','=',$procedencia_id);
        }
    }

    public function scopeEstado($query,$estado_id){
        if(trim($estado_id) != 'TODO'){
            $query->where('estado_id','=',$estado_id);
        }
    }

    public function scopeEstadoOriginal($query,$estado_id){
        if(trim($estado_id) != 'TODO'){
            $query->where('estado_id','=',$estado_id);
        }else{
            $query->whereIn('estado_id',['CEES00000001','CEES00000005','CEES00000007','CEES00000008']);
        }
    }




}
