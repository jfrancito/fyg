<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Grupoopcion extends Model
{
    protected $table = 'grupoopciones';
    public $timestamps=false;


    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

    public function opcion()
    {
        return $this->hasMany('App\Modelos\Opcion', 'grupoopcion_id', 'id');
    }


}
