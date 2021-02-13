<?php

namespace App\Http\Controllers\HorarioAtencion;

use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\HorarioAtencion;
use App\Http\Controllers\Controller;
use App\Http\Requests\HorarioAtencion\StoreHorarioAtencionRequest;
use App\Http\Requests\HorarioAtencion\UpdateHorarioAtencionRequest;
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
        $funcionarios = Funcionario::where('estado', Funcionario::FUNCIONARIO_ACTIVO)->orderBy('nombres', 'ASC')->get();
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
    public function store(StoreHorarioAtencionRequest $request)
    {
        $horario = new HorarioAtencion($request->all());
        $hora_desde = $request->hora_desde;
        $hora_hasta = $request->hora_hasta;
        $dia = $request->dia;
        $funcionario = $request->funcionario;
        $horarioCount = HorarioAtencion::where(function ($query) use ($funcionario, $dia, $hora_desde, $hora_hasta) {
            $query->where(function ($query) use ($funcionario, $dia, $hora_desde, $hora_hasta) {
                $query->where('hora_desde', '<=', $hora_desde)
                    ->where('hora_hasta', '>=', $hora_desde)
                    ->where('funcionario', '=', $funcionario)
                    ->where('dia', '=', $dia);
            })
                ->orWhere(function ($query) use ($funcionario, $dia, $hora_desde, $hora_hasta) {
                    $query->where('hora_desde', '<=', $hora_hasta)
                        ->where('hora_hasta', '>=', $hora_hasta)
                        ->where('funcionario', '=', $funcionario)
                        ->where('dia', '=', $dia);
                });
        })->count();
        if ($horarioCount > 0) {
            return redirect()->back()->with('error', 'El horario ingresado ya se encuentra asignado al funcionario');
        } else {
            $horario->save();
            return redirect('/horario')->with('success', 'Horario de Atención grabado correctamente');
        }
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
        $funcionarios = Funcionario::where('estado', Funcionario::FUNCIONARIO_ACTIVO)->orderBy('nombres', 'ASC')->get();
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
    public function update(UpdateHorarioAtencionRequest $request, HorarioAtencion $horario)
    {
        $horario->fill($request->all());
        $hora_desde = $request->hora_desde;
        $hora_hasta = $request->hora_hasta;
        $dia = $request->dia;
        $funcionario = $request->funcionario;
        $id = $horario->horario;
        $horarioCount = HorarioAtencion::where(function ($query) use ($funcionario, $dia, $hora_desde, $hora_hasta, $id) {
            $query->where(function ($query) use ($funcionario, $dia, $hora_desde, $id) {
                $query->where('hora_desde', '<=', $hora_desde)
                    ->where('hora_hasta', '>=', $hora_desde)
                    ->where('funcionario', '=', $funcionario)
                    ->where('dia', '=', $dia)
                    ->where('horario', '<>', $id);
            })
                ->orWhere(function ($query) use ($funcionario, $dia, $hora_hasta, $id) {
                    $query->where('hora_desde', '<=', $hora_hasta)
                        ->where('hora_hasta', '>=', $hora_hasta)
                        ->where('funcionario', '=', $funcionario)
                        ->where('dia', '=', $dia)
                        ->where('horario', '<>', $id);
                });
        })->count();
        if ($horarioCount > 0) {
            return redirect()->back()->with('error', 'El horario ingresado ya se encuentra asignado al funcionario');
        } else {
            $horario->save();
            return redirect('/horario')->with('success', 'Horario de Atención actualizado correctamente');
        }
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
