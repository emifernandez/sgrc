<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermisosDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_detalles', function (Blueprint $table) {
            $table->unsignedSmallInteger('permiso');
            $table->unsignedSmallInteger('acceso');
            $table->char('habilitado', 1);

            $table->foreign('permiso')->references('permiso')->on('permisos')->cascadeOnDelete();
            $table->foreign('acceso')->references('acceso')->on('accesos')->cascadeOnDelete();
            $table->primary(array('permiso', 'acceso'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos_detalles');
    }
}
