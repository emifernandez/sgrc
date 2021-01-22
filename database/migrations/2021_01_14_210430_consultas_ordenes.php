<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConsultasOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_ordenes', function (Blueprint $table) {
            $table->unsignedInteger('consulta');
            $table->unsignedTinyInteger('item');
            $table->string('orden', 300);

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
        Schema::dropIfExists('consultas_ordenes');
    }
}
