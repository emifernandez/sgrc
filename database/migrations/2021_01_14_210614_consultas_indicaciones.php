<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsultasIndicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_indicaciones', function (Blueprint $table) {
            $table->unsignedInteger('consulta');
            $table->unsignedTinyInteger('item');
            $table->string('indicacion', 300);

            $table->foreign('consulta')->references('consulta')->on('registros_consultas');
            $table->primary(array('consulta', 'item'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas_indicaciones');
    }
}
