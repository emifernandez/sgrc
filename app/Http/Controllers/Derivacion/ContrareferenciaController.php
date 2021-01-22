<?php

namespace App\Http\Controllers\Derivacion;

use App\Derivacion;
use App\Enfermedad;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\Paciente;
use App\RegistroConsulta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContrareferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrareferencias = Derivacion::where('tipo', '2')->get();
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;
        $contrareferencias->each(function ($contrareferencia) {
            $contrareferencia->establecimiento = Establecimiento::find($contrareferencia->establecimiento);
            $contrareferencia->establecimiento_derivacion = Establecimiento::find($contrareferencia->establecimiento_derivacion);
            $contrareferencia->paciente = Paciente::find($contrareferencia->paciente);
            $contrareferencia->profesional_derivante = Funcionario::find($contrareferencia->profesional_derivante);
            $contrareferencia->profesional_derivado = Funcionario::find($contrareferencia->profesional_derivado);
        });
        return view('contrareferencia.index')
            ->with('contrareferencias', $contrareferencias)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function show($referencia)
    {
        // $referencia = Derivacion::find($referencia);
        // $establecimiento_origen = Establecimiento::where('establecimiento', $referencia->establecimiento)->get();
        // $establecimientos = Establecimiento::where('establecimiento', '!=', $referencia->establecimiento)->get();
        // $pacientes = Paciente::where('paciente', $referencia->paciente)->get();
        // $profesional_derivante = Funcionario::where('funcionario', $referencia->profesional)->get();
        // $profesionales = Funcionario::where('funcionario', '!=', $consulta->profesional)->get();
        // $especialidades = EspecialidadMedica::all();
        // $enfermedades = Enfermedad::all();
        // $tipos = Derivacion::TIPO_DERIVACION;
        // $estados = Derivacion::DERIVACION_ESTADO;
        // $prioridades = Derivacion::PRIORIDAD_DERIVACION;

        // return view('referencia.create')
        //     ->with('consulta', $consulta)
        //     ->with('establecimientos', $establecimientos)
        //     ->with('establecimiento_origen', $establecimiento_origen)
        //     ->with('profesional_derivante', $profesional_derivante)
        //     ->with('pacientes', $pacientes)
        //     ->with('profesionales', $profesionales)
        //     ->with('especialidades', $especialidades)
        //     ->with('tipos', $tipos)
        //     ->with('estados', $estados)
        //     ->with('enfermedades', $enfermedades)
        //     ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Derivacion $derivacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Derivacion $derivacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Derivacion $derivacion)
    {
        //
    }
}
