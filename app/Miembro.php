<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    protected $table = 'miembros';

    protected $fillable = [
        'user_id', 
        'tiporegistro_id', 
        'numero_miembro', 
        'ano_certificacion', 
        'tiempo_titulado', 
        'ano_graduado'
    ];

    // Relacion de 1 a muchos pero inversa(muchos pueden pertenecer a una categoria )
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function admin(){
        return $this->belongsTo('App\Admin', 'user_id');
    }

    public function tiporegistros(){
        return $this->belongsTo('App\TipoRegistro', 'tiporegistro_id');
    }
}
