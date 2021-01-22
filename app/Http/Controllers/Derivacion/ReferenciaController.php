<?php

namespace App\Http\Controllers\Derivacion;

use App\Derivacion;
use App\Enfermedad;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\Http\Controllers\Controller;
use App\Paciente;
use App\RegistroConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referencias = Derivacion::where('tipo', '1')->get();
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;
        $referencias->each(function ($referencia) {
            $referencia->establecimiento = Establecimiento::find($referencia->establecimiento);
            $referencia->establecimiento_derivacion = Establecimiento::find($referencia->establecimiento_derivacion);
            $referencia->paciente = Paciente::find($referencia->paciente);
            $referencia->profesional_derivante = Funcionario::find($referencia->profesional_derivante);
            $referencia->profesional_derivado = Funcionario::find($referencia->profesional_derivado);
        });
        return view('referencia.index')
            ->with('referencias', $referencias)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($consulta)
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
        $referencia = new Derivacion($request->all());
        $referencia->usuario = Auth::user()->usuario;
        $referencia->save();
        return redirect('/referencia')->with('success', 'Referencia grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function show($consulta)
    {
        $consulta = RegistroConsulta::find($consulta);
        $establecimiento_origen = Establecimiento::where('establecimiento', $consulta->establecimiento)->get();
        $establecimientos = Establecimiento::where('establecimiento', '!=', $consulta->establecimiento)->get();
        $pacientes = Paciente::where('paciente', $consulta->paciente)->get();
        $profesional_derivante = Funcionario::where('funcionario', $consulta->profesional)->get();
        $profesionales = Funcionario::where('funcionario', '!=', $consulta->profesional)->get();
        $especialidades = EspecialidadMedica::all();
        $enfermedades = Enfermedad::all();
        $tipos = Derivacion::TIPO_DERIVACION;
        $estados = Derivacion::DERIVACION_ESTADO;
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;

        return view('referencia.create')
            ->with('consulta', $consulta)
            ->with('establecimientos', $establecimientos)
            ->with('establecimiento_origen', $establecimiento_origen)
            ->with('profesional_derivante', $profesional_derivante)
            ->with('pacientes', $pacientes)
            ->with('profesionales', $profesionales)
            ->with('especialidades', $especialidades)
            ->with('tipos', $tipos)
            ->with('estados', $estados)
            ->with('enfermedades', $enfermedades)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $derivacion = Derivacion::find($id);
        $establecimiento_origen = Establecimiento::where('establecimiento', $derivacion->establecimiento)->get();
        $establecimientos = Establecimiento::where('establecimiento', '!=', $derivacion->establecimiento)->get();
        $pacientes = Paciente::where('paciente', $derivacion->paciente)->get();
        $profesional_derivante = Funcionario::where('funcionario', $derivacion->profesional_derivante)->get();
        $profesionales = Funcionario::where('funcionario', '!=', $derivacion->profesional_derivante)->get();
        $especialidades = EspecialidadMedica::all();
        $enfermedades = Enfermedad::all();
        $tipos = Derivacion::TIPO_DERIVACION;
        $estados = Derivacion::DERIVACION_ESTADO;
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;

        return view('referencia.edit')
            ->with('derivacion', $derivacion)
            ->with('establecimientos', $establecimientos)
            ->with('establecimiento_origen', $establecimiento_origen)
            ->with('profesional_derivante', $profesional_derivante)
            ->with('pacientes', $pacientes)
            ->with('profesionales', $profesionales)
            ->with('especialidades', $especialidades)
            ->with('tipos', $tipos)
            ->with('estados', $estados)
            ->with('enfermedades', $enfermedades)
            ->with('prioridades', $prioridades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $derivacion = Derivacion::findOrFail($id);
        $derivacion->fill($request->all());
        $derivacion->usuario = Auth::user()->usuario;
        $derivacion->update();
        return redirect('/referencia')->with('success', 'Referencia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $referencia = Derivacion::findOrFail($request->id);
        $referencia->delete();
        return redirect()->route('referencia.index')->with('success', 'Referencia eliminada correctamente');
    }
}
