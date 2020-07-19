<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Establecimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->smallIncrements('establecimiento');
            $table->string('codigo', 3);
            $table->string('nombre', 60);
            $table->unsignedTinyInteger('tipo');
            $table->unsignedTinyInteger('red');
            $table->string('ubicacion', 60);
            $table->unsignedSmallInteger('barrio');
            $table->unsignedSmallInteger('establecimiento_encargado')->nullable();
            $table->string('telefono1', 20);
            $table->string('telefono2', 20)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('latitud', 60)->nullable();
            $table->string('longitud', 60)->nullable();
            $table->char('estado', 1);
            $table->unsignedTinyInteger('orden');

            $table->foreign('tipo')->references('tipo')->on('tipos');
            $table->foreign('red')->references('red')->on('redes');
            $table->foreign('barrio')->references('barrio')->on('barrios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establecimientos');
    }
}
