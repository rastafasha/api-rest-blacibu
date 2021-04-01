<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ConferenciasyTrabajos extends Model
{


    protected $table = 'conferencia_y_trabajos';

    protected $fillable = [
        'tiporegistro_id', 
        'conf_con_aval_academico_titulo', 
        'conf_con_aval_academico_evento', 
        'conf_con_aval_academico_pdf', 
        'conf_con_aval_academico_status_id',
        'conf_sin_aval_academico_titulo', 
        'conf_sin_aval_academico_evento', 
        'conf_sin_aval_academico_pdf', 
        'conf_sin_aval_academico_status_id',
        'trab_pres_con_aval_titulo', 
        'trab_pres_con_aval_evento', 
        'trab_pres_con_aval_modalidad', 
        'trab_pres_con_aval_pdf', 
        'trab_pres_con_aval_status_id',
        'trab_pres_sin_aval_titulo', 
        'trab_pres_sin_aval_evento', 
        'trab_pres_sin_aval_modalidad', 
        'trab_pres_sin_aval_pdf', 
        'trab_pres_sin_aval_status_id',
        'trab_publicados_nombre', 
        'trab_publicados_ano', 
        'trab_publicados_revisa', 
        'trab_publicados_pdf', 
        'trab_publicados_status_id'
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
