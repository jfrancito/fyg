<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleInstitucion extends Model
{
    protected $table = 'detalleinstituciones';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

}
