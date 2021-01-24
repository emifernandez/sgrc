<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HorariosAtenciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_atenciones', function (Blueprint $table) {
            $table->smallIncrements('horario');
            $table->unsignedSmallInteger('establecimiento');
            $table->unsignedTinyInteger('especialidad');
            $table->unsignedSmallInteger('funcionario');
            $table->char('dia', 1);
            $table->time('hora_desde', $precision = 0);
            $table->time('hora_hasta', $precision = 0);
            $table->char('estado', 1);
            $table->string('observacion', 300)->nullable();
            $table->unsignedSmallInteger('capacidad_atencion');
            $table->unsignedSmallInteger('uso_atencion');

            $table->foreign('establecimiento')->references('establecimiento')->on('establecimientos');
            $table->foreign('especialidad')->references('especialidad')->on('especialidades_medicas');
            $table->foreign('funcionario')->references('funcionario')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios_atenciones');
    }
}
