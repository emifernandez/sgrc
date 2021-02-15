<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Usuario;
use App\Establecimiento;
use App\Http\Requests\Usuario\StoreUsuarioEstablecimientoRequest;
use Illuminate\Http\Request;

class UsuarioEstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario_selected = isset($request->usuario) ? $request->usuario : null;
        $usuarios = Usuario::where('estado', '=', Usuario::USUARIO_ACTIVO)->get();
        if ($usuario_selected) {
            $establecimientos = Usuario::find($usuario_selected)->establecimientos;
        } else {
            $establecimientos = [];
        }

        return view('usuario.establecimiento.index')
            ->with('usuarios', $usuarios)
            ->with('establecimientos', $establecimientos)
            ->with('usuario_selected', $usuario_selected);
    }

    public function selection()
    {
        $usuarios = Usuario::where('estado', '=', Usuario::USUARIO_ACTIVO)->get();
        $establecimientos = [];
        return view('usuario.establecimiento.index')
            ->with('usuarios', $usuarios)
            ->with('establecimientos', $establecimientos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = Usuario::where('estado', '=', Usuario::USUARIO_ACTIVO)->get();
        $establecimientos = Establecimiento::where('estado', '=', Establecimiento::ESTABLECIMIENTO_ACTIVO)->get();
        return view('usuario.establecimiento.create')
            ->with('usuarios', $usuarios)
            ->with('establecimientos', $establecimientos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioEstablecimientoRequest $request)
    {
        $usuario = Usuario::find($request->usuario);
        $duplicado = false;
        foreach ($usuario->establecimientos as $establecimiento) {
            if ($establecimiento->pivot->establecimiento == $request->establecimiento) {
                $duplicado = true;
                break;
            }
        }
        if ($duplicado) {
            return redirect()->back()->with('error', 'El establecimiento ingresado ya se encuentra asignado al usuario');
        } else {
            $usuario->establecimientos()->syncWithoutDetaching($request->establecimiento);
            return redirect('/usuario-establecimiento')->with('success', 'Establecimiento asignado correctamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $usuario = Usuario::findOrFail($request->usuario);
        $usuario->establecimientos()->detach($request->id);
        return redirect()->route('usuario-establecimiento.index')
            ->with('success', 'Establecimiento eliminado correctamente')
            ->with('usuario_selected', $usuario->usuario);
    }
}
