<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $table = 'directores';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';


    public function conei()
    {
        return $this->hasMany('App\Modelos\Conei', 'director_id', 'id');
    }


}
