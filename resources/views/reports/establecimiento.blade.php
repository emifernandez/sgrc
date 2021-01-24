@extends('layouts.app')
@section('title', 'Establecimientos')
@section('menu-header')
    <li class="breadcrumb-item active">Establecimientos</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" id="form" method="POST" action="{{ route('establecimiento.report') }}">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Región</label>
                        <select class="form-control" name="region" id="region">
                            <option value=null>Todos</option>
                            @foreach($regiones as $key => $region)
                                <option value="{{ $region->region }}"
                                    @if($region->region == old('region')) selected @endif
                                    >{{ $region->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value=null>Todos</option>
                            @foreach($tipos as $key => $tipo)
                                <option value="{{ $tipo->tipo }}"
                                    @if($tipo->tipo == old('tipo')) selected @endif
                                    >{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" id="estado">
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
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search" target="_blank"></i> Buscar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
