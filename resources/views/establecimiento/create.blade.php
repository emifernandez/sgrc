@extends('layouts.app')

@section('title', 'Establecimientos')
@section('content')
<div class="row">
	<div class="col-lg-12">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Crear Establecimiento</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('establecimiento.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="codigo">Codigo</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="codigo"
                                                    id="codigo"
                                                    placeholder="Introduzca codigo del establecimiento">
                                                    @foreach ($errors->get('codigo') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Orden</label>
                                                <select class="form-control" name="orden" id="orden">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i}}</option>
                                                    @endfor
                                                </select>
                                                @foreach ($errors->get('orden') as $error)
                                                    <span class="text alert-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado" disabled>
                                                        <option value="{{ $estados['Activo']}}" selected> Activo</option>
                                                        <option value="{{ $estados['Inactivo']}}"> Inactivo</option>
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text alert-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Establecimiento</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            placeholder="Introduzca nombre del establecimiento">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Establecimiento Encargado</label>
                                        <select class="form-control" name="establecimiento_encargado" id="establecimiento_encargado">
                                            <option value="null">Sin Encargado</option>
                                            @foreach($establecimientos as $key => $establecimiento)
                                                <option value="{{ $establecimiento->establecimiento }}">{{ $establecimiento->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" name="tipo" id="tipo">
                                            @foreach($tipos as $key => $tipo)
                                                <option value="{{ $tipo->tipo }}">{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('tipo') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Red</label>
                                        <select class="form-control" name="red" id="red">
                                            @foreach($redes as $key => $red)
                                                <option value="{{ $red->red }}">{{ $red->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('red') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="telefono1">Telefono Principal</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="telefono1"
                                                    id="telefono1"
                                                    placeholder="Introduzca telefono del establecimiento">
                                                    @foreach ($errors->get('telefono1') as $error)
                                                        <span class="text alert-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="telefono1">Telefono Secundario</label>
                                                <input class="form-control"
                                                    type="text"
                                                    name="telefono2"
                                                    id="telefono2"
                                                    placeholder="Introduzca telefono secundario del establecimiento">
                                                    @foreach ($errors->get('telefono2') as $error)
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
                                            placeholder="Introduzca email del establecimiento">
                                            @foreach ($errors->get('email') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Barrio</label>
                                        <select class="form-control" name="barrio" id="barrio">
                                            @foreach($barrios as $key => $barrio)
                                                <option value="{{ $barrio->barrio }}">{{ $barrio->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('barrio') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacion">Ubicacion</label>
                                        <input class="form-control"
                                            type="text"
                                            name="ubicacion"
                                            id="ubicacion"
                                            placeholder="Introduzca ubicacion del establecimiento">
                                            @foreach ($errors->get('ubicacion') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input readonly type="text" id="latitud" name="latitud" class="form-control" placeholder="Latitud">
                                            </div>
                                            <div class="col-sm-6">
                                                <input readonly type="text" id="longitud" name="longitud" class="form-control" placeholder="Longitud">
                                            </div>
                                            </div>
                                        <div id="map" style="width:100%;height:400px; margin-top: 2%">
                                            <div style="width: 100%; height: 100%" id="address-map"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
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
    @parent
    <script src="{!! asset('js/geolocation.js') !!}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=getLocation"
	async defer></script>
@stop

