<?php

namespace App\Http\Controllers\Tipo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tipo\StoreTipoRequest;
use App\Http\Requests\Tipo\UpdateTipoRequest;
use App\NivelAtencion;
use App\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();
        $tipos->each(function($tipo)
        {
            $tipo->nivel = NivelAtencion::find($tipo->nivel);
        });
        return view('tipo.index', compact('tipos', $tipos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = NivelAtencion::orderBy('nombre', 'ASC')->get();
        return view('tipo.create')
            ->with('niveles', $niveles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoRequest $request)
    {
        $tipo = new Tipo($request->all());
        $tipo->save();
        return redirect('/tipo')->with('success', 'Tipo grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo $tipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {
        $niveles = NivelAtencion::orderBy('nombre', 'ASC')->get();
        return view('tipo.edit')->with('tipo',$tipo)->with('niveles',$niveles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoRequest $request, Tipo $tipo)
    {
        $tipo->fill($request->all());
    	$tipo->save();
    	return redirect('/tipo')->with('success', 'Tipo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tipo = Tipo::findOrFail($request->id);
        $tipo->delete();
        return redirect()->route('tipo.index')->with('success', 'Tipo eliminado correctamente');
    }
}
