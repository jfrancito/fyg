<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

}
