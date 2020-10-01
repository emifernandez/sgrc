@extends('layouts.app')

@section('title', 'Asignar Establecimiento')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('usuario-establecimiento.index') }}">Establecimientos asignados a Usuarios</a></li>
    <li class="breadcrumb-item active">Asignar Establecimiento</a></li>
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
                                <h3 class="card-title">Asignar Establecimiento</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('usuario-establecimiento.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <select class="form-control" name="usuario" id="usuario">
                                                <option value="">Seleccione un Usuario</option>
                                            @foreach($usuarios as $key => $usuario)
                                                <option value="{{ $usuario->usuario }}"
                                                    @if($usuario->usuario == old('usuario')) selected @endif
                                                    >{{ $usuario->usuario }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('usuario') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Establecimiento</label>
                                        <select class="form-control" name="establecimiento" id="establecimiento">
                                                <option value="">Seleccione un Establecimiento</option>
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

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('usuario-establecimiento.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

