@extends('layouts.app')

@section('title', 'Contrareferencias')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('contrareferencia.index') }}">Contrareferencias</a></li>
    <li class="breadcrumb-item active">Crear Contrareferencia</a></li>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Crear Contrareferencia</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('contrareferencia.store') }}">
                                @csrf
                                <input type="hidden" name="consulta" id="consulta" value="{{ $referencia->consulta }}">
                                <input type="hidden" name="contra_derivacion" id="contra_derivacion" value="{{ $referencia->derivacion }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha"
                                                    id="fecha"
                                                    value="{{ old('fecha', $todayDate = date("d-m-Y")) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Prioridad</label>
                                                <select class="form-control" name="prioridad" id="prioridad">
                                                    @foreach($prioridades as $key => $prioridad)
                                                        <option value="{{ $key }}"
                                                            @if ($key == old('prioridad')) 
                                                                selected 
                                                            @elseif ($key == 2)
                                                                selected 
                                                            @endif
                                                            >{{ $prioridad }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('prioridad') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select class="form-control" name="tipo" id="tipo" readonly>
                                                        <option value="{{ '2' }}">{{ $tipos[2] }}</option>
                                                </select>
                                                @foreach ($errors->get('tipo') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado" readonly>
                                                    <option value="{{ '2' }}">{{ $estados[2] }}</option>
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Paciente</label>
                                                <select class="form-control" name="paciente" id="paciente" readonly>
                                                    @foreach($pacientes as $key => $paciente)
                                                        <option value="{{ $paciente->paciente }}"
                                                            @if($paciente->paciente == old('paciente')) selected @endif
                                                            >{{ $paciente->nombres }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('paciente') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Establecimiento Origen</label>
                                                <select class="form-control" name="establecimiento" id="establecimiento" readonly>
                                                    @foreach($establecimiento_origen as $key => $establecimiento)
                                                        <option value="{{ $establecimiento->establecimiento }}"
                                                            @if($establecimiento->establecimiento == old('establecimiento')) selected @endif
                                                            >{{ $establecimiento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('establecimiento') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesional Derivante</label>
                                                <select class="form-control" name="profesional_derivante" id="profesional_derivante" readonly>
                                                    @foreach($profesional_derivante as $key => $profesional)
                                                        <option value="{{ $profesional->funcionario }}"
                                                            @if($profesional->funcionario == old('profesional_derivante')) selected @endif
                                                            >{{ $profesional->nombres . ' ' . $profesional->apellidos}}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('profesional_derivante') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>CIE-10</label>
                                        <select class="form-control" name="cie_derivacion" id="cie_derivacion">
                                            @foreach($enfermedades as $key => $enfermedad)
                                                <option value="{{ $enfermedad->enfermedad }}"
                                                    @if($enfermedad->enfermedad == old('cie_derivacion')) selected @endif
                                                    >{{ $enfermedad->codigo }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('cie_derivacion') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Especialidad</label>
                                        <select class="form-control" name="especialidad" id="especialidad">
                                            @foreach($especialidades as $key => $especialidad)
                                                <option value="{{ $especialidad->especialidad }}"
                                                    @if($especialidad->especialidad == old('especialidad')) selected @endif
                                                    >{{ $especialidad->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('especialidad') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Establecimiento Destino</label>
                                        <select class="form-control" name="establecimiento_derivacion" id="establecimiento_derivacion">
                                            @foreach($establecimientos as $key => $establecimiento)
                                                <option value="{{ $establecimiento->establecimiento }}"
                                                    @if($establecimiento->establecimiento == old('establecimiento_derivacion')) selected @endif
                                                    >{{ $establecimiento->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('establecimiento_derivacion') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Profesional Derivado</label>
                                        <select class="form-control" name="profesional_derivado" id="profesional_derivante" >
                                            @foreach($profesionales as $key => $profesional)
                                                <option value="{{ $profesional->funcionario }}"
                                                    @if($profesional->funcionario == old('profesional_derivado')) selected @endif
                                                    >{{ $profesional->nombres . ' ' . $profesional->apellidos}}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('profesional_derivado') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion_caso">Descripción Caso</label>
                                        <textarea class="form-control"
                                            rows="2"
                                            name="descripcion_caso"
                                            id="descripcion_caso"
                                            value="{{ old('descripcion_caso') }}"
                                            placeholder="Introduzca descripcion del caso para la referencia"></textarea>
                                            @foreach ($errors->get('descripcion_caso') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="impresion_diagnostica">Impresión Diagnóstica</label>
                                        <textarea class="form-control"
                                            rows="2"
                                            name="impresion_diagnostica"
                                            id="impresion_diagnostica"
                                            value="{{ old('impresion_diagnostica') }}"
                                            placeholder="Introduzca impresión diagnóstica para la referencia"></textarea>
                                            @foreach ($errors->get('impresion_diagnostica') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="tratamiento_actual">Tratamiento Actual</label>
                                        <textarea class="form-control"
                                            rows="2"
                                            name="tratamiento_actual"
                                            id="tratamiento_actual"
                                            value="{{ old('tratamiento_actual') }}"
                                            placeholder="Introduzca tratamiento actual para la referencia"></textarea>
                                            @foreach ($errors->get('tratamiento_actual') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="recomendacion">Recomendación</label>
                                        <textarea class="form-control"
                                            rows="2"
                                            name="recomendacion"
                                            id="recomendacion"
                                            value="{{ old('recomendacion') }}"
                                            placeholder="Introduzca recomendación para la referencia"></textarea>
                                            @foreach ($errors->get('recomendacion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="situacion_sociofamiliar">Situación Socio familiar</label>
                                        <textarea class="form-control"
                                            rows="2"
                                            name="situacion_sociofamiliar"
                                            id="situacion_sociofamiliar"
                                            value="{{ old('situacion_sociofamiliar') }}"
                                            placeholder="Introduzca situacion sociofamiliar para la referencia"></textarea>
                                            @foreach ($errors->get('situacion_sociofamiliar') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('referencia.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>
</div>
@endsection