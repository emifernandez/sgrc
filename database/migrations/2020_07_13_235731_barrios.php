<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Barrios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrios', function (Blueprint $table) {
            $table->smallIncrements('barrio');
            $table->unsignedTinyInteger('distrito');
            $table->string('nombre', 60);

            $table->foreign('distrito')->references('distrito')->on('distritos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barrios');
    }
}
