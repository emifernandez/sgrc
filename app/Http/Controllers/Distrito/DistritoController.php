<?php

namespace App\Http\Controllers\Distrito;

use App\Distrito;
use App\Http\Controllers\Controller;
use App\Http\Requests\Distrito\StoreDistritoRequest;
use App\Http\Requests\Distrito\UpdateDistritoRequest;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distritos = Distrito::all();
        $distritos->each(function ($distrito) {
            $distrito->region = Region::find($distrito->region);
        });
        return view('distrito.index', compact('distritos', $distritos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = Region::orderBy('nombre', 'ASC')->get();
        return view('distrito.create')
            ->with('regiones', $regiones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistritoRequest $request)
    {
        $distrito = new Distrito($request->all());
        $distrito->save();
        return redirect('/distrito')->with('success', 'Distrito grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function show(Distrito $distrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Distrito $distrito)
    {
        $regiones = Region::orderBy('nombre', 'ASC')->get();
        return view('distrito.edit')->with('distrito', $distrito)->with('regiones', $regiones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistritoRequest $request, Distrito $distrito)
    {
        $distrito->fill($request->all());
        $distrito->save();
        return redirect('/distrito')->with('success', 'Distrito actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $distrito = Distrito::findOrFail($request->id);
        $distrito->delete();
        return redirect()->route('distrito.index')->with('success', 'Distrito eliminado correctamente');
    }
}
