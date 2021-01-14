<?php

namespace App\Http\Controllers\ServicioMedico;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicioMedico\StoreServicioMedicoRequest;
use App\Http\Requests\ServicioMedico\UpdateServicioMedicoRequest;
use App\ServicioMedico;
use Illuminate\Http\Request;

class ServicioMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = ServicioMedico::all();
        $servicios->each(function ($servicio) {
            if ($servicio->estado === ServicioMedico::SERVICIO_MEDICO_ACTIVO) {
                $servicio->estado = 'Activo';
            } else {
                $servicio->estado = 'Inactivo';
            }
        });
        return view('serviciomedico.index', compact('servicios', $servicios));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicio = new ServicioMedico();
        $estados = $servicio->getEstados();
        return view('serviciomedico.create')
            ->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicioMedicoRequest $request)
    {
        $servicio = new ServicioMedico($request->all());
        $servicio->estado = ServicioMedico::SERVICIO_MEDICO_ACTIVO;
        $servicio->save();
        return redirect('/servicio')->with('success', 'Servicio Medico grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServicioMedico  $servicioMedico
     * @return \Illuminate\Http\Response
     */
    public function show(ServicioMedico $servicioMedico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServicioMedico  $servicioMedico
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicioMedico $servicio)
    {
        $estados = $servicio->getEstados();
        return view('serviciomedico.edit')
            ->with('servicio', $servicio)
            ->with('estados', $estados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServicioMedico  $servicioMedico
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicioMedicoRequest $request, ServicioMedico $servicio)
    {
        $servicio->fill($request->all());
        $servicio->save();
        return redirect('/servicio')->with('success', 'Servicio Medico actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServicioMedico  $servicioMedico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $servicio = ServicioMedico::findOrFail($request->id);
        $servicio->delete();
        return redirect()->route('servicio.index')->with('success', 'Servicio Medico eliminado correctamente');
    }
}
