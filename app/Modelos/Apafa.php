<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Apafa extends Model
{
    protected $table = 'apafas';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

    public function director()
    {
        return $this->belongsTo('App\Modelos\Director', 'director_id', 'id');
    }

}
