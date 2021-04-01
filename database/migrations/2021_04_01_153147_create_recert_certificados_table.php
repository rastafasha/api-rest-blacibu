<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecertCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recert_certificados', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tiporegistro_id');
            $table->string('cert_act_academicas_y_asistenciales_nombre');
            $table->string('cert_act_academicas_y_asistenciales_cargo');
            $table->string('cert_act_academicas_y_asistenciales_tiempo');
            $table->string('cert_act_academicas_y_asistenciales_institucion');
            $table->string('cert_act_academicas_y_asistenciales_pdf');
            $table->string('cert_act_academicas_y_asistenciales_status_id');
            $table->string('trab_esp_y_art_cientificos_nombre');
            $table->string('trab_esp_y_art_cientificos_ano');
            $table->string('trab_esp_y_art_cientificos_revista');
            $table->string('trab_esp_y_art_cientificos_institucion');
            $table->string('trab_esp_y_art_cientificos_encalidad');
            $table->string('trab_esp_y_art_cientificos_pdf');
            $table->string('trab_esp_y_art_cientificos_status_id');
            $table->string('act_editor_revisor_pub_cient_nombre');
            $table->string('act_editor_revisor_pub_cient_ano');
            $table->string('act_editor_revisor_pub_cient_revista');
            $table->string('act_editor_revisor_pub_cient_pdf');
            $table->string('act_editor_revisor_pub_cient_status_id');
            $table->string('cert_asist_simposio_de_especialidad_nombre');
            $table->string('cert_asist_simposio_de_especialidad_modalidad');
            $table->string('cert_asist_simposio_de_especialidad_ano');
            $table->string('cert_asist_simposio_de_especialidad_institucion');
            $table->string('cert_asist_simposio_de_especialidad_horas');
            $table->string('cert_asist_simposio_de_especialidad_encalidade');
            $table->string('cert_asist_simposio_de_especialidad_pdf');
            $table->string('cert_asist_simposio_de_especialidad_status_id');
            $table->string('cert_asist_simposio_no_especialidad_nombre');
            $table->string('cert_asist_simposio_no_especialidad_modalidad');
            $table->string('cert_asist_simposio_no_especialidad_ano');
            $table->string('cert_asist_simposio_no_especialidad_institucion');
            $table->string('cert_asist_simposio_no_especialidad_horas');
            $table->string('cert_asist_simposio_no_especialidad_encalidade');
            $table->string('cert_asist_simposio_no_especialidad_pdf');
            $table->string('cert_asist_simposio_no_especialidad_status_id');
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
        Schema::dropIfExists('recert_certificados');
    }
}
