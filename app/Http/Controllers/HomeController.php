<?php

namespace App\Http\Controllers;

use App\Permiso;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = Usuario::findOrFail(Auth::user()->usuario);
        $permisos = Permiso::where('perfil', $usuario->perfil)->get();
        if ($permisos->count() > 0) {
            return view('home');
        } else {
            return redirect()->route('block');
        }
    }
}
