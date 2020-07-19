<?php

namespace App\Http\Controllers\Barrio;

use App\Barrio;
use App\Distrito;
use App\Http\Controllers\Controller;
use App\Http\Requests\Barrio\StoreBarrioRequest;
use App\Http\Requests\Barrio\UpdateBarrioRequest;
use Illuminate\Http\Request;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barrios = Barrio::all();
        $barrios->each(function($barrio)
        {
            $barrio->distrito = Distrito::find($barrio->distrito);
        });
        return view('barrio.index', compact('barrios', $barrios));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distritos = Distrito::orderBy('nombre', 'ASC')->get();
        return view('barrio.create')
            ->with('distritos', $distritos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarrioRequest $request)
    {
        $barrio = new Barrio($request->all());
        $barrio->save();
        return redirect('/barrio')->with('success', 'Barrio grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function show(Barrio $barrio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function edit(Barrio $barrio)
    {
        $distritos = Distrito::orderBy('nombre', 'ASC')->get();
        return view('barrio.edit')->with('barrio',$barrio)->with('distritos',$distritos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarrioRequest $request, Barrio $barrio)
    {
        $barrio->fill($request->all());
    	$barrio->save();
    	return redirect('/barrio')->with('success', 'Barrio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $barrio = Barrio::findOrFail($request->id);
        $barrio->delete();
        return redirect()->route('barrio.index')->with('success', 'Barrio eliminado correctamente');
    }
}
