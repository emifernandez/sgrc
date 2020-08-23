@extends('layouts.app')

@section('title', 'Funcionarios')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('funcionario.index') }}">Funcionarios</a></li>
    <li class="breadcrumb-item active">Editar Funcionario</a></li>
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
                                <h3 class="card-title">Editar Funcionario</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('funcionario.update', $funcionario->funcionario) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="cedula_identidad">Cedula Identidad</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="cedula_identidad"
                                                    id="cedula_identidad"
                                                    value="{{ old('codigo', $funcionario->cedula_identidad) }}"
                                                    placeholder="Introduzca cedula de identidad del funcionario">
                                                    @foreach ($errors->get('cedula_identidad') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="registro_profesional">Registro Profesional</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="registro_profesional"
                                                    id="registro_profesional"
                                                    value="{{ old('registro_profesional', $funcionario->registro_profesional) }}"
                                                    placeholder="Introduzca registro profesional del funcionario">
                                                    @foreach ($errors->get('registro_profesional') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado">
                                                    <option value="{{ $estados['Activo']}}"
                                                    @if ($estados['Activo'] == old('estado', $funcionario->estado))
                                                        selected="selected"
                                                    @endif> Activo</option>
                                                    <option value="{{ $estados['Inactivo']}}"
                                                    @if ($estados['Inactivo'] == old('estado', $funcionario->estado))
                                                        selected="selected"
                                                    @endif> Inactivo</option>
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text alert-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombres"
                                            id="nombres"
                                            value="{{ old('nombres', $funcionario->nombres) }}"
                                            placeholder="Introduzca nombres del funcionario">
                                            @foreach ($errors->get('nombres') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input class="form-control"
                                            type="text"
                                            name="apellidos"
                                            id="apellidos"
                                            value="{{ old('apellidos', $funcionario->apellidos) }}"
                                            placeholder="Introduzca apellidos del funcionario">
                                            @foreach ($errors->get('apellidos') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                                <input class="form-control"
                                                    type="date"
                                                    name="fecha_nacimiento"
                                                    id="fecha_nacimiento"
                                                    value="{{ old('fecha_nacimiento', $funcionario->fecha_nacimiento) }}">
                                                    @foreach ($errors->get('fecha_nacimiento') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select class="form-control" name="sexo" id="sexo">
                                                        <option value="{{ $sexos['masculino']}}"
                                                        @if ($sexos['masculino'] == old('sexo', $funcionario->sexo))
                                                            selected="selected"
                                                        @endif> Masculino</option>
                                                        <option value="{{ $sexos['femenino']}}"
                                                        @if($sexos['femenino'] == old('sexo', $funcionario->sexo))
                                                            selected="selected"
                                                        @endif> Femenino</option>
                                                </select>
                                                @foreach ($errors->get('sexo') as $error)
                                                    <span class="text alert-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        <input class="form-control"
                                            type="text"
                                            name="direccion"
                                            id="direccion"
                                            value="{{ old('direccion', $funcionario->direccion) }}"
                                            placeholder="Introduzca direccion del funcionario">
                                            @foreach ($errors->get('direccion') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Barrio</label>
                                        <select class="form-control" name="barrio" id="barrio">
                                            @foreach($barrios as $key => $barrio)
                                                <option value="{{ $barrio->barrio }}"
                                                    @if($barrio->barrio == old('barrio', $funcionario->barrio)) selected @endif
                                                    >{{ $barrio->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('barrio') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="telefono_principal">Telefono Principal</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="telefono_principal"
                                                    id="telefono_principal"
                                                    value="{{ old('telefono_principal', $funcionario->telefono_principal) }}"
                                                    placeholder="Introduzca telefono principal del funcionario">
                                                    @foreach ($errors->get('telefono_principal') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="telefono_secundario">Telefono Secundario</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="telefono_secundario"
                                                    id="telefono_secundario"
                                                    value="{{ old('telefono_secundario', $funcionario->telefono_secundario) }}"
                                                    placeholder="Introduzca telefono secundario del funcionario">
                                                    @foreach ($errors->get('telefono_secundario') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control"
                                            type="email"
                                            name="email"
                                            id="email"
                                            value="{{ old('email', $funcionario->email) }}"
                                            placeholder="Introduzca email del funcionario">
                                            @foreach ($errors->get('email') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <select class="form-control" name="cargo" id="cargo">
                                            @foreach($cargos as $key => $cargo)
                                                <option value="{{ $cargo->cargo }}"
                                                    @if($cargo->cargo == old('cargo', $funcionario->cargo)) selected @endif
                                                    >{{ $cargo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('cargo') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Profesion</label>
                                        <select class="form-control" name="profesion" id="profesion">
                                            @foreach($profesiones as $key => $profesion)
                                                <option value="{{ $profesion->profesion }}"
                                                    @if($profesion->profesion == old('profesion', $funcionario->profesion)) selected @endif
                                                    >{{ $profesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('profesion') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Especialidad</label>
                                        <select class="form-control" name="especialidad" id="especialidad">
                                            @foreach($especialidades as $key => $especialidad)
                                                <option value="{{ $especialidad->especialidad }}"
                                                    @if($especialidad->especialidad == old('especialidad', $funcionario->especialidad)) selected @endif
                                                    >{{ $especialidad->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('especialidad') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('funcionario.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

