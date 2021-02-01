@extends('layouts.header')
@section('title', 'Informe de Horarios de Atención')
@section('menu-header')
    <li class="breadcrumb-item active">Informe de Horarios de Atención</a></li>
@endsection
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
              @yield('menu-header')
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <main class="py-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" id="form" method="POST" action="{{ route('profesional.report') }}">
                            @csrf
                            <div class="row">
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
                            </div>
                            <div class="row">
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
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
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
            </main>
        </div>
    </div>
@endsection
