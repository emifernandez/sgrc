<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsultasMotivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_motivos', function (Blueprint $table) {
            $table->integer('consulta')->unsigned();
            $table->unsignedSmallInteger('motivo');
            $table->string('descripcion', 60);

            $table->foreign('consulta')->references('consulta')->on('registros_consultas')->cascadeOnDelete();
            $table->foreign('motivo')->references('motivo')->on('motivos')->cascadeOnDelete();
            $table->primary(array('consulta', 'motivo'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas_motivos');
    }
}
