<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Adminsiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admisiones', function (Blueprint $table) {
            $table->smallIncrements('admision');
            $table->unsignedSmallInteger('establecimiento');
            $table->unsignedInteger('derivacion')->nullable();
            $table->unsignedSmallInteger('paciente');
            $table->dateTime('fecha_admision', 0);
            $table->unsignedTinyInteger('especialidad');
            $table->unsignedSmallInteger('profesional');
            $table->unsignedSmallInteger('servicio');
            $table->string('usuario', 20);
            $table->dateTime('fecha_registro', 0);
            $table->char('estado', 1);
            $table->char('prioridad', 1);
            $table->string('observacion', 300)->nullable();

            $table->foreign('establecimiento')->references('establecimiento')->on('establecimientos');
            $table->foreign('paciente')->references('paciente')->on('pacientes');
            $table->foreign('especialidad')->references('especialidad')->on('especialidades_medicas');
            $table->foreign('profesional')->references('funcionario')->on('funcionarios');
            $table->foreign('servicio')->references('servicio')->on('servicios_medicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admisiones');
    }
}
