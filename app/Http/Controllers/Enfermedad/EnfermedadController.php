<?php

namespace App\Http\Controllers\Enfermedad;

use App\Enfermedad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Enfermedad\StoreEnfermedadRequest;
use App\Http\Requests\Enfermedad\UpdateEnfermedadRequest;
use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enfermedades = Enfermedad::all();
        return view('enfermedad.index', compact('enfermedades', $enfermedades));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enfermedad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnfermedadRequest $request)
    {
        $enfermedad = new Enfermedad($request->all());
        $enfermedad->save();
        return redirect('/enfermedad')->with('success', 'Enfermedad grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enfermedad  $enfermedad
     * @return \Illuminate\Http\Response
     */
    public function show(Enfermedad $enfermedad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enfermedad  $enfermedad
     * @return \Illuminate\Http\Response
     */
    public function edit(Enfermedad $enfermedad)
    {
        return view('enfermedad.edit')->with('enfermedad', $enfermedad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enfermedad  $enfermedad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnfermedadRequest $request, Enfermedad $enfermedad)
    {
        $enfermedad->fill($request->all());
        $enfermedad->save();
        return redirect('/enfermedad')->with('success', 'Enfermedad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enfermedad  $enfermedad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $enfermedad = Enfermedad::findOrFail($request->id);
        $enfermedad->delete();
        return redirect()->route('enfermedad.index')->with('success', 'Enfermedad eliminada correctamente');
    }
}
