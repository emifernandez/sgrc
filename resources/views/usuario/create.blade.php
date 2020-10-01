@extends('layouts.app')

@section('title', 'Usuarios')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('usuario.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active">Crear Usuario</a></li>
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
                                <h3 class="card-title">Crear Usuario</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('usuario.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usuario">Usuario</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="usuario"
                                                    id="usuario"
                                                    value="{{ old('usuario') }}"
                                                    placeholder="Introduzca el usuario">
                                                    @foreach ($errors->get('usuario') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado" disabled>
                                                        <option value="{{ $estados['Activo']}}" selected> Activo</option>
                                                        <option value="{{ $estados['Inactivo']}}"> Inactivo</option>
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="clave">Contraseña</label>
                                                <input class="form-control"
                                                    type="password"
                                                    name="clave"
                                                    id="clave"
                                                    value="{{ old('clave') }}"
                                                    placeholder="Introduzca la contraseña para el usuario">
                                                    @foreach ($errors->get('clave') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="clave_confirmation">Confirme Contraseña</label>
                                                <input class="form-control"
                                                    type="password"
                                                    name="clave_confirmation"
                                                    id="clave_confirmation"
                                                    value="{{ old('clave_confirmation') }}"
                                                    placeholder="Introduzca la contraseña para el usuario">
                                                    @foreach ($errors->get('clave') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Perfil</label>
                                        <select class="form-control" name="perfil" id="perfil">
                                                <option value="">Seleccione un perfil</option>
                                            @foreach($perfiles as $key => $perfil)
                                                <option value="{{ $perfil->perfil }}"
                                                    @if($perfil->perfil == old('perfil')) selected @endif
                                                    >{{ $perfil->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('perfil') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Funcionario</label>
                                        <select class="form-control" name="funcionario" id="funcionario">
                                            <option value="">Seleccione un funcionario</option>
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fecha_validez">Fecha Validez</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha_validez"
                                                    id="fecha_validez"
                                                    value="{{ old('fecha_validez') }}">
                                                </div>
                                                @foreach ($errors->get('fecha_validez') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
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
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('usuario.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

