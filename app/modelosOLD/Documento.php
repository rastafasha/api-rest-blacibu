<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $fillable = [
        'tiporegistro_id', 
        'pdf_titulo_odontologo',
        'pdf_titulo_odontologo_status_id',
        'pdf_matricula_odontologo',
        'pdf_matricula_odontologo_status_id',
        'pdf_titulo_espec_bucomax',
        'pdf_titulo_espec_bucomax_status_id',
        'pdf_matricula_bucomax',
        'pdf_matricula_bucomax_status_id',
        'pdf_residencia_especializacion',
        'pdf_residencia_especializacion_status_id',
        'pdf_constancia_miembro',
        'pdf_constancia_miembro_status_id'
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
