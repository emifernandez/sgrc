<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsultasDiagnosticos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_diagnosticos', function (Blueprint $table) {
            $table->unsignedInteger('consulta');
            $table->unsignedSmallInteger('enfermedad');
            $table->string('observacion', 300)->nullable();

            $table->foreign('consulta')->references('consulta')->on('registros_consultas')->cascadeOnDelete();
            $table->foreign('enfermedad')->references('enfermedad')->on('enfermedades')->cascadeOnDelete();
            $table->primary(array('consulta', 'enfermedad'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas_diagnosticos');
    }
}
