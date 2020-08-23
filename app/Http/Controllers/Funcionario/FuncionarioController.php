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
}
