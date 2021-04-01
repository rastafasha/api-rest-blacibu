<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use User;
use Admin;
use AdminUser;
use Certificado;
use ConferenciasyTrabajos;
use Documento;
use Estado;
use Pago;
use RecertCertificado;
use RecertConferencia;
use RecertConstancia;

class UserPost extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'status_id', 'user_post_id', 'pagos_userpost_id',
        'documentos_userpost_id', 'certificados_userpost_id',
        'constancias_userpost_id', 'conferencias_userpost_id',
        'rec_constancias_userpost_id','rec_certificados_userpost_id',
        'rec_conferencias_userpost_id'
    ];

    // Relacion de 1 a muchos pero inversa(muchos pueden pertenecer a una categoria )
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


    public function admin(){
        return $this->belongsTo('App\Admin', 'user_post_id');
    }
    public function estados(){
        return $this->hasMany('App\Estado');
    }
    public function tiporegistro(){
        return $this->hasMany('App\TipoRegistro');
    }


    public function pagos(){
        return $this->hasMany('App\Pago', 'user_post_id');
    }
    public function documentos(){
        return $this->hasMany('App\Documento', 'user_post_id');
    }

    public function certificados(){
        return $this->hasMany('App\Certificado', 'user_post_id');
    }

    public function conferencias(){
        return $this->hasMany('App\ConferenciasyTrabajos', 'user_post_id');
    }

    public function miembros(){
        return $this->hasMany('App\Miembro');
    }


    public function recertcertificados(){
        return $this->hasMany('App\RecertCertificado', 'user_post_id');
    }

    public function recertconstancias(){
        return $this->hasMany('App\RecertConstancia', 'user_post_id');
    }

    public function recertconferencias(){
        return $this->hasMany('App\RecertConferencia', 'user_post_id');
    }

    public function tiporegistros(){
        return $this->hasMany('App\TipoRegistro', 'user_post_id');
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
