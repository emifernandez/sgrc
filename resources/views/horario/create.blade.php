@extends('layouts.app')

@section('title', 'Horarios de Atención')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('horario.index') }}">Horarios de Atención</a></li>
    <li class="breadcrumb-item active">Crear Horario</a></li>
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
                                <h3 class="card-title">Crear Horario</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('horario.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dia</label>
                                                <select class="form-control" name="dia" id="dia">
                                                    @foreach($dias as $key => $dia)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('dia')) selected @endif
                                                            >{{ $dia }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('dia') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
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
                                        <select class="form-control" name="establecimiento" id="establecimiento">
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
                                        <label>Funcionario</label>
                                        <select class="form-control" name="funcionario" id="funcionario">
                                            @foreach($funcionarios as $key => $funcionario)
                                                <option value="{{ $funcionario->funcionario }}"
                                                    @if($funcionario->funcionario == old('funcionario')) selected @endif
                                                    >{{ $funcionario->nombres . ' ' . $funcionario->apellidos }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('funcionario') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="hora_desde">Hora Desde</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control time"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="HH:MM"
                                                    data-mask
                                                    name="hora_desde"
                                                    id="hora_desde"
                                                    value="{{ old('hora_desde') }}">
                                                </div>
                                                    @foreach ($errors->get('hora_desde') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="hora_hasta">Hora Hasta</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control time"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="HH:MM"
                                                    data-mask
                                                    name="hora_hasta"
                                                    id="hora_hasta"
                                                    value="{{ old('hora_hasta') }}">
                                                </div>
                                                    @foreach ($errors->get('hora_hasta') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="capacidad_atencion">Capacidad Atención</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="capacidad_atencion"
                                                    id="capacidad_atencion"
                                                    value="{{ old('capacidad_atencion') }}"
                                                    placeholder="0">
                                                    @foreach ($errors->get('capacidad_atencion') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="uso_atencion">Uso Atención</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="uso_atencion"
                                                    id="uso_atencion"
                                                    value="{{ old('uso_atencion') }}"
                                                    placeholder="0">
                                                    @foreach ($errors->get('uso_atencion') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="observacion">Observacion</label>
                                        <textarea class="form-control"
                                            rows="3"
                                            name="observacion"
                                            id="observacion"
                                            value="{{ old('observacion') }}"
                                            placeholder="Introduzca observacion para el horario de atención">{{ old('observacion') }}</textarea>
                                            @foreach ($errors->get('observacion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('horario.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

