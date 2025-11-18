<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';
    public $timestamps=false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    
}
