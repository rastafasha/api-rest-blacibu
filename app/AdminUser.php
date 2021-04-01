<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{


// Relacion de uno a muchos


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

public function recertconferencias(){
    return $this->hasMany('App\RecertConferencia');
}

public function user(){
    return $this->belongsToMany('App\User');
}

public function admin(){
    return $this->belongsTo('App\Admin', 'user_id');
}
}
