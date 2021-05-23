@extends('layouts.app')

@section('title', 'Admisiones')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('admision.index') }}">Admisiones</a></li>
    <li class="breadcrumb-item active">Crear Admisión</a></li>
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
                                <h3 class="card-title">Crear Admisión</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('admision.store') }}">
                                @csrf
                                <div class="card-body">
                                <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="fecha_admision">Fecha Admisión</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha_admision"
                                                    id="fecha_admision"
                                                    value="{{ old('fecha_admision', $todayDate = date("d-m-Y")) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha_admision') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="fecha_registro">Fecha Registro</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    readonly
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha_registro"
                                                    id="fecha_registro"
                                                    value="{{ old('fecha_registro', $todayDate = date("d-m-Y")) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha_registro') as $error)
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
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado">
                                                    @foreach($estados as $key => $estado)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('estado')) selected @endif
                                                            >{{ $estado }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Establecimiento</label>
                                        <select class="form-control" name="establecimiento" id="establecimiento" readonly>
                                            @foreach($establecimientos as $key => $establecimiento)
                                                <option value="{{ $establecimiento->establecimiento }}"
                                                    @if($establecimiento->establecimiento == old('establecimiento')) selected @endif
                                                    >{{ $establecimiento->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('establecimiento') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Derivación</label>
                                        <select class="form-control" name="derivacion" id="derivacion">
                                        <option value="null">Sin Derivación</option>
                                            @foreach($derivaciones as $key => $derivacion)
                                                <option value="{{ $derivacion->derivacion }}"
                                                    @if($derivacion->derivacion == old('derivacion')) selected @endif
                                                    >{{ $derivacion->paciente->numero_documento . ' - ' . $derivacion->paciente->nombres }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('derivacion') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Paciente</label>
                                        <select class="form-control" name="paciente" id="paciente">
                                            <option value="">Seleccione un Paciente</option>
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
                                    <div class="form-group">
                                        <label>Especialidad</label>
                                        <select class="form-control" name="especialidad" id="especialidad">
                                            <option value="">Seleccione una Especialidad</option>
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
                                        <label>Profesional</label>
                                        <select class="form-control" name="profesional" id="profesional">
                                            <option value="">Seleccione un Profesional</option>
                                            @foreach($profesionales as $key => $profesional)
                                                <option value="{{ $profesional->funcionario }}"
                                                    @if($profesional->funcionario == old('profesional')) selected @endif
                                                    >{{ $profesional->nombres . ' ' . $profesional->apellidos }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('profesional') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Servicio Médico</label>
                                        <select class="form-control" name="servicio" id="servicio">
                                            <option value="">Seleccione un Servicio Médico</option>
                                            @foreach($servicios as $key => $servicio)
                                                <option value="{{ $servicio->servicio }}"
                                                    @if($servicio->servicio == old('servicio')) selected @endif
                                                    >{{ $servicio->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('servicio') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="observacion">Observación</label>
                                        <textarea class="form-control"
                                            rows="3"
                                            name="observacion"
                                            id="observacion"
                                            value="{{ old('observacion') }}"
                                            placeholder="Introduzca observación para la admisión">{{ old('observacion') }}</textarea>
                                            @foreach ($errors->get('observacion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('admision.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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
@section('scripts')
<script type="text/javascript" src="{!! asset('js/util.js') !!}"></script>
@endsection

