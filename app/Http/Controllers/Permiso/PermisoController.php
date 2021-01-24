<?php

namespace App\Http\Controllers\Permiso;

use App\Acceso;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permiso\StorePermisoRequest;
use App\Http\Requests\Permiso\UpdatePermisoRequest;
use App\Perfil;
use App\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $accesos = Acceso::all();
        return view('permiso.create')
            ->with('perfiles', $perfiles)
            ->with('accesos', $accesos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoRequest $request)
    {
        $permiso = new Permiso();
        $permiso->perfil = $request->get('perfil');
        $permiso->fecha_asignacion = now();
        $accesos = $request->input('acceso', []);
        $habilitados = $request->input('habilitado', []);
        if ($accesos != 'null') {
            DB::transaction(function () use ($permiso, $accesos, $habilitados) {
                $permiso->save();
                if ($accesos != 'null') {
                    foreach ($accesos as $i => $acceso) {
                        $permiso->accesos()->attach($permiso, ['acceso' => $acceso, 'habilitado' => in_array($acceso, $habilitados)]);
                    }
                }
            });
            return redirect('/permiso')->with('success', 'Permiso grabado correctamente');
        } else {
            return redirect('/permiso')->with('warning', 'Debe ingresar al menos un acceso para grabar el permiso');
        }
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
        $accesos = Acceso::all();
        $permiso_accesos = $permiso->accesos()->get();
        return view('permiso.edit')
            ->with('permiso', $permiso)
            ->with('perfiles', $perfiles)
            ->with('accesos', $accesos)
            ->with('permiso_accesos', $permiso_accesos);
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
        $permiso->perfil = $request->get('perfil');
        $permiso->fecha_asignacion = now();
        $accesos = $request->input('acceso', []);
        $habilitados = $request->input('habilitado', []);
        if ($accesos != 'null') {
            DB::transaction(function () use ($permiso, $accesos, $habilitados) {
                $permiso->update();
                if ($accesos != 'null') {
                    $permiso->accesos()->delete();
                    foreach ($accesos as $i => $acceso) {
                        $permiso->accesos()->attach($permiso->permiso, ['acceso' => $acceso, 'habilitado' => in_array($acceso, $habilitados)]);
                    }
                }
            });
            return redirect('/permiso')->with('success', 'Permiso actualizado correctamente');
        } else {
            return redirect('/permiso')->with('warning', 'Debe ingresar al menos un acceso para grabar el permiso');
        }
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
        $permiso_accesos = $permiso->accesos()->get();
        foreach ($permiso_accesos as $acceso) {
            $acceso->detalle->delete();
        }
        $permiso->delete();
        return redirect()->route('permiso.index')->with('success', 'Permiso eliminado correctamente');
    }
}
