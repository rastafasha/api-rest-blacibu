<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('tiporegistro_id');
            $table->string('cert_asist_avalados_nombre');
            $table->string('cert_asist_avalados_ano');
            $table->string('cert_asist_avalados_otrasinst');
            $table->string('cert_asist_avalados_horas');
            $table->string('cert_asist_avalados_pdf');
            $table->string('cert_asist_avalados_status_id');
            $table->string('cert_asist_no_avalados_nombre');
            $table->string('cert_asist_no_avalados_ano');
            $table->string('cert_asist_no_avalados_otrasinst');
            $table->string('cert_asist_no_avalados_horas');
            $table->string('cert_asist_no_avalados_status_id');
            $table->string('cert_o_diploma_academico_nombre');
            $table->string('cert_o_diploma_academico_cargo');
            $table->string('cert_o_diploma_academico_tiempo');
            $table->string('cert_o_diploma_academico_otrasinst');
            $table->string('cert_o_diploma_academico_pdf');
            $table->string('cert_o_diploma_academico_status_id');
            $table->string('cert_o_diploma_asistencial_cargo');
            $table->string('cert_o_diploma_asistencial_tiempo');
            $table->string('cert_o_diploma_asistencial_otrasinst');
            $table->string('cert_o_diploma_asistencial_pdf');
            $table->string('cert_o_diploma_asistencial_status_id');
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
        Schema::dropIfExists('certificados');
    }
}
