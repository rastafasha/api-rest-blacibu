<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecertConferencia extends Model
{
    protected $table = 'recert_conf_afiliaciones';

    protected $fillable = [
        'user_id', 'tiporegistro_id',
        'conf_nac_inter_titulo',
        'conf_nac_inter_evento',
        'conf_nac_inter_pdf',
        'conf_nac_inter_status_id',
        'conf_nac_inter_cialacibu_titulo',
        'conf_nac_inter_cialacibu_evento',
        'conf_nac_inter_cialacibu_pdf',
        'conf_nac_inter_cialacibu_status_id',
        'afilia_asosc_odont_nac_extran_nombre' ,
        'afilia_asosc_odont_nac_extran_cargo' ,
        'afilia_asosc_odont_nac_extran_categoria' ,
        'afilia_asosc_odont_nac_extran_gremio' ,
        'afilia_asosc_odont_nac_extran_pdf' ,
        'afilia_asosc_odont_nac_extran_status_id' ,
        'colaboracion_acade_para_blacibu_figura',
        'colaboracion_acade_para_blacibu_ano' ,
        'colaboracion_acade_para_blacibu_funcion' ,
        'colaboracion_acade_para_blacibu_pdf',
        'colaboracion_acade_para_blacibu_status_id'
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
