<?php

namespace App\Http\Controllers\Reporte;

use App\EspecialidadMedica;
use App\Establecimiento;
use App\Formatters\DateFormatter;
use App\Funcionario;
use App\HorarioAtencion;
use App\Http\Controllers\Controller;
use App\Red;
use App\Region;
use App\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function establecimiento()
    {
        $regiones = Region::all();
        $tipos = Tipo::all();
        $estados = Establecimiento::ESTADOS;
        return view('reports.establecimiento')
            ->with('regiones', $regiones)
            ->with('tipos', $tipos)
            ->with('estados', $estados);
    }

    public function profesional()
    {
        $establecimientos = Establecimiento::all();
        $especialidades = EspecialidadMedica::all();
        $funcionarios = Funcionario::all();
        $dias = HorarioAtencion::DIAS;
        return view('reports.profesionales')
            ->with('establecimientos', $establecimientos)
            ->with('especialidades', $especialidades)
            ->with('funcionarios', $funcionarios)
            ->with('dias', $dias);
    }

    public function capacidadAtencion()
    {
        $redes = Red::all();
        $establecimientos = Establecimiento::all();
        $especialidades = EspecialidadMedica::all();
        $funcionarios = Funcionario::all();
        $dias = HorarioAtencion::DIAS;
        return view('reports.capacidad')
            ->with('redes', $redes)
            ->with('establecimientos', $establecimientos)
            ->with('especialidades', $especialidades)
            ->with('funcionarios', $funcionarios)
            ->with('dias', $dias);
    }

    public function cantidadAtencion()
    {
        $redes = Red::all();
        $establecimientos = Establecimiento::all();
        return view('reports.cantidad')
            ->with('redes', $redes)
            ->with('establecimientos', $establecimientos);
    }

    public function reportCapacidadAtencion(Request $request)
    {
        $establecimiento_usuario = $request->session()->get('establecimiento');
        $where = '';
        $c = 0;
        if ($request->has('red') && $request->get('red') != 'null') {
            $where = $where . ' establecimientos.red = ' . $request->get('red');
            $c++;
        }
        if ($request->has('establecimiento') && $request->get('establecimiento') != 'null') {
            $where = $where . ' horarios_atenciones.establecimiento = ' . $request->get('establecimiento');
            $c++;
        }
        if ($request->has('especialidad') && $request->get('especialidad') != 'null') {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' horarios_atenciones.especialidad = ' . $request->get('especialidad');
            $c++;
        }
        if ($request->has('funcionario') && $request->get('funcionario') != 'null') {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' horarios_atenciones.funcionario = ' . $request->get('funcionario');
            $c++;
        }
        if ($request->has('hora_desde') && $request->get('hora_desde') != null) {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' hora_desde >= \'' . $request->get('hora_desde') . '\'';
            $c++;
        }
        if ($request->has('hora_hasta') && $request->get('hora_hasta') != null) {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' hora_hasta <= \'' . $request->get('hora_hasta') . '\'';
            $c++;
        }
        if ($request->has('dia') && $request->get('dia') != 'null') {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' dia = ' . $request->get('dia');
            $c++;
        }
        if ($request->has('cupo_selector') && $request->has('cupo') && $request->get('cupo_selector') != 'null' && $request->get('cupo') != null) {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' uso_atencion ' . $request->get('cupo_selector') . $request->get('cupo');
            $c++;
        }
        if ($request->has('capacidad_selector') && $request->has('capacidad') && $request->get('capacidad_selector') != 'null' && $request->get('capacidad') != null) {
            $c > 0 ? $where = $where . ' AND ' : '';
            $where = $where . ' capacidad_atencion ' . $request->get('capacidad_selector') . $request->get('capacidad');
            $c++;
        }
        if ($where != '') {
            $capacidades = DB::table('horarios_atenciones')
                ->select(DB::raw('UPPER(redes.nombre) AS red,
                    UPPER(establecimientos.nombre) AS establecimiento,
                    UPPER(especialidades_medicas.nombre) AS especialidad,
                    UPPER(funcionarios.nombres) AS nombre,
                    UPPER(funcionarios.apellidos) AS apellido,
                    hora_desde,
                    hora_hasta,
                    capacidad_atencion AS capacidad,
                    uso_atencion AS cupo,
                    CASE capacidad_atencion
                    WHEN 0 then 0
                    ELSE uso_atencion * 100 / capacidad_atencion
                    END as porcentaje,
                    CASE dia
                    WHEN 1 then "DOMINGO"
                    WHEN 2 then "LUNES"
                    WHEN 3 then "MARTES"
                    WHEN 4 then "MIERCOLES"
                    WHEN 5 then "JUEVES"
                    WHEN 6 then "VIERNES"
                    WHEN 7 then "SABADO"
                    END AS dia'))
                ->join('establecimientos', 'establecimientos.establecimiento', '=', 'horarios_atenciones.establecimiento')
                ->join('redes', 'establecimientos.red', '=', 'redes.red')
                ->join('especialidades_medicas', 'especialidades_medicas.especialidad', '=', 'horarios_atenciones.especialidad')
                ->join('funcionarios', 'funcionarios.funcionario', '=', 'horarios_atenciones.funcionario')
                ->whereRaw($where)
                ->orderBy('establecimientos.nombre', 'ASC')
                ->orderBy('dia', 'ASC')
                ->orderBy('especialidades_medicas.nombre', 'ASC')
                ->orderBy('funcionarios.nombres', 'ASC')
                ->orderBy('funcionarios.apellidos', 'ASC')
                ->get();
        } else {
            $capacidades = DB::table('horarios_atenciones')
                ->select(DB::raw('UPPER(redes.nombre) AS red,
                UPPER(establecimientos.nombre) AS establecimiento,
                UPPER(especialidades_medicas.nombre) AS especialidad,
                UPPER(funcionarios.nombres) AS nombre,
                UPPER(funcionarios.apellidos) AS apellido,
                hora_desde,
                hora_hasta,
                capacidad_atencion AS capacidad,
                uso_atencion AS cupo,
                CASE capacidad_atencion
                WHEN 0 then 0
                ELSE uso_atencion * 100 / capacidad_atencion
                END as porcentaje,
                CASE dia
                WHEN 1 then "DOMINGO"
                WHEN 2 then "LUNES"
                WHEN 3 then "MARTES"
                WHEN 4 then "MIERCOLES"
                WHEN 5 then "JUEVES"
                WHEN 6 then "VIERNES"
                WHEN 7 then "SABADO"
                END AS dia'))
                ->join('establecimientos', 'establecimientos.establecimiento', '=', 'horarios_atenciones.establecimiento')
                ->join('redes', 'establecimientos.red', '=', 'redes.red')
                ->join('especialidades_medicas', 'especialidades_medicas.especialidad', '=', 'horarios_atenciones.especialidad')
                ->join('funcionarios', 'funcionarios.funcionario', '=', 'horarios_atenciones.funcionario')
                ->orderBy('establecimientos.nombre', 'ASC')
                ->orderBy('dia', 'ASC')
                ->orderBy('especialidades_medicas.nombre', 'ASC')
                ->orderBy('funcionarios.nombres', 'ASC')
                ->orderBy('funcionarios.apellidos', 'ASC')
                ->get();
        }
        return view('horario.reportes.capacidad')
            ->with('capacidades', $capacidades)
            ->with('establecimiento_usuario', $establecimiento_usuario);
    }

    public function reportCantidadAtencion(Request $request)
    {


        $establecimiento_usuario = $request->session()->get('establecimiento');
        $where = '';
        $where_date = '';
        $c = 0;
        if ($request->has('red') && $request->get('red') != 'null') {
            $where = $where . ' establecimientos.red = ' . $request->get('red');
            $c++;
        }
        if ($request->has('establecimiento') && $request->get('establecimiento') != 'null') {
            $where = $where . ' horarios_atenciones.establecimiento = ' . $request->get('establecimiento');
            $c++;
        }

        if ($request->has('fecha_desde') && $request->has('fecha_hasta') && $request->get('fecha_desde') != null && $request->get('fecha_hasta') != null) {
            $fecha_desde = new DateFormatter($request->get('fecha_desde'));
            $fecha_hasta = new DateFormatter($request->get('fecha_hasta'));
            $where_date = $where_date . ' and fecha BETWEEN \'' . $fecha_desde->forString() . '\' AND \'' . $fecha_hasta->forString() . '\'';
        }
        if ($where != '') {
            $establecimientos = DB::table('establecimientos')
                ->select(DB::raw('redes.nombre as red,
                establecimientos.nombre as establecimiento,
                (select count(*)
                from registros_consultas r
                where r.establecimiento = establecimientos.establecimiento ' . $where_date . ') as atenciones,
                (select count(*)
                from derivaciones d
                where d.establecimiento = establecimientos.establecimiento
                and d.tipo = 1 ' . $where_date . ') as referencias,
                (select count(*)
                from derivaciones d
                where d.establecimiento = establecimientos.establecimiento
                and d.tipo = 2 ' . $where_date . ') as contrareferencias
                '))
                ->join('redes', 'establecimientos.red', '=', 'redes.red')
                ->whereRaw($where)
                ->orderBy('establecimientos.nombre', 'ASC')
                ->get();
        } else {
            $establecimientos = DB::table('establecimientos')
                ->select(DB::raw('redes.nombre as red,
                establecimientos.nombre as establecimiento,
                (select count(*)
                from registros_consultas r
                where r.establecimiento = establecimientos.establecimiento ' . $where_date . ') as atenciones,
                (select count(*)
                from derivaciones d
                where d.establecimiento = establecimientos.establecimiento
                and d.tipo = 1 ' . $where_date . ') as referencias,
                (select count(*)
                from derivaciones d
                where d.establecimiento = establecimientos.establecimiento
                and d.tipo = 2 ' . $where_date . ') as contrareferencias
                '))
                ->join('redes', 'establecimientos.red', '=', 'redes.red')
                ->orderBy('establecimientos.nombre', 'ASC')
                ->get();
        }
        return view('horario.reportes.cantidad')
            ->with('establecimientos', $establecimientos)
            ->with('establecimiento_usuario', $establecimiento_usuario);
    }
}
