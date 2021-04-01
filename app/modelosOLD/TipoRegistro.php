<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoRegistro extends Model
{
    protected $table = 'tiporegistros';

    protected $fillable = [
        'name',
    ];


    // Relacion de uno a muchos
    public function user(){
        return $this->hasMany('App\User', 'tiporegistro_id');
    }

    public function pagos(){
        return $this->hasMany('App\Pago');
    }
    public function documentos(){
        return $this->hasMany('App\Documento');
    }

    public function certificados(){
        return $this->hasMany('App\Certificado');
    }

    public function conferencias(){
        return $this->hasMany('App\ConferenciasyTrabajos');
    }

    // recertificado

    public function recertcertificados(){
        return $this->hasMany('App\RecertCertificado');
    }

    public function recertconstancias(){
        return $this->hasMany('App\RecertConstancia');
    }


    public function admin(){
        return $this->belongsTo('App\Admin', 'user_id');
    }
    public function userpost(){
        return $this->belongsTo('App\UserPost', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}


