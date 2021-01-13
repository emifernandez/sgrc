<?php

namespace App\Http\Controllers\Nacionalidad;

use App\Http\Controllers\Controller;
use App\Http\Requests\Nacionalidad\StoreNacionalidadRequest;
use App\Http\Requests\Nacionalidad\UpdateNacionalidadRequest;
use App\Nacionalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nacionalidades = Nacionalidad::all();
        return View::make('nacionalidad.index')
            ->with('nacionalidades', $nacionalidades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nacionalidad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNacionalidadRequest $request)
    {
        $nacionalidad = new Nacionalidad([
            'nombre' => $request->get('nombre')
        ]);
        $nacionalidad->save();
        return redirect('/nacionalidad')->with('success', 'Nacionalidad grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nacionalidad  $nacionalidad
     * @return \Illuminate\Http\Response
     */
    public function show(Nacionalidad $nacionalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nacionalidad  $nacionalidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Nacionalidad $nacionalidad)
    {
        return view('nacionalidad.edit')->with('nacionalidad', $nacionalidad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nacionalidad  $nacionalidad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNacionalidadRequest $request, Nacionalidad $nacionalidad)
    {
        $nacionalidad->fill($request->all());
        $nacionalidad->save();
        return redirect('/nacionalidad')->with('success', 'Nacionalidad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nacionalidad  $nacionalidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nacionalidad = Nacionalidad::findOrFail($request->id);
        $nacionalidad->delete();
        return redirect()->route('nacionalidad.index')->with('success', 'Nacionalidad eliminada correctamente');
    }
}
