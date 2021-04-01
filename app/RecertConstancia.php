<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecertConstancia extends Model
{
    protected $table = 'recert_constancias';

    protected $fillable = [
        'user_id',
        'tiporegistro_id',
        'const_miembro_activo_pdf',
        'const_miembro_activo_status_id', 
        'curriculum_pdf',
        'curriculum_status_id', 
        'const_practica_privada_pdf',
        'const_anos', 
        'const_practica_privada_status_id',
        'distinciones_premios_pdf', 
        'distinciones_premios_status_id'
    ];

    // Relacion de 1 a muchos pero inversa(muchos pueden pertenecer a una categoria )
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tiporegistros(){
        return $this->belongsTo('App\TipoRegistro', 'tiporegistro_id');
    }
    public function admin(){
        return $this->belongsTo('App\Admin', 'user_id');
    }
}
