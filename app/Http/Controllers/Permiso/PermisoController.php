<?php

namespace App\Http\Controllers\Permiso;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permiso\StorePermisoRequest;
use App\Http\Requests\Permiso\UpdatePermisoRequest;
use App\Perfil;
use App\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::all();
        $permisos->each(function ($permiso) {
            $permiso->perfil = Perfil::find($permiso->perfil);
        });
        return view('permiso.index', compact('permisos', $permisos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles = Perfil::all();
        return view('permiso.create')
            ->with('perfiles', $perfiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoRequest $request)
    {
        $permiso = new Permiso($request->all());
        $permiso->fecha_asignacion = now();
        $permiso->save();
        return redirect('/permiso')->with('success', 'Permiso grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        $perfiles = Perfil::all();
        return view('permiso.edit')
            ->with('permiso', $permiso)
            ->with('perfiles', $perfiles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoRequest $request, Permiso $permiso)
    {
        $permiso->fill($request->all());
        if ($permiso->isDirty()) {
            $permiso->fecha_asignacion = now();
        }

        $permiso->save();
        return redirect('/permiso')->with('success', 'Permiso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $permiso = Permiso::findOrFail($request->id);
        $permiso->delete();
        return redirect()->route('permiso.index')->with('success', 'Permiso eliminado correctamente');
    }
}
