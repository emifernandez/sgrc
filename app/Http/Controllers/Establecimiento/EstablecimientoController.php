<?php

namespace App\Http\Controllers\Establecimiento;

use App\Barrio;
use App\Establecimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\Establecimiento\StoreEstablecimientoRequest;
use App\Http\Requests\Establecimiento\UpdateEstablecimientoRequest;
use App\Red;
use App\Tipo;
use Illuminate\Http\Request;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establecimientos = Establecimiento::all();
        $establecimientos->each(function($establecimiento)
        {
            $establecimiento->tipo = Tipo::find($establecimiento->tipo);
            $establecimiento->red = Red::find($establecimiento->red);
            $establecimiento->barrio = Barrio::find($establecimiento->barrio);
            if(isset($establecimiento->establecimiento_encargado)) {
                $establecimiento->establecimiento_encargado = Establecimiento::find($establecimiento->establecimiento_encargado);
            }
            if($establecimiento->estado === Establecimiento::ESTABLECIMIENTO_ACTIVO) {
                $establecimiento->estado = 'Activo';
            } else {
                $establecimiento->estado = 'Inactivo';
            }
        });
        return view('establecimiento.index', compact('establecimientos', $establecimientos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        $redes = Red::orderBy('nombre', 'ASC')->get();
        $barrios = Barrio::orderBy('nombre', 'ASC')->get();
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $establecimiento = new Establecimiento();
        $estados = $establecimiento->getEstados();
        return view('establecimiento.create')
            ->with('tipos', $tipos)
            ->with('redes', $redes)
            ->with('barrios', $barrios)
            ->with('establecimientos', $establecimientos)
            ->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstablecimientoRequest $request)
    {
        $establecimiento = new Establecimiento($request->all());
        if ($establecimiento->establecimiento_encargado == 'null') {
            $establecimiento->establecimiento_encargado = null;
        }
        $establecimiento->estado = Establecimiento::ESTABLECIMIENTO_ACTIVO;
        $establecimiento->save();
        return redirect('/establecimiento')->with('success', 'Establecimiento grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        $tipos = Tipo::orderBy('nombre', 'ASC')->get();
        $redes = Red::orderBy('nombre', 'ASC')->get();
        $barrios = Barrio::orderBy('nombre', 'ASC')->get();
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $establecimiento_estados = new Establecimiento();
        $estados = $establecimiento_estados->getEstados();
        return view('establecimiento.edit')
            ->with('establecimiento', $establecimiento)
            ->with('tipos', $tipos)
            ->with('redes', $redes)
            ->with('barrios', $barrios)
            ->with('establecimientos', $establecimientos)
            ->with('estados', $estados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstablecimientoRequest $request, Establecimiento $establecimiento)
    {
        $establecimiento->fill($request->all());
        if ($establecimiento->establecimiento_encargado == 'null') {
            $establecimiento->establecimiento_encargado = null;
        }
    	$establecimiento->save();
    	return redirect('/establecimiento')->with('success', 'Establecimiento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $establecimiento = Establecimiento::findOrFail($request->id);
        $establecimiento->delete();
        return redirect()->route('establecimiento.index')->with('success', 'Establecimiento eliminado correctamente');
    }

    public function report() {
        $pdf = \PDF::loadView('establecimiento.reportes.establecimiento');
        return $pdf->stream('Establecimientos.pdf');
    }
}
