<?php

namespace App\Http\Controllers\Funcionario;

use App\Barrio;
use App\Cargo;
use App\EspecialidadMedica;
use App\Funcionario;
use App\Http\Controllers\Controller;
use App\Http\Requests\Funcionario\StoreFuncionarioRequest;
use App\Http\Requests\Funcionario\UpdateFuncionarioRequest;
use App\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        $funcionarios->each(function ($funcionario) {
            $funcionario->barrio = Barrio::find($funcionario->barrio);
            $funcionario->profesion = Profesion::find($funcionario->profesion);
            $funcionario->cargo = Cargo::find($funcionario->cargo);
            $funcionario->especialidad = EspecialidadMedica::find($funcionario->especialidad);

            if ($funcionario->estado === Funcionario::FUNCIONARIO_ACTIVO) {
                $funcionario->estado = 'Activo';
            } else {
                $funcionario->estado = 'Inactivo';
            }
        });
        return view('funcionario.index', compact('funcionarios', $funcionarios));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barrios = Barrio::orderBy('nombre', 'ASC')->get();
        $profesiones = Profesion::orderBy('nombre', 'ASC')->get();
        $cargos = Cargo::orderBy('nombre', 'ASC')->get();
        $especialidades = EspecialidadMedica::orderBy('nombre', 'ASC')->get();
        $funcionario = new Funcionario();
        $estados = $funcionario->getEstados();
        $sexos = $funcionario->getSexos();
        return view('funcionario.create')
            ->with('barrios', $barrios)
            ->with('profesiones', $profesiones)
            ->with('cargos', $cargos)
            ->with('especialidades', $especialidades)
            ->with('funcionario', $funcionario)
            ->with('estados', $estados)
            ->with('sexos', $sexos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuncionarioRequest $request)
    {
        $funcionario = new Funcionario($request->all());
        $funcionario->estado = Funcionario::FUNCIONARIO_ACTIVO;
        $funcionario->save();
        return redirect('/funcionario')->with('success', 'Funcionario grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        $barrios = Barrio::orderBy('nombre', 'ASC')->get();
        $profesiones = Profesion::orderBy('nombre', 'ASC')->get();
        $cargos = Cargo::orderBy('nombre', 'ASC')->get();
        $especialidades = EspecialidadMedica::orderBy('nombre', 'ASC')->get();
        $estados = $funcionario->getEstados();
        $sexos = $funcionario->getSexos();
        return view('funcionario.edit')
            ->with('barrios', $barrios)
            ->with('profesiones', $profesiones)
            ->with('cargos', $cargos)
            ->with('especialidades', $especialidades)
            ->with('funcionario', $funcionario)
            ->with('estados', $estados)
            ->with('sexos', $sexos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuncionarioRequest $request, Funcionario $funcionario)
    {
        $funcionario->fill($request->all());
        $funcionario->save();
        return redirect('/funcionario')->with('success', 'Funcionario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $funcionario = Funcionario::findOrFail($request->id);
        $funcionario->delete();
        return redirect()->route('funcionario.index')->with('success', 'Funcionario eliminado correctamente');
    }

    public function report(Request $request)
    {
        $establecimiento_usuario = $request->session()->get('establecimiento');
        $where = '';
        $c = 0;
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
        if ($where != '') {
            $horarios = DB::table('horarios_atenciones')
                ->select(DB::raw(
                    'UPPER(establecimientos.nombre) AS establecimiento,
                    UPPER(especialidades_medicas.nombre) AS especialidad,
                    UPPER(funcionarios.nombres) AS nombre,
                    UPPER(funcionarios.apellidos) AS apellido,
                    hora_desde,
	                hora_hasta,
                    CASE dia
                    WHEN 1 then "DOMINGO"
                    WHEN 2 then "LUNES"
                    WHEN 3 then "MARTES"
                    WHEN 4 then "MIERCOLES"
                    WHEN 5 then "JUEVES"
                    WHEN 6 then "VIERNES"
                    WHEN 7 then "SABADO"
                    END AS dia'
                ))
                ->join('establecimientos', 'establecimientos.establecimiento', '=', 'horarios_atenciones.establecimiento')
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
            $horarios = DB::table('horarios_atenciones')
                ->select(DB::raw('UPPER(establecimientos.nombre) AS establecimiento,
                UPPER(especialidades_medicas.nombre) AS especialidad,
                UPPER(funcionarios.nombres) AS nombre,
                UPPER(funcionarios.apellidos) AS apellido,
                hora_desde,
                hora_hasta,
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
                ->join('especialidades_medicas', 'especialidades_medicas.especialidad', '=', 'horarios_atenciones.especialidad')
                ->join('funcionarios', 'funcionarios.funcionario', '=', 'horarios_atenciones.funcionario')
                ->orderBy('establecimientos.nombre', 'ASC')
                ->orderBy('dia', 'ASC')
                ->orderBy('especialidades_medicas.nombre', 'ASC')
                ->orderBy('funcionarios.nombres', 'ASC')
                ->orderBy('funcionarios.apellidos', 'ASC')
                ->get();
        }
        return view('funcionario.reportes.funcionario')
            ->with('horarios', $horarios)
            ->with('establecimiento_usuario', $establecimiento_usuario);
        // $pdf = \PDF::loadView('funcionario.reportes.funcionario', compact('horarios', $horarios));
        // $pdf->getDomPDF()->set_option("enable_php", true);
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->stream('Profesionales.pdf');
    }
}
