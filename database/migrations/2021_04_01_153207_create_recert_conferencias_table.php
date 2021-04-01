<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecertConferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recert_conferencias', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tiporegistro_id');
            $table->string('conf_nac_inter_titulo');
            $table->string('conf_nac_inter_evento');
            $table->string('conf_nac_inter_pdf');
            $table->string('conf_nac_inter_status_id');
            $table->string('conf_nac_inter_cialacibu_titulo');
            $table->string('conf_nac_inter_cialacibu_evento');
            $table->string('conf_nac_inter_cialacibu_pdf');
            $table->string('conf_nac_inter_cialacibu_status_id');
            $table->string('afilia_asosc_odont_nac_extran_nombre');
            $table->string('afilia_asosc_odont_nac_extran_cargo');
            $table->string('afilia_asosc_odont_nac_extran_categoria');
            $table->string('afilia_asosc_odont_nac_extran_gremio');
            $table->string('afilia_asosc_odont_nac_extran_pdf');
            $table->string('afilia_asosc_odont_nac_extran_status_id');
            $table->string('colaboracion_acade_para_blacibu_figura');
            $table->string('colaboracion_acade_para_blacibu_ano');
            $table->string('colaboracion_acade_para_blacibu_funcion');
            $table->string('colaboracion_acade_para_blacibu_pdf');
            $table->string('colaboracion_acade_para_blacibu_status_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recert_conferencias');
    }
}
