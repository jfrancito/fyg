<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    protected $table = 'trimestres';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';
    
}