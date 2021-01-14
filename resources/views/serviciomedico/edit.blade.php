@extends('layouts.app')

@section('title', 'Servicios Medicos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('servicio.index') }}">Servicios Medicos</a></li>
    <li class="breadcrumb-item active">Editar Servicio Medico</a></li>
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
                                <h3 class="card-title">Editar Servicio Medico</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('servicio.update', $servicio->servicio) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado">
                                                        <option value="{{ $estados['Activo']}}"
                                                        @if ($estados['Activo'] == old('estado', $servicio->estado))
                                                            selected="selected"
                                                        @endif> Activo</option>
                                                        <option value="{{ $estados['Inactivo']}}"
                                                        @if ($estados['Inactivo'] == old('estado', $servicio->estado))
                                                            selected="selected"
                                                        @endif> Inactivo</option>
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Servicio</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $servicio->nombre) }}"
                                            placeholder="Introduzca nombre del servicio medico">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('servicio.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

