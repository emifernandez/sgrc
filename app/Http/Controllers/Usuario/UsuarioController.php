<?php

namespace App\Http\Controllers\Usuario;

use App\Funcionario;
use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Hash;
use App\Perfil;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $usuarios->each(function ($usuario) {
            $usuario->funcionario = Funcionario::find($usuario->funcionario);
            $usuario->perfil = Perfil::find($usuario->perfil);
            if ($usuario->estado === Usuario::USUARIO_ACTIVO) {
                $usuario->estado = 'Activo';
            } else {
                $usuario->estado = 'Inactivo';
            }
        });
        return view('usuario.index', compact('usuarios', $usuarios));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionarios = Funcionario::where('estado', '=', Funcionario::FUNCIONARIO_ACTIVO)
            ->orderBy('nombres', 'ASC')
            ->get();
        $perfiles = Perfil::orderBy('nombre', 'ASC')->get();
        $usuario = new Usuario();
        $estados = $usuario->getEstados();
        return view('usuario.create')
            ->with('funcionarios', $funcionarios)
            ->with('perfiles', $perfiles)
            ->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioRequest $request)
    {
        $funcionario = Funcionario::find($request->funcionario);
        $usuario = new Usuario($request->all());
        $usuario->estado = Usuario::USUARIO_ACTIVO;
        $usuario->clave = Hash::make($request->clave);
        $usuario->fecha_validez = date('Y-m-d', strtotime($request->fecha_validez));
        $usuario->fecha_registro = now();
        if ($usuario->fecha_validez->lt($usuario->fecha_registro->subDays(1))) {
            $v = Validator::make([], []);
            $v->getMessageBag()->add('fecha_validez', 'La fecha de validez no puede ser menor a la fecha de registro');
            return Redirect::back()->withErrors($v)->withInput();
        }
        $usuario->save();
        return redirect('/usuario')->with('success', 'Usuario grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        $funcionarios = Funcionario::where('estado', '=', Funcionario::FUNCIONARIO_ACTIVO)
            ->orderBy('nombres', 'ASC')
            ->get();
        $perfiles = Perfil::orderBy('nombre', 'ASC')->get();
        $estados = $usuario->getEstados();
        return view('usuario.edit')
            ->with('usuario', $usuario)
            ->with('funcionarios', $funcionarios)
            ->with('perfiles', $perfiles)
            ->with('estados', $estados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->fill($request->all());
        $usuario->save();
        return redirect('/usuario')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $usuario = Usuario::findOrFail($request->id);
        $usuario->delete();
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente');
    }
}
