<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = [
        'name', 
        'color', 
        'icon',
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

// recertificado

public function recertcertificados(){
    return $this->hasMany('App\RecertCertificado');
}

public function recertconstancias(){
    return $this->hasMany('App\RecertConstancia');
}

public function user(){
    return $this->belongsTo('App\User', 'user_id');
}

public function admin(){
    return $this->belongsTo('App\Admin', 'userpost_id');
}

public function userpost(){
    return $this->belongsTo('App\UserPost', 'status_id');
}

}
