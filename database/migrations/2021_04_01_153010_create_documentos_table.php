<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('tiporegistro_id');
            $table->string('pdf_titulo_odontologo');
            $table->string('pdf_titulo_odontologo_status_id');
            $table->string('pdf_matricula_odontologo');
            $table->string('pdf_matricula_odontologo_status_id');
            $table->string('pdf_titulo_espec_bucomax');
            $table->string('pdf_titulo_espec_bucomax_status_id');
            $table->string('pdf_matricula_bucomax');
            $table->string('pdf_matricula_bucomax_status_id');
            $table->string('pdf_residencia_especializacion');
            $table->string('pdf_residencia_especializacion_status_id');
            $table->string('pdf_constancia_miembro');
            $table->string('pdf_constancia_miembro_status_id');
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
        Schema::dropIfExists('documentos');
    }
}
