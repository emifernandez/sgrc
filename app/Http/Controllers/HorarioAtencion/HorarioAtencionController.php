<?php

namespace App\Http\Controllers\HorarioAtencion;

use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\HorarioAtencion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HorarioAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = HorarioAtencion::all();
        $estados = HorarioAtencion::ESTADOS;
        $dias = HorarioAtencion::DIAS;
        $horarios->each(function ($horario) {
            $horario->establecimiento = Establecimiento::find($horario->establecimiento);
            $horario->funcionario = Funcionario::find($horario->funcionario);
            $horario->especialidad = EspecialidadMedica::find($horario->especialidad);
        });
        return view('horario.index')
            ->with('horarios', $horarios)
            ->with('dias', $dias)
            ->with('estados', $estados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionarios = Funcionario::orderBy('nombres', 'ASC')->get();
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $especialidades = EspecialidadMedica::orderBy('nombre', 'ASC')->get();
        $estados = HorarioAtencion::ESTADOS;
        $dias = HorarioAtencion::DIAS;
        return view('horario.create')
            ->with('establecimientos', $establecimientos)
            ->with('funcionarios', $funcionarios)
            ->with('especialidades', $especialidades)
            ->with('dias', $dias)
            ->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $horario = new HorarioAtencion($request->all());
        $horario->save();
        return redirect('/horario')->with('success', 'Horario de Atención grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HorarioAtencion  $horarioAtencion
     * @return \Illuminate\Http\Response
     */
    public function show(HorarioAtencion $horarioAtencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorarioAtencion  $horarioAtencion
     * @return \Illuminate\Http\Response
     */
    public function edit(HorarioAtencion $horario)
    {
        $funcionarios = Funcionario::orderBy('nombres', 'ASC')->get();
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $especialidades = EspecialidadMedica::orderBy('nombre', 'ASC')->get();
        $estados = HorarioAtencion::ESTADOS;
        $dias = HorarioAtencion::DIAS;
        return view('horario.edit')
            ->with('horario', $horario)
            ->with('establecimientos', $establecimientos)
            ->with('funcionarios', $funcionarios)
            ->with('especialidades', $especialidades)
            ->with('dias', $dias)
            ->with('estados', $estados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HorarioAtencion  $horarioAtencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorarioAtencion $horario)
    {
        $horario->fill($request->all());
        $horario->save();
        return redirect('/horario')->with('success', 'Horario de Atención actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HorarioAtencion  $horarioAtencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $horario = HorarioAtencion::findOrFail($request->id);
        $horario->delete();
        return redirect()->route('horario.index')->with('success', 'Horario de Atención eliminado correctamente');
    }
}
