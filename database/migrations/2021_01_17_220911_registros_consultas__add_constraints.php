<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistrosConsultasAddConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_consultas', function (Blueprint $table) {
            $table->foreign('admision')->references('admision')->on('admisiones');
            $table->foreign('paciente')->references('paciente')->on('pacientes');
            $table->foreign('profesional')->references('funcionario')->on('funcionarios');
            $table->foreign('referencia_origen')->nullable()->references('derivacion')->on('derivaciones');
            $table->foreign('referencia_destino')->nullable()->references('derivacion')->on('derivaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros_consultas');
    }
}
