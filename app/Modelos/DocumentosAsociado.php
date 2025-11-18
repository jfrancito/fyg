<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DocumentosAsociado extends Model
{
    protected $table = 'documentosasociados';
    public $timestamps=false;
    protected $primaryKey = 'id';
	public $incrementing = false;
	public $keyType = 'string';





}
