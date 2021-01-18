@extends('layouts.app')

@section('title', 'Pacientes')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('paciente.index') }}">Pacientes</a></li>
    <li class="breadcrumb-item active">Editar Paciente</a></li>
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
                                <h3 class="card-title">Editar Paciente</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('paciente.update', $paciente->paciente) }}">
                            @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo Documento</label>
                                                <select class="form-control" name="tipo_documento" id="tipo_documento">
                                                    @foreach($tipos_documentos as $key => $tipo_documento)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('tipo_documento', $paciente->tipo_documento)) selected @endif
                                                            >{{ $tipo_documento }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('tipo_documento') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="numero_documento">Numero Documento</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="numero_documento"
                                                    id="numero_documento"
                                                    value="{{ old('numero_documento', $paciente->numero_documento) }}"
                                                    placeholder="Introduzca numero documento del paciente">
                                                    @foreach ($errors->get('numero_documento') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="fecha_ingreso">Fecha Ingreso</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha_ingreso"
                                                    id="fecha_ingreso"
                                                    value="{{ old('fecha_ingreso', $paciente->fecha_ingreso->forForm()) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha_ingreso') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombres">Paciente</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombres"
                                            id="nombres"
                                            value="{{ old('nombres', $paciente->nombres) }}"
                                            placeholder="Introduzca nombre y apellido del paciente">
                                            @foreach ($errors->get('nombres') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Establecimiento</label>
                                        <select class="form-control" name="establecimiento" id="establecimiento">
                                            @foreach($establecimientos as $key => $establecimiento)
                                                <option value="{{ $establecimiento->establecimiento }}"
                                                    @if($establecimiento->establecimiento == old('establecimiento', $paciente->establecimiento)) selected @endif
                                                    >{{ $establecimiento->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('establecimiento') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha_nacimiento"
                                                    id="fecha_nacimiento"
                                                    value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento->forForm()) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha_nacimiento') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select class="form-control" name="sexo" id="sexo">
                                                        <option value="{{ $sexos['masculino']}}"
                                                        @if ($sexos['masculino'] == old('sexo', $paciente->sexo))
                                                            selected="selected"
                                                        @endif> Masculino</option>
                                                        <option value="{{ $sexos['femenino']}}"
                                                        @if($sexos['femenino'] == old('sexo', $paciente->sexo))
                                                            selected="selected"
                                                        @endif> Femenino</option>
                                                </select>
                                                @foreach ($errors->get('sexo') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nacionalidad</label>
                                                <select class="form-control" name="nacionalidad" id="nacionalidad">
                                                    @foreach($nacionalidades as $key => $nacionalidad)
                                                        <option value="{{ $nacionalidad->nacionalidad }}"
                                                            @if($nacionalidad->nacionalidad == old('nacionalidad', $paciente->nacionalidad)) selected @endif
                                                            >{{ $nacionalidad->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('nacionalidad') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo Lugar</label>
                                                <select class="form-control" name="tipo_lugar" id="tipo_lugar">
                                                    @foreach($tipos_lugares as $key => $tipo_lugar)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('tipo_lugar', $paciente->tipo_lugar)) selected @endif
                                                            >{{ $tipo_lugar }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('tipo_lugar') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="lugar_nacimiento">Lugar Nacimiento</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="lugar_nacimiento"
                                                    id="lugar_nacimiento"
                                                    value="{{ old('lugar_nacimiento', $paciente->lugar_nacimiento) }}"
                                                    placeholder="Introduzca lugar nacimiento del paciente">
                                                    @foreach ($errors->get('lugar_nacimiento') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estado Civil</label>
                                                <select class="form-control" name="estado_civil" id="estado_civil">
                                                    @foreach($estados_civiles as $key => $estado_civil)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('estado_civil', $paciente->estado_civil)) selected @endif
                                                            >{{ $estado_civil }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('estado_civil') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Seguro</label>
                                        <select class="form-control" name="seguro" id="seguro">
                                            @foreach($seguros as $key => $seguro)
                                                <option value="{{ $seguro->seguro }}"
                                                    @if($seguro->seguro == old('seguro', $paciente->seguro)) selected @endif
                                                    >{{ $seguro->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('seguro') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label>Profesion</label>
                                        <select class="form-control" name="profesion" id="profesion">
                                            @foreach($profesiones as $key => $profesion)
                                                <option value="{{ $profesion->profesion }}"
                                                    @if($profesion->profesion == old('profesion', $paciente->profesion)) selected @endif
                                                    >{{ $profesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('profesion') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label>Nivel Educativo</label>
                                        <select class="form-control" name="nivel_educativo" id="nivel_educativo">
                                            @foreach($niveles as $key => $nivel_educativo)
                                                <option value="{{ $nivel_educativo->nivel_educativo }}"
                                                    @if($nivel_educativo->nivel_educativo == old('nivel_educativo', $paciente->nivel_educativo)) selected @endif
                                                    >{{ $nivel_educativo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('nivel_educativo') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="ocupacion">Ocupacion</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="ocupacion"
                                                    id="ocupacion"
                                                    value="{{ old('ocupacion', $paciente->ocupacion) }}"
                                                    placeholder="Introduzca ocupacion del paciente">
                                                    @foreach ($errors->get('ocupacion') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="nombre_padre">Padre</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="nombre_padre"
                                                    id="nombre_padre"
                                                    value="{{ old('nombre_padre', $paciente->nombre_padre) }}"
                                                    placeholder="Introduzca padre del paciente">
                                                    @foreach ($errors->get('nombre_padre') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="nombre_madre">Madre</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="nombre_madre"
                                                    id="nombre_madre"
                                                    value="{{ old('nombre_madre', $paciente->nombre_madre) }}"
                                                    placeholder="Introduzca madre del paciente">
                                                    @foreach ($errors->get('nombre_madre') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Etnia</label>
                                                <select class="form-control" name="etnia" id="etnia">
                                                    @foreach($etnias as $key => $etnia)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('etnia', $paciente->etnia)) selected @endif
                                                            >{{ $etnia }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('etnia') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="nombre_etnia">Nombre Etnia</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="nombre_etnia"
                                                    id="nombre_etnia"
                                                    value="{{ old('nombre_etnia', $paciente->nombre_etnia) }}"
                                                    placeholder="Introduzca nombre etnia del paciente">
                                                    @foreach ($errors->get('nombre_etnia') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Situacion Laboral</label>
                                                <select class="form-control" name="situacion_laboral" id="situacion_laboral">
                                                    @foreach($situaciones_laborales as $key => $situacion_laboral)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('situacion_laboral', $paciente->situacion_laboral)) selected @endif
                                                            >{{ $situacion_laboral }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('situacion_laboral') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Area</label>
                                                <select class="form-control" name="area" id="area">
                                                    @foreach($areas as $key => $area)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('area', $paciente->area)) selected @endif
                                                            >{{ $area }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('area') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="lugar_nacimiento">Sector</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="sector"
                                                    id="sector"
                                                    value="{{ old('sector', $paciente->sector) }}"
                                                    placeholder="Introduzca sector del paciente">
                                                    @foreach ($errors->get('sector') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="lugar_nacimiento">Manzana</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="manzana"
                                                    id="manzana"
                                                    value="{{ old('manzana', $paciente->manzana) }}"
                                                    placeholder="Introduzca manzana del paciente">
                                                    @foreach ($errors->get('manzana') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
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
                                            value="{{ old('direccion', $paciente->direccion) }}"
                                            placeholder="Introduzca direccion del paciente">
                                            @foreach ($errors->get('direccion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Barrio</label>
                                        <select class="form-control" name="barrio" id="barrio">
                                            @foreach($barrios as $key => $barrio)
                                                <option value="{{ $barrio->barrio }}"
                                                    @if($barrio->barrio == old('barrio', $paciente->barrio)) selected @endif
                                                    >{{ $barrio->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('barrio') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="nro_casa">Numero de Casa</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="nro_casa"
                                                    id="nro_casa"
                                                    value="{{ old('nro_casa', $paciente->nro_casa) }}"
                                                    placeholder="Introduzca numero de casa del paciente">
                                                    @foreach ($errors->get('nro_casa') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="referencia">Referencia</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="referencia"
                                                    id="referencia"
                                                    value="{{ old('referencia', $paciente->referencia) }}"
                                                    placeholder="Introduzca referencia del paciente">
                                                    @foreach ($errors->get('referencia') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="telefono"
                                                    id="telefono"
                                                    value="{{ old('telefono', $paciente->telefono) }}"
                                                    placeholder="Introduzca telefono del paciente">
                                                    @foreach ($errors->get('telefono') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="correo_electronico">Correo Electronico</label>
                                        <input class="form-control"
                                            type="correo_electronico"
                                            name="correo_electronico"
                                            id="correo_electronico"
                                            value="{{ old('correo_electronico', $paciente->correo_electronico) }}"
                                            placeholder="Introduzca correo electronico del paciente">
                                            @foreach ($errors->get('correo_electronico') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('paciente.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

