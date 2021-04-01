<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class RecertCertificado extends Model
{

    protected $table = 'recert_certificados';

    protected $fillable = [
        'tiporegistro_id', 
        'cert_act_academicas_y_asistenciales_nombre',
         'cert_act_academicas_y_asistenciales_cargo', 
         'cert_act_academicas_y_asistenciales_tiempo', 
         'cert_act_academicas_y_asistenciales_institucion', 
         'cert_act_academicas_y_asistenciales_pdf', 
         'cert_act_academicas_y_asistenciales_status_id',
        'trab_esp_y_art_cientificos_nombre', 
        'trab_esp_y_art_cientificos_ano', 
        'trab_esp_y_art_cientificos_revista', 
        'trab_esp_y_art_cientificos_institucion', 
        'trab_esp_y_art_cientificos_encalidad', 
        'trab_esp_y_art_cientificos_pdf',
        'trab_esp_y_art_cientificos_status_id',
         'act_editor_revisor_pub_cient_nombre', 
         'act_editor_revisor_pub_cient_ano', 
         'act_editor_revisor_pub_cient_revista', 
         'act_editor_revisor_pub_cient_pdf', 
         'act_editor_revisor_pub_cient_status_id',
        'cert_asist_simposio_de_especialidad_nombre', 
        'cert_asist_simposio_de_especialidad_modalidad', 
        'cert_asist_simposio_de_especialidad_ano', 
        'cert_asist_simposio_de_especialidad_institucion',
         'cert_asist_simposio_de_especialidad_horas',
        'cert_asist_simposio_de_especialidad_encalidade', 
        'cert_asist_simposio_de_especialidad_pdf', 
        'cert_asist_simposio_de_especialidad_status_id', 
        'cert_asist_simposio_no_especialidad_nombre', 
        'cert_asist_simposio_no_especialidad_modalidad', 
        'cert_asist_simposio_no_especialidad_ano',
        'cert_asist_simposio_no_especialidad_institucion', 
        'cert_asist_simposio_no_especialidad_horas', 
        'cert_asist_simposio_no_especialidad_encalidade', 
        'cert_asist_simposio_no_especialidad_pdf', 
        'cert_asist_simposio_no_especialidad_status_id'

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
