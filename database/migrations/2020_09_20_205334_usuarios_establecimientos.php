<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosEstablecimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_establecimientos', function (Blueprint $table) {
            $table->string('usuario', 20);
            $table->unsignedSmallInteger('establecimiento');

            $table->foreign('usuario')->references('usuario')->on('usuarios');
            $table->foreign('establecimiento')->references('establecimiento')->on('establecimientos');
            $table->primary(array('usuario', 'establecimiento'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_establecimientos');
    }
}
