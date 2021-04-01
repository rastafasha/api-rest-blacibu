<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('tiporegistro_id');
            $table->string('idioma');
            $table->string('pais');
            $table->string('pasaporte');
            $table->date('fecha_nac');
            $table->string('edad');
            $table->string('lugar_nac');
            $table->string('nacionalidad');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('cod_postal');
            $table->string('pais_ejerce');
            $table->string('red_social');
            $table->string('user_red');
            $table->string('status_id');
            $table->string('image');
            $table->string('user_post_id');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
