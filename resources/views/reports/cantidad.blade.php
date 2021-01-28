@extends('layouts.app')
@section('title', 'Informe de Cantidades de Atención')
@section('menu-header')
    <li class="breadcrumb-item active">Informe de Cantidades de Atención</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" id="form" method="POST" action="{{ route('cantidad.report') }}">
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
            </div>
            
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search" target="_blank"></i> Buscar</button>
            </div>
        </form>
    </div>
</div>
@endsection
