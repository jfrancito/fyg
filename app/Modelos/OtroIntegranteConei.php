<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class OtroIntegranteConei extends Model
{
    protected $table = 'otrointegranteconeis';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

}
