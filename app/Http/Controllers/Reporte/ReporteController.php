<?php

namespace App\Http\Controllers\Reporte;

use App\Establecimiento;
use App\Http\Controllers\Controller;
use App\Region;
use App\Tipo;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function establecimiento()
    {
        $regiones = Region::all();
        $tipos = Tipo::all();
        $estados = Establecimiento::ESTADOS;
        return view('reports.establecimiento')
            ->with('regiones', $regiones)
            ->with('tipos', $tipos)
            ->with('estados', $estados);
    }
}
