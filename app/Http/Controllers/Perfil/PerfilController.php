<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perfil\StorePerfilRequest;
use App\Perfil;
use App\Http\Helpers;
use App\Http\Requests\Perfil\UpdatePerfilRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles = Perfil::all();
        return View::make('perfil.index')
            ->with('perfiles', $perfiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perfil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerfilRequest $request)
    {
        $perfil = new Perfil([
            'nombre' => $request->get('nombre')
        ]);
        $perfil->save();
        return redirect('/perfil')->with('success', 'Perfil grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view('perfil.edit')->with('perfil',$perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerfilRequest $request, Perfil $perfil)
    {
        $perfil->fill($request->all());
    	$perfil->save();
    	return redirect('/perfil')->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perfil = Perfil::findOrFail($request->id);
        $perfil->delete();
        return redirect()->route('perfil.index')->with('success', 'Perfil eliminado correctamente');
    }
}
