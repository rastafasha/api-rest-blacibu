<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// JWT contract
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'tiporegistro_id', 'idioma',
        'pais', 'pasaporte', 'fecha_nac', 'edad', 'lugar_nac', 'nacionalidad',
        'telefono', 'direccion', 'cod_postal', 'pais_ejerce',
        'red_social', 'user_red', 'status_id', 'image', 'user_post_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    // Relacion de uno a muchos


    public function pagos(){
        return $this->hasMany('App\Pago', 'user_id',);
    }
    public function documentos(){
        return $this->hasMany('App\Documento', 'user_id');
    }

    public function certificados(){
        return $this->belongsTo('App\Certificado', 'user_id');
    }

    public function conferencias(){
        return $this->belongsTo('App\ConferenciasyTrabajos', 'user_id');
    }

    public function miembros(){
        return $this->belongsTo('App\Miembro', 'user_id');
    }



    // recertificado

    public function recertcertificados(){
        return $this->belongsTo('App\RecertCertificado', 'user_id');
    }

    public function recertconstancias(){
        return $this->belongsTo('App\RecertConstancia', 'user_id');
    }

    public function recertconferencias(){
        return $this->belongsTo('App\RecertConferencia', 'user_id');
    }


    public function tiporegistros(){
        return $this->belongsTo('App\TipoRegistro', 'tiporegistro_id');
    }

    public function estados(){
        return $this->belongsTo('App\Estado');
    }

    public function admin(){
        return $this->belongsTo('App\Admin', 'user_id');
    }


    // Relacion de uno a muchos publicaciones
    public function userpost(){
        return $this->hasMany('App\UserPost', 'user_post_id');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
