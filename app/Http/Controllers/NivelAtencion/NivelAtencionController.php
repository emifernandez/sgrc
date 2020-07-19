<?php

namespace App\Http\Controllers\NivelAtencion;

use App\Http\Controllers\Controller;
use App\NivelAtencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NivelAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = NivelAtencion::all();
        return View::make('nivelatencion.index')
            ->with('niveles', $niveles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nivelatencion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nivel = new NivelAtencion([
            'nombre' => $request->get('nombre')
        ]);
        $nivel->save();
        return redirect('/nivel')->with('success', 'Nivel de Atencion grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NivelAtencion  $nivel
     * @return \Illuminate\Http\Response
     */
    public function show(NivelAtencion $nivel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NivelAtencion  $nivel
     * @return \Illuminate\Http\Response
     */
    public function edit(NivelAtencion $nivel)
    {
        return view('nivelatencion.edit')->with('nivel',$nivel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NivelAtencion  $nivelAtencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NivelAtencion $nivel)
    {
        $nivel->fill($request->all());
    	$nivel->save();
    	return redirect('/nivel')->with('success', 'Nivel de Atencion actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NivelAtencion  $nivelAtencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nivel = NivelAtencion::findOrFail($request->id);
        $nivel->delete();
        return redirect()->route('nivel.index')->with('success', 'Nivel de Atencion eliminado correctamente');
    }
}
