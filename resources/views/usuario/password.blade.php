@extends('layouts.app')

@section('title', 'Cambiar Contraseña')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('usuario.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active">Cambiar Contraseña</a></li>
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
                                <h3 class="card-title">Cambiar Contraseña</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('usuario.change-password') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usuario">Usuario</label>
                                                <input class="form-control"
                                                    readonly
                                                    type="text"
                                                    name="usuario"
                                                    id="usuario"
                                                    value="{{ $usuario->usuario }}"
                                                    placeholder="Introduzca el usuario">
                                                    @foreach ($errors->get('usuario') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="clave_actual">Contraseña Actual</label>
                                                <input class="form-control"
                                                    type="password"
                                                    name="clave_actual"
                                                    id="clave_actual"
                                                    value="{{ old('clave_actual') }}"
                                                    placeholder="Introduzca la contraseña actual">
                                                    @foreach ($errors->get('clave_actual') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="clave"> Nueva Contraseña</label>
                                                <input class="form-control"
                                                    type="password"
                                                    name="clave"
                                                    id="clave"
                                                    value="{{ old('clave') }}"
                                                    placeholder="Introduzca la nueva contraseña">
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
                                                    placeholder="Vuelva a introducir la nueva contraseña">
                                                    @foreach ($errors->get('clave') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('home') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

