<?php

use App\Acceso;
use App\Barrio;
use App\Cargo;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\NivelAtencion;
use App\Perfil;
use App\Permiso;
use App\Profesion;
use App\Red;
use App\Tipo;
use App\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profesion = new Profesion();
        $profesion->nombre  = 'sin especificar';
        $profesion->save();

        $cargo = new Cargo();
        $cargo->nombre  = 'sin especificar';
        $cargo->save();

        $especialidad = new EspecialidadMedica();
        $especialidad->nombre  = 'sin especificar';
        $especialidad->save();

        $nivel = new NivelAtencion();
        $nivel->nombre  = 'sin especificar';
        $nivel->save();

        $red = new Red();
        $red->nombre  = 'sin especificar';
        $red->save();

        $tipo = new Tipo();
        $tipo->nivel = NivelAtencion::all()->first()->nivel;
        $tipo->nombre  = 'sin especificar';
        $tipo->save();

        $funcionario = new Funcionario();
        $funcionario->nombres = 'Administrador';
        $funcionario->apellidos = 'Administrador';
        $funcionario->cedula_identidad = '0';
        $funcionario->direccion = '';
        $funcionario->barrio = Barrio::all()->first()->barrio;
        $funcionario->fecha_nacimiento = now();
        $funcionario->sexo = Funcionario::FUNCIONARIO_MASCULINO;
        $funcionario->telefono_principal = '';
        $funcionario->profesion = Profesion::all()->first()->profesion;
        $funcionario->registro_profesional = '';
        $funcionario->cargo = Cargo::all()->first()->cargo;
        $funcionario->especialidad = EspecialidadMedica::all()->first()->especialidad;
        $funcionario->estado = Funcionario::FUNCIONARIO_ACTIVO;
        $funcionario->save();

        $usuario = new Usuario();
        $usuario->usuario = 'admin';
        $usuario->estado = Usuario::USUARIO_ACTIVO;
        $usuario->clave = Hash::make('1234');
        $usuario->fecha_validez = date('Y-m-d', strtotime('31-12-2100'));
        $usuario->fecha_registro = now();
        $usuario->perfil = Perfil::all()->first()->perfil;
        $usuario->funcionario = Funcionario::all()->first()->funcionario;
        $usuario->save();

        $establecimiento = new Establecimiento();
        $establecimiento->codigo = '';
        $establecimiento->nombre = 'sin especificar';
        $establecimiento->tipo = Tipo::all()->first()->tipo;
        $establecimiento->red = Red::all()->first()->red;
        $establecimiento->ubicacion = '';
        $establecimiento->barrio = Barrio::all()->first()->barrio;
        $establecimiento->telefono1 = '';
        $establecimiento->estado = Establecimiento::ESTABLECIMIENTO_ACTIVO;
        $establecimiento->orden = 1;
        $establecimiento->save();

        $usuario = Usuario::all()->first();
        $establecimiento = Establecimiento::all()->first();
        $usuario->establecimientos()->syncWithoutDetaching($establecimiento->establecimiento);

        $accesos = Acceso::all();
        $permiso = new Permiso();
        $permiso->perfil = Perfil::all()->first()->perfil;
        $permiso->fecha_asignacion = now();
        $permiso->save();
        $permiso = Permiso::all()->first();
        foreach ($accesos as $i => $acceso) {
            $permiso->accesos()->attach($permiso->permiso, ['acceso' => $acceso->acceso, 'habilitado' => true]);
        }
    }
}
