<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $fillable = [
        'user_id', 'tiporegistro_id', 'transf_banco', 'transf_fecha', 'transf_numero', 'transf_pdf', 'transf_pdf_status_id'
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
