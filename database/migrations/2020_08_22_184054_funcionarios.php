<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Funcionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->smallIncrements('funcionario');
            $table->string('nombres', 60);
            $table->string('apellidos', 60);
            $table->integer('cedula_identidad');
            $table->string('direccion', 80);
            $table->unsignedSmallInteger('barrio');
            $table->date('fecha_nacimiento');
            $table->char('sexo', 1);
            $table->string('telefono_principal', 20);
            $table->string('telefono_secundario', 20)->nullable();
            $table->unsignedTinyInteger('profesion');
            $table->string('registro_profesional', 20)->nullable();
            $table->unsignedTinyInteger('cargo');
            $table->unsignedTinyInteger('especialidad');
            $table->string('email', 80)->nullable();
            $table->char('estado', 1);

            $table->foreign('barrio')->references('barrio')->on('barrios');
            $table->foreign('profesion')->references('profesion')->on('profesiones');
            $table->foreign('cargo')->references('cargo')->on('cargos');
            $table->foreign('especialidad')->references('especialidad')->on('especialidades_medicas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
