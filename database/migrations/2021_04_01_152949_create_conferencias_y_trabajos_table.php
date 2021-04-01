<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferenciasyTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferencias_y_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('tiporegistro_id');
            $table->string('conf_con_aval_academico_titulo');
            $table->string('conf_con_aval_academico_evento');
            $table->string('conf_con_aval_academico_pdf');
            $table->string('conf_con_aval_academico_status_id');
            $table->string('conf_sin_aval_academico_titulo');
            $table->string('conf_sin_aval_academico_evento');
            $table->string('conf_sin_aval_academico_pdf');
            $table->string('conf_sin_aval_academico_status_id');
            $table->string('trab_pres_con_aval_titulo');
            $table->string('trab_pres_con_aval_evento');
            $table->string('trab_pres_con_aval_modalidad');
            $table->string('trab_pres_con_aval_pdf');
            $table->string('trab_pres_con_aval_status_id');
            $table->string('trab_pres_sin_aval_titulo');
            $table->string('trab_pres_sin_aval_evento');
            $table->string('trab_pres_sin_aval_modalidad');
            $table->string('trab_pres_sin_aval_pdf');
            $table->string('trab_pres_sin_aval_status_id');
            $table->string('trab_publicados_nombre');
            $table->string('trab_publicados_ano');
            $table->string('trab_publicados_revisa');
            $table->string('trab_publicados_pdf');
            $table->string('trab_publicados_status_id');
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
        Schema::dropIfExists('conferencias_y_trabajos');
    }
}
