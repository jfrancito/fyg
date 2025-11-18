<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class OtroIntegranteApafa extends Model
{
    protected $table = 'otrointegranteapafas';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

}
