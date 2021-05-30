<?php

namespace App\Http\Controllers\Derivacion;

use App\Barrio;
use App\Derivacion;
use App\Enfermedad;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\Paciente;
use App\Distrito;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContrareferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establecimiento_usuario = Session::get('establecimiento');
        $contrareferencias = Derivacion::where('tipo', '2')
            ->where('establecimiento', $establecimiento_usuario->establecimiento)
            ->get();
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;
        $contrareferencias->each(function ($contrareferencia) {
            $contrareferencia->establecimiento = Establecimiento::find($contrareferencia->establecimiento);
            $contrareferencia->establecimiento_derivacion = Establecimiento::find($contrareferencia->establecimiento_derivacion);
            $contrareferencia->paciente = Paciente::find($contrareferencia->paciente);
            $contrareferencia->profesional_derivante = Funcionario::find($contrareferencia->profesional_derivante);
            $contrareferencia->profesional_derivado = Funcionario::find($contrareferencia->profesional_derivado);
        });
        return view('contrareferencia.index')
            ->with('contrareferencias', $contrareferencias)
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

        $contrareferencia = new Derivacion($request->all());
        $contrareferencia->usuario = Auth::user()->usuario;
        $contrareferencia->contra_derivacion = null;
        $referencia = Derivacion::findOrFail($request->contra_derivacion);
        DB::transaction(function () use ($contrareferencia, $referencia) {
            $contrareferencia->save();
            $referencia->contra_derivacion = $contrareferencia->derivacion;
            $referencia->estado = '2'; //finalizado
            $referencia->update();
        });
        $this->enviarEmail($contrareferencia);

        return redirect('/contrarreferencia')->with('success', 'Contrareferencia grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function show($contrarreferencium)
    {
        $referencia = Derivacion::find($contrarreferencium);
        $establecimiento_origen = Establecimiento::where('establecimiento', $referencia->establecimiento_derivacion)->get();
        $establecimientos = Establecimiento::where('establecimiento', $referencia->establecimiento)->get();
        $pacientes = Paciente::where('paciente', $referencia->paciente)->get();
        $profesional_derivante = Funcionario::where('funcionario', $referencia->profesional_derivado)->get();
        $profesionales = Funcionario::where('funcionario', $referencia->profesional_derivante)->get();
        $especialidades = EspecialidadMedica::all();
        $enfermedades = Enfermedad::all();
        $tipos = Derivacion::TIPO_DERIVACION;
        $estados = Derivacion::DERIVACION_ESTADO;
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;

        return view('contrareferencia.create')
            ->with('referencia', $referencia)
            ->with('establecimientos', $establecimientos)
            ->with('establecimiento_origen', $establecimiento_origen)
            ->with('profesional_derivante', $profesional_derivante)
            ->with('pacientes', $pacientes)
            ->with('profesionales', $profesionales)
            ->with('especialidades', $especialidades)
            ->with('tipos', $tipos)
            ->with('estados', $estados)
            ->with('enfermedades', $enfermedades)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $derivacion = Derivacion::find($id);

        $derivacion->establecimiento = Establecimiento::find($derivacion->establecimiento);
        $derivacion->establecimiento->barrio = Barrio::find($derivacion->establecimiento->barrio);
        $derivacion->establecimiento->barrio->distrito = Distrito::find($derivacion->establecimiento->barrio->distrito);
        $derivacion->establecimiento_derivacion = Establecimiento::find($derivacion->establecimiento_derivacion);
        $derivacion->paciente = Paciente::find($derivacion->paciente);
        $derivacion->profesional_derivante = Funcionario::find($derivacion->profesional_derivante);
        $derivacion->profesional_derivado = Funcionario::find($derivacion->profesional_derivado);
        $derivacion->especialidad = EspecialidadMedica::find($derivacion->especialidad);
        $derivacion->cie_derivacion = Enfermedad::find($derivacion->cie_derivacion);
        $derivacion->tipo = Derivacion::TIPO_DERIVACION['2'];
        $derivacion->prioridad = Derivacion::PRIORIDAD_DERIVACION[$derivacion->prioridad];

        return view('referencia.reportes.ficha-referencia')
            ->with('derivacion', $derivacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $derivacion = Derivacion::findOrFail($id);
        $derivacion->fill($request->all());
        $derivacion->usuario = Auth::user()->usuario;
        $derivacion->update();
        return redirect('/contrarreferencia')->with('success', 'Contraeferencia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contrareferencia = Derivacion::findOrFail($request->id);
        $contrareferencia->delete();
        return redirect()->route('contrarreferencia.index')->with('success', 'Contrareferencia eliminada correctamente');
    }

    private function enviarEmail($referencia)
    {
        $details = [
            'subject' => 'Confirmación de Contrarreferencia',
            'template' => 'contrarreferenciaMail',
            'value' => $referencia->derivacion,
        ];
        $derivado = Funcionario::find($referencia->profesional_derivado);
        if ($derivado->email) {
            Mail::to($derivado->email)->send(new TestMail($details));
        }
    }
}
