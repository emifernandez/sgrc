<?php

namespace App\Http\Controllers\Motivo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Motivo\StoreMotivoRequest;
use App\Http\Requests\Motivo\UpdateMotivoRequest;
use App\Motivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivos = Motivo::all();
        return View::make('motivo.index')
            ->with('motivos', $motivos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('motivo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotivoRequest $request)
    {
        $motivo = new Motivo([
            'descripcion' => $request->get('descripcion')
        ]);
        $motivo->save();
        return redirect('/motivo')->with('success', 'Motivo grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function show(Motivo $motivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Motivo $motivo)
    {
        return view('motivo.edit')->with('motivo', $motivo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotivoRequest $request, Motivo $motivo)
    {
        $motivo->fill($request->all());
        $motivo->save();
        return redirect('/motivo')->with('success', 'Motivo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $motivo = Motivo::findOrFail($request->id);
        $motivo->delete();
        return redirect()->route('motivo.index')->with('success', 'Motivo eliminado correctamente');
    }
}
