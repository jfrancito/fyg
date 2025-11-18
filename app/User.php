<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps=false;


    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Modelos\Rol', 'rol_id', 'id');
    }

    public function control()
    {
        return $this->hasMany('App\Modelos\Control', 'doctor_id', 'id');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Modelos\Trabajador', 'trabajador_id', 'id');
    }


}
