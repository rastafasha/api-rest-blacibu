<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{


    protected $table = 'certificados';

    protected $fillable = [
        'tiporegistro_id', 
        'cert_asist_avalados_nombre', 
        'cert_asist_avalados_ano', 
        'cert_asist_avalados_otrasinst', 
        'cert_asist_avalados_horas',
        'cert_asist_avalados_pdf',
        'cert_asist_avalados_status_id', 
        
        'cert_asist_no_avalados_nombre', 
        'cert_asist_no_avalados_ano', 
        'cert_asist_no_avalados_otrasinst',
        'cert_asist_no_avalados_horas', 
        'cert_asist_no_avalados_status_id', 
        
        'cert_o_diploma_academico_nombre', 
        'cert_o_diploma_academico_cargo',
        'cert_o_diploma_academico_tiempo', 
        'cert_o_diploma_academico_otrasinst', 
        'cert_o_diploma_academico_pdf', 
        'cert_o_diploma_academico_status_id',
        
        'cert_o_diploma_asistencial_cargo', 
        'cert_o_diploma_asistencial_tiempo', 
        'cert_o_diploma_asistencial_otrasinst', 
        'cert_o_diploma_asistencial_pdf',
        'cert_o_diploma_asistencial_status_id'
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
