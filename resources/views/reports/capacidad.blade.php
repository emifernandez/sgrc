@extends('layouts.app')
@section('title', 'Informe de Capacidad de Atención')
@section('menu-header')
    <li class="breadcrumb-item active">Informe de Capacidad de Atención</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" id="form" method="POST" action="{{ route('capacidad.report') }}">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Red</label>
                        <select class="form-control" name="red" id="red">
                            <option value=null>Todos</option>
                            @foreach($redes as $key => $red)
                                <option value="{{ $red->red }}"
                                    @if($red->red == old('red')) selected @endif
                                    >{{ $red->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Establecimiento</label>
                        <select class="form-control" name="establecimiento" id="establecimiento">
                            <option value=null>Todos</option>
                            @foreach($establecimientos as $key => $establecimiento)
                                <option value="{{ $establecimiento->establecimiento }}"
                                    @if($establecimiento->establecimiento == old('establecimiento')) selected @endif
                                    >{{ $establecimiento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Especialidad</label>
                        <select class="form-control" name="especialidad" id="especialidad">
                            <option value=null>Todos</option>
                            @foreach($especialidades as $key => $especialidad)
                                <option value="{{ $especialidad->especialidad }}"
                                    @if($especialidad->especialidad == old('especialidad')) selected @endif
                                    >{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Profesional</label>
                        <select class="form-control" name="funcionario" id="funcionario">
                            <option value=null>Todos</option>
                            @foreach($funcionarios as $key => $funcionario)
                                <option value="{{ $funcionario->funcionario }}"
                                    @if($funcionario->funcionario == old('funcionario')) selected @endif
                                    >{{ $funcionario->nombres . ' ' .  $funcionario->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Dia</label>
                        <select class="form-control" name="dia" id="dia">
                            <option value=null>Todos</option>
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
                <div class="col-sm-2">
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
                <div class="col-sm-2">
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
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Cupo</label>
                        <div class="input-group">
                            <select class="form-control col-sm-6" name="cupo_selector" id="cupo_selector">
                                <option value=null>Todos</option>
                                <option value='>='>Mayor o Igual</option>
                                <option value='='>Igual</option>
                                <option value='<'>Menor</option>
                            </select>
                            <input class="form-control col-sm-6"
                                type="text"
                                name="cupo"
                                id="cupo"
                                value="{{ old('cupo') }}"
                                placeholder="0">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Capacidad</label>
                        <div class="input-group">
                            <select class="form-control col-sm-6" name="capacidad_selector" id="capacidad_selector">
                                <option value=null>Todos</option>
                                <option value='>='>Mayor o Igual</option>
                                <option value='='>Igual</option>
                                <option value='<'>Menor</option>
                            </select>
                            <input class="form-control col-sm-6"
                                type="text"
                                name="capacidad"
                                id="capacidad"
                                value="{{ old('capacidad') }}"
                                placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search" target="_blank"></i> Buscar</button>
            </div>
        </form>
    </div>
</div>
@endsection
