@extends('layouts.app')
@section('title', 'Informe de Derivaciones')
@section('menu-header')
    <li class="breadcrumb-item active">Informe de Derivaciones</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" id="form" method="POST" action="{{ route('derivacion.report') }}">
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
                        <label>Establecimiento Origen</label>
                        <select class="form-control" name="establecimiento_origen" id="establecimiento_origen">
                            <option value=null>Todos</option>
                            @foreach($establecimientos as $key => $establecimiento)
                                <option value="{{ $establecimiento->establecimiento }}"
                                    @if($establecimiento->establecimiento == old('establecimiento_origen')) selected @endif
                                    >{{ $establecimiento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Establecimiento Destino</label>
                        <select class="form-control" name="establecimiento_destino" id="establecimiento_destino">
                            <option value=null>Todos</option>
                            @foreach($establecimientos as $key => $establecimiento)
                                <option value="{{ $establecimiento->establecimiento }}"
                                    @if($establecimiento->establecimiento == old('establecimiento_destino')) selected @endif
                                    >{{ $establecimiento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Profesional Derivante</label>
                        <select class="form-control" name="funcionario_derivante" id="funcionario_derivante">
                            <option value=null>Todos</option>
                            @foreach($funcionarios as $key => $funcionario)
                                <option value="{{ $funcionario->funcionario }}"
                                    @if($funcionario->funcionario == old('funcionario_derivante')) selected @endif
                                    >{{ $funcionario->nombres . ' ' .  $funcionario->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Profesional Derivado</label>
                        <select class="form-control" name="funcionario_derivado" id="funcionario_derivado">
                            <option value=null>Todos</option>
                            @foreach($funcionarios as $key => $funcionario)
                                <option value="{{ $funcionario->funcionario }}"
                                    @if($funcionario->funcionario == old('funcionario_derivado')) selected @endif
                                    >{{ $funcionario->nombres . ' ' .  $funcionario->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Paciente</label>
                        <select class="form-control" name="paciente" id="paciente">
                            <option value=null>Todos</option>
                            @foreach($pacientes as $key => $paciente)
                                <option value="{{ $paciente->paciente }}"
                                    @if($paciente->paciente == old('paciente')) selected @endif
                                    >{{ $paciente->nombres}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Motivo</label>
                        <select class="form-control" name="motivo" id="motivo">
                            <option value=null>Todos</option>
                            @foreach($motivos as $key => $motivo)
                                <option value="{{ $motivo->motivo }}"
                                    @if($motivo->motivo == old('funcionario_derivante')) selected @endif
                                    >{{ $motivo->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Diagnóstico</label>
                        <select class="form-control" name="enfermedad" id="enfermedad">
                            <option value=null>Todos</option>
                            @foreach($enfermedades as $key => $enfermedad)
                                <option value="{{ $enfermedad->enfermedad }}"
                                    @if($enfermedad->enfermedad == old('enfermedad')) selected @endif
                                    >{{ $enfermedad->codigo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value=null>Todos</option>
                            @foreach($tipos as $key => $tipo)
                                <option value="{{ $key }}"
                                    @if($key == old('tipo')) selected @endif
                                    >{{ $tipo }}</option>
                            @endforeach
                        </select>
                        @foreach ($errors->get('tipo') as $error)
                            <span class="text text-danger">{{ $error }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" id="estado" >
                            <option value=null>Todos</option>
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
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="fecha_desde">Fecha Desde</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask"
                            data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd-mm-yyyy"
                            data-mask
                            name="fecha_desde"
                            id="fecha_desde"
                            value="{{ old('fecha_desde') }}">
                        </div>
                            @foreach ($errors->get('fecha_desde') as $error)
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
                        <label for="fecha_hasta">Fecha Hasta</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask"
                            data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd-mm-yyyy"
                            data-mask
                            name="fecha_hasta"
                            id="fecha_hasta"
                            value="{{ old('fecha_hasta') }}">
                        </div>
                            @foreach ($errors->get('fecha_hasta') as $error)
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
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search" target="_blank"></i> Buscar</button>
            </div>
        </form>
    </div>
</div>
@endsection
