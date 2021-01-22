<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistrosConsultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_consultas', function (Blueprint $table) {
            $table->increments('consulta');
            $table->unsignedSmallInteger('establecimiento');
            $table->unsignedSmallInteger('admision');
            $table->unsignedSmallInteger('paciente');
            $table->unsignedSmallInteger('profesional');
            $table->unsignedInteger('referencia_origen')->nullable();
            $table->unsignedInteger('referencia_destino')->nullable();
            $table->dateTime('fecha', 0);
            $table->char('tipo_consulta', 1);

            $table->foreign('establecimiento')->references('establecimiento')->on('establecimientos');
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
