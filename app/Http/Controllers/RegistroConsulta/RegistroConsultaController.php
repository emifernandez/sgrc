<?php

namespace App\Http\Controllers\RegistroConsulta;

use App\Admision;
use App\Enfermedad;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\Http\Controllers\Controller;
use App\Indicacion;
use App\Motivo;
use App\Orden;
use App\Paciente;
use App\RegistroConsulta;
use App\ServicioMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegistroConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultas = RegistroConsulta::all();
        $consultas->each(function ($consulta) {
            $consulta->establecimiento = Establecimiento::find($consulta->establecimiento);
            $consulta->admision = Admision::find($consulta->admision);
            $consulta->paciente = Paciente::find($consulta->paciente);
            $consulta->profesional = Funcionario::find($consulta->profesional);
        });
        return view('registroconsulta.index', compact('consultas', $consultas));
    }


    public function pendientes()
    {
        $consultas = RegistroConsulta::all()->pluck('admision')->toArray();
        $admisiones = Admision::whereNotIn('admision', $consultas)->orderBy('prioridad', 'DESC')->get();
        $prioridades = Admision::ADMISION_PRIORIDAD;
        $admisiones->each(function ($admision) {
            $admision->establecimiento = Establecimiento::find($admision->establecimiento);
            $admision->paciente = Paciente::find($admision->paciente);
            $admision->profesional = Funcionario::find($admision->profesional);
            $admision->servicio = ServicioMedico::find($admision->servicio);
            $admision->especialidad = EspecialidadMedica::find($admision->especialidad);
        });
        return view('registroconsulta.pendientes.index')
            ->with('admisiones', $admisiones)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consultas = RegistroConsulta::all()->pluck('admision')->toArray();
        $admisiones = Admision::whereNotIn('admision', $consultas)->orderBy('prioridad', 'DESC')->get();
        if ($admisiones->count() > 0) {
            $consulta = new RegistroConsulta();
            $consulta->usuario = Auth::user()->usuario;
            $consulta->estado = $request->estado;
            $consulta->observacion = $request->observacion;
            $consulta->establecimiento = $request->establecimiento;
            $consulta->admision = $request->admision;
            $consulta->paciente = $request->paciente;
            $consulta->profesional = $request->profesional;
            $consulta->fecha = $request->fecha;
            $consulta->tipo_consulta = $request->tipo_consulta;

            $motivos = $request->input('motivo', []);
            $motivos_descripcion = $request->input('descripcion_motivo', []);
            $ordenes = $request->input('orden', []);
            $enfermedades = $request->input('enfermedad', []);
            $enfermedades_observaciones = $request->input('enfermedad_observacion', []);
            $indicaciones = $request->input('indicacion', []);
            DB::transaction(function () use ($consulta, $motivos, $motivos_descripcion, $ordenes, $enfermedades, $enfermedades_observaciones, $indicaciones) {
                //registro_consulta
                $consulta->save();

                //consultas_motivos
                if ($motivos != 'null') {
                    foreach ($motivos as $index => $motivo) {
                        $consulta->motivos()->attach($consulta, ['motivo' => $motivo, 'descripcion' => $motivos_descripcion[$index]]);
                    }
                }

                //consultas_ordenes
                if ($ordenes != 'null') {
                    $i = 0;
                    foreach ($ordenes as $index => $value) {
                        $orden = new Orden();
                        $orden->consulta = $consulta->consulta;
                        $orden->item = $index;
                        $orden->orden = $value;
                        $consulta->ordenes()->save($orden);
                    }
                }

                //consultas_diagnosticos
                if ($enfermedades != 'null') {
                    foreach ($enfermedades as $index => $enfermedad) {
                        $consulta->diagnosticos()->attach($consulta, ['enfermedad' => $enfermedad, 'observacion' => $enfermedades_observaciones[$index]]);
                    }
                }

                //consultas_indicaciones
                if ($indicaciones != 'null') {
                    $i = 0;
                    foreach ($indicaciones as $index => $value) {
                        $indicacion = new Indicacion();
                        $indicacion->consulta = $consulta->consulta;
                        $indicacion->item = $index;
                        $indicacion->indicacion = $value;
                        $consulta->indicaciones()->save($indicacion);
                    }
                }
            });
            return redirect()->route('registro-consulta.index')->with('success', 'Consulta grabada correctamente');
        } else {
            return redirect()->route('consultas.pendientes')->with('warning', 'Ya existe una consulta registrada para la admisión seleccionada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistroConsulta  $registroConsulta
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroConsulta $registroConsulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistroConsulta  $registroConsulta
     * @return \Illuminate\Http\Response
     */
    public function edit($admision)
    {
        $admision = Admision::find($admision);
        $establecimientos = Establecimiento::where('establecimiento', $admision->establecimiento)->get();
        $pacientes = Paciente::where('paciente', $admision->paciente)->get();
        $profesionales = Funcionario::where('funcionario', $admision->profesional)->get();
        $tipos_consultas = RegistroConsulta::TIPO_CONSULTA;
        $motivos = Motivo::all();
        $enfermedades = Enfermedad::all();
        $estados = RegistroConsulta::ESTADOS_CONSULTA;
        return view('registroconsulta.create')
            ->with('establecimientos', $establecimientos)
            ->with('admision', $admision)
            ->with('pacientes', $pacientes)
            ->with('profesionales', $profesionales)
            ->with('tipos_consultas', $tipos_consultas)
            ->with('motivos', $motivos)
            ->with('enfermedades', $enfermedades)
            ->with('estados', $estados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroConsulta  $registroConsulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroConsulta $registroConsulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroConsulta  $registroConsulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $consulta = RegistroConsulta::findOrFail($request->id);
        DB::transaction(function () use ($consulta) {
            $consulta->motivos()->delete();
            $consulta->ordenes()->delete();
            $consulta->diagnosticos()->delete();
            $consulta->indicaciones()->delete();
            $consulta->delete();
        });
        return redirect()->route('registro-consulta.index')->with('success', 'Consulta eliminada correctamente');
    }
}
