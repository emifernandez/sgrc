<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Derivaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derivaciones', function (Blueprint $table) {
            $table->increments('derivacion');
            $table->unsignedSmallInteger('establecimiento');
            $table->unsignedSmallInteger('establecimiento_derivacion');
            $table->unsignedInteger('contra_derivacion')->nullable();
            $table->unsignedSmallInteger('paciente');
            $table->unsignedSmallInteger('profesional_derivante');
            $table->unsignedSmallInteger('profesional_derivado')->nullable();
            $table->unsignedTinyInteger('especialidad');
            $table->unsignedSmallInteger('cie_derivacion');
            $table->unsignedInteger('consulta');
            $table->dateTime('fecha', 0);
            $table->char('tipo', 1);
            $table->string('descripcion_caso', 300)->nullable();
            $table->string('impresion_diagnostica', 300)->nullable();
            $table->string('tratamiento_actual', 300)->nullable();
            $table->string('recomendacion', 300)->nullable();
            $table->string('situacion_sociofamiliar', 300)->nullable();
            $table->string('usuario', 20);
            $table->char('estado', 1);
            $table->char('prioridad', 1);

            $table->foreign('establecimiento')->references('establecimiento')->on('establecimientos');
            $table->foreign('establecimiento_derivacion')->references('establecimiento')->on('establecimientos');
            $table->foreign('contra_derivacion')->nullable()->references('derivacion')->on('derivaciones');
            $table->foreign('paciente')->references('paciente')->on('pacientes');
            $table->foreign('profesional_derivante')->references('funcionario')->on('funcionarios');
            $table->foreign('profesional_derivado')->nullable()->references('funcionario')->on('funcionarios');
            $table->foreign('especialidad')->references('especialidad')->on('especialidades_medicas');
            $table->foreign('cie_derivacion')->references('enfermedad')->on('enfermedades');
            $table->foreign('consulta')->references('consulta')->on('registros_consultas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('derivaciones');
    }
}
