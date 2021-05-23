<?php

namespace App\Http\Controllers\Derivacion;

use App\Admision;
use App\Barrio;
use App\Derivacion;
use App\Enfermedad;
use App\EspecialidadMedica;
use App\Establecimiento;
use App\Funcionario;
use App\Distrito;
use App\HorarioAtencion;
use App\Http\Controllers\Controller;
use App\Http\Requests\Derivacion\StoreReferenciaRequest;
use App\Mail\TestMail;
use App\Paciente;
use App\RegistroConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referencias = Derivacion::where('tipo', '1')->get();
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;
        $referencias->each(function ($referencia) {
            $referencia->establecimiento = Establecimiento::find($referencia->establecimiento);
            $referencia->establecimiento_derivacion = Establecimiento::find($referencia->establecimiento_derivacion);
            $referencia->paciente = Paciente::find($referencia->paciente);
            $referencia->profesional_derivante = Funcionario::find($referencia->profesional_derivante);
            $referencia->profesional_derivado = Funcionario::find($referencia->profesional_derivado);
        });
        return view('referencia.index')
            ->with('referencias', $referencias)
            ->with('prioridades', $prioridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($consulta)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReferenciaRequest $request)
    {
        $referencia = new Derivacion($request->all());
        $referencia->profesional_derivado = null;
        DB::transaction(function () use ($referencia, $request) {
            if (isset($request['profesional_derivado'])) {
                $horario = HorarioAtencion::find($request['profesional_derivado']);
                $referencia->fecha = now();
                $referencia->profesional_derivado = $horario->funcionario;
                $referencia->usuario = Auth::user()->usuario;
                $referencia->save();
                $horario->uso_atencion = $horario->uso_atencion + 1;
                $horario->save();
            }
        });
        $this->enviarEmail($referencia);

        return redirect('/referencia')->with('success', 'Referencia grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function show($referencium)
    {
        $consulta = RegistroConsulta::find($referencium);
        $establecimiento_origen = Establecimiento::where('establecimiento', $consulta->establecimiento)->get();
        $establecimientos = Establecimiento::where('establecimiento', '!=', $consulta->establecimiento)->get();
        $pacientes = Paciente::where('paciente', $consulta->paciente)->get();
        $profesional_derivante = Funcionario::where('funcionario', $consulta->profesional)->get();
        $profesionales = collect([]); //Funcionario::where('funcionario', '!=', $consulta->profesional)->get();
        $especialidades = EspecialidadMedica::all();
        $enfermedades = Enfermedad::all();
        $tipos = Derivacion::TIPO_DERIVACION;
        $estados = Derivacion::DERIVACION_ESTADO;
        $prioridades = Derivacion::PRIORIDAD_DERIVACION;

        return view('referencia.create')
            ->with('consulta', $consulta)
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
        $derivacion->tipo = Derivacion::TIPO_DERIVACION['1'];
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
        return redirect('/referencia')->with('success', 'Referencia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Derivacion  $derivacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $referencia = Derivacion::findOrFail($request->id);
        $referencia->delete();
        return redirect()->route('referencia.index')->with('success', 'Referencia eliminada correctamente');
    }

    private function enviarEmail($referencia)
    {
        $details = [
            'subject' => 'Confirmación de Referencia',
            'template' => 'referenciaMail',
            'value' => $referencia->derivacion,
        ];
        $derivante = Funcionario::find($referencia->profesional_derivante);
        $derivado = Funcionario::find($referencia->profesional_derivado);
        if ($derivante->email) {
            Mail::to($derivante->email)->send(new TestMail($details));
        }
        if ($derivado->email) {
            Mail::to($derivado->email)->send(new TestMail($details));
        }
    }

    public function getProfesional($establecimiento = 0, $especialidad = 0, $derivante = 0, $dia = 0)
    {
        $where = 'especialidad = ' . $especialidad . ' AND dia = ' . $dia . ' AND establecimiento = ' . $establecimiento . ' AND funcionario != ' . $derivante . ' AND capacidad_atencion > uso_atencion';
        $data['data'] = HorarioAtencion::orderby('hora_desde')
            ->select('horario', 'funcionario', 'hora_desde', 'hora_hasta')
            ->whereRaw($where)
            ->get();
        return response()->json($data);
    }
}
