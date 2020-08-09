<?php

namespace App\Http\Controllers\Cargo;

use App\Cargo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cargo\StoreCargoRequest;
use App\Http\Requests\Cargo\UpdateCargoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        return View::make('cargo.index')
            ->with('cargos', $cargos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCargoRequest $request)
    {
        $cargo = new Cargo([
            'nombre' => $request->get('nombre')
        ]);
        $cargo->save();
        return redirect('/cargo')->with('success', 'Cargo grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        return view('cargo.edit')->with('cargo',$cargo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCargoRequest $request, Cargo $cargo)
    {
        $cargo->fill($request->all());
    	$cargo->save();
    	return redirect('/cargo')->with('success', 'Cargo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cargo = Cargo::findOrFail($request->id);
        $cargo->delete();
        return redirect()->route('cargo.index')->with('success', 'Cargo eliminado correctamente');
    }
}
