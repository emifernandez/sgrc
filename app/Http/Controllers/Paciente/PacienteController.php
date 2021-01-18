<?php

namespace App\Http\Controllers\Paciente;

use App\Barrio;
use App\Establecimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;
use App\Nacionalidad;
use App\NivelEducativo;
use App\Paciente;
use App\Profesion;
use App\Seguro;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        $pacientes->each(function ($paciente) {
            $paciente->establecimiento = Establecimiento::find($paciente->establecimiento);
            $paciente->nacionalidad = Nacionalidad::find($paciente->nacionalidad);
            $paciente->barrio = Barrio::find($paciente->barrio);
            $paciente->nivelEducativo = NivelEducativo::find($paciente->nivelEducativo);
            $paciente->seguro = Seguro::find($paciente->seguro);
            $paciente->profesion = Profesion::find($paciente->profesion);
        });
        return view('paciente.index', compact('pacientes', $pacientes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $nacionalidades = Nacionalidad::orderBy('nombre', 'ASC')->get();
        $barrios = Barrio::orderBy('nombre', 'ASC')->get();
        $profesiones = Profesion::orderBy('nombre', 'ASC')->get();
        $niveles = NivelEducativo::orderBy('nombre', 'ASC')->get();
        $seguros = Seguro::orderBy('nombre', 'ASC')->get();
        $paciente = new Paciente();
        $sexos = $paciente->getSexos();
        $estados_civiles = Paciente::PACIENTE_ESTADO_CIVIL;
        $tipos_lugares = Paciente::PACIENTE_TIPO_LUGAR;
        $tipos_documentos = Paciente::PACIENTE_TIPO_DOCUMENTO;
        $etnias = Paciente::PACIENTE_ETNIA;
        $areas = Paciente::PACIENTE_AREA;
        $situaciones_laborales = Paciente::PACIENTE_SITUACION_LABORAL;
        $fecha_ingreso = date('d-m-Y');
        return view('paciente.create')
            ->with('establecimientos', $establecimientos)
            ->with('nacionalidades', $nacionalidades)
            ->with('barrios', $barrios)
            ->with('niveles', $niveles)
            ->with('seguros', $seguros)
            ->with('profesiones', $profesiones)
            ->with('sexos', $sexos)
            ->with('estados_civiles', $estados_civiles)
            ->with('tipos_lugares', $tipos_lugares)
            ->with('tipos_documentos', $tipos_documentos)
            ->with('etnias', $etnias)
            ->with('areas', $areas)
            ->with('situaciones_laborales', $situaciones_laborales)
            ->with('fecha_ingreso', $fecha_ingreso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePacienteRequest $request)
    {
        $paciente = new Paciente($request->all());
        $paciente->save();
        return redirect('/paciente')->with('success', 'Paciente grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $nacionalidades = Nacionalidad::orderBy('nombre', 'ASC')->get();
        $barrios = Barrio::orderBy('nombre', 'ASC')->get();
        $profesiones = Profesion::orderBy('nombre', 'ASC')->get();
        $niveles = NivelEducativo::orderBy('nombre', 'ASC')->get();
        $seguros = Seguro::orderBy('nombre', 'ASC')->get();
        $sexos = $paciente->getSexos();
        $estados_civiles = Paciente::PACIENTE_ESTADO_CIVIL;
        $tipos_lugares = Paciente::PACIENTE_TIPO_LUGAR;
        $tipos_documentos = Paciente::PACIENTE_TIPO_DOCUMENTO;
        $etnias = Paciente::PACIENTE_ETNIA;
        $areas = Paciente::PACIENTE_AREA;
        $situaciones_laborales = Paciente::PACIENTE_SITUACION_LABORAL;
        return view('paciente.edit')
            ->with('paciente', $paciente)
            ->with('establecimientos', $establecimientos)
            ->with('nacionalidades', $nacionalidades)
            ->with('barrios', $barrios)
            ->with('niveles', $niveles)
            ->with('seguros', $seguros)
            ->with('profesiones', $profesiones)
            ->with('sexos', $sexos)
            ->with('estados_civiles', $estados_civiles)
            ->with('tipos_lugares', $tipos_lugares)
            ->with('tipos_documentos', $tipos_documentos)
            ->with('etnias', $etnias)
            ->with('areas', $areas)
            ->with('situaciones_laborales', $situaciones_laborales);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->fill($request->all());
        $paciente->save();
        return redirect('/paciente')->with('success', 'Paciente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $paciente = Paciente::findOrFail($request->id);
        $paciente->delete();
        return redirect()->route('paciente.index')->with('success', 'Paciente eliminado correctamente');
    }
}
