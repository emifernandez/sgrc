<?php

namespace App\Http\Controllers\NivelEducativo;

use App\Http\Controllers\Controller;
use App\Http\Requests\NivelEducativo\StoreNivelEducativoRequest;
use App\Http\Requests\NivelEducativo\UpdateNivelEducativoRequest;
use App\NivelEducativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NivelEducativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles_educativos = NivelEducativo::all();
        return View::make('niveleducativo.index')
            ->with('niveles_educativos', $niveles_educativos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('niveleducativo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNivelEducativoRequest $request)
    {
        $nivel_educativo = new NivelEducativo([
            'nombre' => $request->get('nombre')
        ]);
        $nivel_educativo->save();
        return redirect('/nivel-educativo')->with('success', 'Nivel Educativo grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NivelEducativo  $nivelEducativo
     * @return \Illuminate\Http\Response
     */
    public function show(NivelEducativo $nivelEducativo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NivelEducativo  $nivelEducativo
     * @return \Illuminate\Http\Response
     */
    public function edit(NivelEducativo $nivelEducativo)
    {
        return view('niveleducativo.edit')->with('nivel_educativo', $nivelEducativo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NivelEducativo  $nivelEducativo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNivelEducativoRequest $request, NivelEducativo $nivelEducativo)
    {
        $nivelEducativo->fill($request->all());
        $nivelEducativo->save();
        return redirect('/nivel-educativo')->with('success', 'Nivel Educativo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NivelEducativo  $nivelEducativo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nivelEducativo = NivelEducativo::findOrFail($request->id);
        $nivelEducativo->delete();
        return redirect()->route('nivel-educativo.index')->with('success', 'Nivel Educativo eliminado correctamente');
    }
}
