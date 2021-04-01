<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Admin as Authenticatable;

class Admin extends Model
{

    use Notifiable;

    protected $table = 'administradores';

    protected $fillable = [
        'name', 'surname', 'role', 'email',
        'password', 'tiporegistro_id', 'estado',
        'idioma', 'pais', 'pasaporte', 'fecha_nac',
        'edad', 'lugar_nac', 'nacionalidad', 'telefono',
        'direccion', 'cod_postal', 'rrss_facebook',
        'rrss_instagram', 'rrss_twitter', 'image'
];

 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relacion de uno a muchos


    public function users(){
        return $this->hasMany('App\User');
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

    public function miembros(){
        return $this->hasMany('App\Miembro');
    }

    public function tiporegistros(){
        return $this->belongsTo('App\TipoRegistro');
    }

    // recertificado

    public function recertcertificados(){
        return $this->hasMany('App\RecertCertificado');
    }

    public function recertconstancias(){
        return $this->hasMany('App\RecertConstancia');
    }

    public function recertconferencias(){
        return $this->hasMany('App\RecertConferencia');
    }

}
