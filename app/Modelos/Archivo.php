<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';

}
