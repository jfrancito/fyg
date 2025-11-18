<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class RolOpcion extends Model
{
    protected $table = 'rolopciones';
    public $timestamps=false;
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';


    public function opcion()
    {
        return $this->belongsTo('App\Modelos\Opcion', 'opcion_id', 'id');
    }

    public function rol()
    {
        return $this->belongsTo('App\Modelos\Rol', 'rolopcion_id', 'rolopcion_id');
    }



}
