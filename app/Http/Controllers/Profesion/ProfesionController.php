<?php

namespace App\Http\Controllers\Profesion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profesion\StoreProfesionRequest;
use App\Http\Requests\Profesion\UpdateProfesionRequest;
use App\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesiones = Profesion::all();
        return View::make('profesion.index')
            ->with('profesiones', $profesiones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profesion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesionRequest $request)
    {
        $profesion = new Profesion([
            'nombre' => $request->get('nombre')
        ]);
        $profesion->save();
        return redirect('/profesion')->with('success', 'Profesion grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function show(Profesion $profesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesion $profesion)
    {
        return view('profesion.edit')->with('profesion',$profesion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfesionRequest $request, Profesion $profesion)
    {
        $profesion->fill($request->all());
    	$profesion->save();
    	return redirect('/profesion')->with('success', 'Profesion actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $profesion = Profesion::findOrFail($request->id);
        $profesion->delete();
        return redirect()->route('profesion.index')->with('success', 'Profesion eliminada correctamente');
    }
}
