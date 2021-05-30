<?php

namespace App\Http\Controllers\Admision;

use App\Admision;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Derivacion;
use App\Funcionario;
use App\HorarioAtencion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admision\StoreAdmisionRequest;
use App\Http\Requests\Admision\UpdateAdmisionRequest;
use App\Paciente;
use App\ServicioMedico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establecimiento_usuario = Session::get('establecimiento');
        $admisiones = Admision::where('establecimiento', $establecimiento_usuario->establecimiento)->get();
        $prioridades = Admision::ADMISION_PRIORIDAD;
        $admisiones->each(function ($admision) {
            $admision->establecimiento = Establecimiento::find($admision->establecimiento);
            $admision->paciente = Paciente::find($admision->paciente);
            $admision->profesional = Funcionario::find($admision->profesional);
            $admision->servicio = ServicioMedico::find($admision->servicio);
            $admision->especialidad = EspecialidadMedica::find($admision->especialidad);
        });
        return view('admision.index')
            ->with('admisiones', $admisiones)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $establecimiento = $request->session()->get('establecimiento');
        $establecimientos = Establecimiento::where('establecimiento', $establecimiento->establecimiento)->orderBy('nombre', 'ASC')->get();
        $pacientes = Paciente::where('estado', '1')->orderBy('nombres', 'ASC')->get();
        $especialidades = EspecialidadMedica::orderBy('nombre', 'ASC')->get();
        $profesionales = Funcionario::orderBy('nombres', 'ASC')->get();
        $servicios = ServicioMedico::orderBy('nombre', 'ASC')->get();
        $estados = Admision::ADMISION_ESTADO;
        $prioridades = Admision::ADMISION_PRIORIDAD;
        $derivaciones = Derivacion::where([
            ['tipo', '1'],
            ['estado', '1']
        ])->get();
        $derivaciones->each(function ($derivacion) {
            $derivacion->paciente = Paciente::find($derivacion->paciente);
        });
        return view('admision.create')
            ->with('establecimientos', $establecimientos)
            ->with('pacientes', $pacientes)
            ->with('especialidades', $especialidades)
            ->with('profesionales', $profesionales)
            ->with('servicios', $servicios)
            ->with('estados', $estados)
            ->with('prioridades', $prioridades)
            ->with('derivaciones', $derivaciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmisionRequest $request)
    {
        $admision = new Admision($request->all());
        $admision->profesional = null;
        $admision->fecha_registro = now();
        $admision->usuario = Auth::user()->usuario;
        if ($admision->derivacion == 'null') {
            $admision->derivacion = null;
        }
        DB::transaction(function () use ($admision, $request) {
            if (isset($request['profesional'])) {
                $horario = HorarioAtencion::find($request['profesional']);
                $admision->profesional = $horario->funcionario;
                $admision->save();
                $horario->uso_atencion = $horario->uso_atencion + 1;
                $horario->save();
            }
        });
        $admision->save();
        return redirect('/admision')->with('success', 'Admision grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admision  $admision
     * @return \Illuminate\Http\Response
     */
    public function show(Admision $admision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admision  $admision
     * @return \Illuminate\Http\Response
     */
    public function edit(Admision $admision)
    {
        $establecimientos = Establecimiento::orderBy('nombre', 'ASC')->get();
        $pacientes = Paciente::orderBy('nombres', 'ASC')->get();
        $especialidades = EspecialidadMedica::orderBy('nombre', 'ASC')->get();
        $horarios = HorarioAtencion::orderby('hora_desde')
            ->select('funcionario')
            ->with('funcionario')
            ->where('especialidad', $admision->especialidad)
            ->where('dia', $admision->fecha_admision->getWeekDay())
            ->where('establecimiento', $admision->establecimiento)
            ->get()
            ->pluck('funcionario');
        $profesionales = Funcionario::whereIn('funcionario', $horarios)->orderBy('nombres', 'ASC')->get();

        // $profesionales = Funcionario::orderBy('nombres', 'ASC')->get();

        $servicios = ServicioMedico::orderBy('nombre', 'ASC')->get();
        $estados = Admision::ADMISION_ESTADO;
        $prioridades = Admision::ADMISION_PRIORIDAD;
        $derivaciones = Derivacion::where([
            ['tipo', '1'],
            ['estado', '1']
        ])->get();
        $derivaciones->each(function ($derivacion) {
            $derivacion->paciente = Paciente::find($derivacion->paciente);
        });
        return view('admision.edit')
            ->with('admision', $admision)
            ->with('establecimientos', $establecimientos)
            ->with('pacientes', $pacientes)
            ->with('especialidades', $especialidades)
            ->with('profesionales', $profesionales)
            ->with('servicios', $servicios)
            ->with('estados', $estados)
            ->with('prioridades', $prioridades)
            ->with('derivaciones', $derivaciones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admision  $admision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmisionRequest $request, Admision $admision)
    {
        $admision->fill($request->all());
        if ($admision->derivacion == 'null') {
            $admision->derivacion = null;
        }
        $admision->save();
        return redirect('/admision')->with('success', 'Admision actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admision  $admision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $admision = Admision::findOrFail($request->id);
        $admision->delete();
        return redirect()->route('admision.index')->with('success', 'Admision eliminada correctamente');
    }


    public function getProfesional($establecimiento = 0, $especialidad = 0, $dia = 0)
    {
        $data['data'] = HorarioAtencion::orderby('hora_desde')
            ->select('horario', 'funcionario', 'hora_desde', 'hora_hasta')
            ->with('funcionario')
            ->where('especialidad', $especialidad)
            ->where('dia', $dia)
            ->where('establecimiento', $establecimiento)
            ->get();
        return response()->json($data);
    }
}
