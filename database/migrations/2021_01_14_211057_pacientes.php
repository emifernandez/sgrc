<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->smallIncrements('paciente');
            $table->unsignedSmallInteger('establecimiento');
            $table->dateTime('fecha_ingreso', 0);
            $table->char('tipo_documento', 1);
            $table->string('numero_documento', 10);
            $table->string('nombres', 80);
            $table->date('fecha_nacimiento');
            $table->char('sexo', 1);
            $table->string('lugar_nacimiento', 80);
            $table->char('tipo_lugar', 1);
            $table->unsignedTinyInteger('nacionalidad');
            $table->char('etnia', 1);
            $table->string('nombre_etnia', 60)->nullable();
            $table->char('estado_civil', 1);
            $table->unsignedSmallInteger('barrio');
            $table->char('area', 1);
            $table->string('sector', 20)->nullable();
            $table->string('manzana', 10)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->string('nro_casa', 10)->nullable();
            $table->string('referencia', 60)->nullable();
            $table->string('telefono', 20);
            $table->string('correo_electronico', 80)->nullable();
            $table->unsignedTinyInteger('nivel_educativo');
            $table->unsignedTinyInteger('seguro');
            $table->unsignedTinyInteger('profesion');
            $table->char('situacion_laboral', 1);
            $table->string('ocupacion', 60)->nullable();
            $table->string('nombre_padre', 60)->nullable();
            $table->string('nombre_madre', 60)->nullable();

            $table->foreign('establecimiento')->references('establecimiento')->on('establecimientos');
            $table->foreign('nacionalidad')->references('nacionalidad')->on('nacionalidades');
            $table->foreign('barrio')->references('barrio')->on('barrios');
            $table->foreign('nivel_educativo')->references('nivel_educativo')->on('niveles_educativos');
            $table->foreign('seguro')->references('seguro')->on('seguros');
            $table->foreign('profesion')->references('profesion')->on('profesiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
