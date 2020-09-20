<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->string('usuario', 20)->primary();
            $table->unsignedSmallInteger('funcionario');
            $table->string('clave', 100);
            $table->dateTime('fecha_registro', 0);
            $table->dateTime('fecha_validez', 0);
            $table->unsignedTinyInteger('perfil');
            $table->char('estado', 1);

            $table->foreign('funcionario')->references('funcionario')->on('funcionarios');
            $table->foreign('perfil')->references('perfil')->on('perfiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
