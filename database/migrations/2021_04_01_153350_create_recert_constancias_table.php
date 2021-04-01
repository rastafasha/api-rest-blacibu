<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecertConstanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recert_constancias', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('tiporegistro_id');
            $table->string('const_miembro_activo_pdf');
            $table->string('const_miembro_activo_status_id');
            $table->string('curriculum_pdf');
            $table->string('curriculum_status_id');
            $table->string('const_practica_privada_pdf');
            $table->string('const_anos');
            $table->string('const_practica_privada_status_id');
            $table->string('distinciones_premios_pdf');
            $table->string('distinciones_premios_status_id');
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
        Schema::dropIfExists('recert_constancias');
    }
}
