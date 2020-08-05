<?php

namespace App\Http\Controllers\EspecialidadMedica;

use App\EspecialidadMedica;
use App\Http\Controllers\Controller;
use App\Http\Requests\EspecialidadMedica\StoreEspecialidadMedicaRequest;
use App\Http\Requests\EspecialidadMedica\UpdateEspecialidadMedicaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EspecialidadMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = EspecialidadMedica::all();
        return View::make('especialidadmedica.index')
            ->with('especialidades', $especialidades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidadmedica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEspecialidadMedicaRequest $request)
    {

        $especialidad = new EspecialidadMedica([
            'nombre' => $request->get('nombre')
        ]);
        $especialidad->save();
        return redirect('/especialidad')->with('success', 'Especialidad Médica grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EspecialidadMedica  $especialidadMedica
     * @return \Illuminate\Http\Response
     */
    public function show(EspecialidadMedica $especialidadMedica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EspecialidadMedica  $especialidadMedica
     * @return \Illuminate\Http\Response
     */
    public function edit(EspecialidadMedica $especialidad)
    {
        return view('especialidadmedica.edit')->with('especialidad',$especialidad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EspecialidadMedica  $especialidadMedica
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEspecialidadMedicaRequest $request, EspecialidadMedica $especialidad)
    {
        $especialidad->fill($request->all());
    	$especialidad->save();
    	return redirect('/especialidad')->with('success', 'Especialidad Médica actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EspecialidadMedica  $especialidadMedica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $especialidad = EspecialidadMedica::findOrFail($request->id);
        $especialidad->delete();
        return redirect()->route('especialidad.index')->with('success', 'Especialidad Médica eliminada correctamente');
    }
}
