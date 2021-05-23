<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accesos = [
            ['nombre' => 'Nacionalidades', 'url' => 'nacionalidad.index'],
            ['nombre' => 'Cargos', 'url' => 'cargo.index'],
            ['nombre' => 'Profesiones', 'url' => 'profesion.index'],
            ['nombre' => 'Funcionarios', 'url' => 'funcionario.index'],
            ['nombre' => 'Niveles de Atención', 'url' => 'nivel.index'],
            ['nombre' => 'Tipos de Establecimiento', 'url' => 'tipo.index'],
            ['nombre' => 'Especialidades Médicas', 'url' => 'especialidad.index'],
            ['nombre' => 'Regiones', 'url' => 'region.index'],
            ['nombre' => 'Distritos', 'url' => 'distrito.index'],
            ['nombre' => 'Barrios', 'url' => 'barrio.index'],
            ['nombre' => 'Establecimientos', 'url' => 'establecimiento.index'],
            ['nombre' => 'Redes', 'url' => 'red.index'],
            ['nombre' => 'Usuarios', 'url' => 'usuario.index'],
            ['nombre' => 'Usuarios Establecimientos', 'url' => 'usuario-establecimiento.index'],
            ['nombre' => 'Perfiles de Usuarios', 'url' => 'perfil.index'],
            ['nombre' => 'Permisos de Usuarios', 'url' => 'permiso.index'],
            ['nombre' => 'Servicios Médicos', 'url' => 'servicio.index'],
            ['nombre' => 'Horarios de Atención', 'url' => 'horario.index'],
            ['nombre' => 'Niveles Educativos', 'url' => 'nivel-educativo.index'],
            ['nombre' => 'Seguros', 'url' => 'seguro.index'],
            ['nombre' => 'Pacientes', 'url' => 'paciente.index'],
            ['nombre' => 'Admisiones', 'url' => 'admision.index'],
            ['nombre' => 'Motivo de Consulta', 'url' => 'motivo.index'],
            ['nombre' => 'Enfermedades', 'url' => 'enfermedad.index'],
            ['nombre' => 'Atenciones Médicas', 'url' => 'registro-consulta.index'],
            ['nombre' => 'Referencias', 'url' => 'referencia.index'],
            ['nombre' => 'Contrarreferencias', 'url' => 'contrarreferencia.index'],
            ['nombre' => 'Informe de Establecimientos', 'url' => 'report.establecimiento.index'],
            ['nombre' => 'Informe de Horarios de Atención', 'url' => 'report.profesional.index'],
            ['nombre' => 'Informe de Derivaciones', 'url' => 'report.derivacion.index'],
            ['nombre' => 'Informe de Capacidad de Atención', 'url' => 'report.capacidad.index'],
            ['nombre' => 'Informe de Cantidades de Atención', 'url' => 'report.cantidad.index'],
        ];

        DB::table('accesos')->insert($accesos);
    }
}
