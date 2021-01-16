@extends('layouts.app')

@section('title', 'Establecimientos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('establecimiento.index') }}">Establecimientos</a></li>
    <li class="breadcrumb-item active">Editar Establecimiento</a></li>
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
                                <h3 class="card-title">Editar Establecimiento</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('establecimiento.update', $establecimiento->establecimiento) }}">
                                @method('PATCH')
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
                                                    readonly
                                                    value="{{ old('codigo', $establecimiento->codigo) }}"
                                                    placeholder="Introduzca codigo del establecimiento">
                                                    @foreach ($errors->get('codigo') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Orden</label>
                                                <select class="form-control" name="orden" id="orden">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($i == old('orden', $establecimiento->orden))
                                                            selected="selected"
                                                        @endif
                                                    >{{ $i}}</option>
                                                    @endfor
                                                </select>
                                                @foreach ($errors->get('orden') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado">
                                                        <option value="{{ $estados['Activo']}}"
                                                        @if ($estados['Activo'] == old('estado', $establecimiento->estado))
                                                            selected="selected"
                                                        @endif> Activo</option>
                                                        <option value="{{ $estados['Inactivo']}}"
                                                        @if ($estados['Inactivo'] == old('estado', $establecimiento->estado))
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
                                        <label for="nombre">Establecimiento</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $establecimiento->nombre) }}"
                                            placeholder="Introduzca nombre del establecimiento">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Establecimiento Encargado</label>
                                        <select class="form-control" name="establecimiento_encargado" id="establecimiento_encargado">
                                            <option value="null">Sin Encargado</option>
                                            @foreach($establecimientos as $key => $item)
                                                <option value="{{ $item->establecimiento }}"
                                                    @if ($item->establecimiento == old('establecimiento_encargado', $establecimiento->establecimiento_encargado))
                                                        selected="selected"
                                                    @endif>{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" name="tipo" id="tipo">
                                            @foreach($tipos as $key => $tipo)
                                                <option value="{{ $tipo->tipo }}"
                                                @if ($tipo->tipo == old('tipo', $establecimiento->tipo))
                                                    selected="selected"
                                                @endif>{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('tipo') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Red</label>
                                        <select class="form-control" name="red" id="red">
                                            @foreach($redes as $key => $red)
                                                <option value="{{ $red->red }}"
                                                @if ($red->red == old('red', $establecimiento->red))
                                                    selected="selected"
                                                @endif>{{ $red->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('red') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
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
                                                    value="{{ old('telefono1', $establecimiento->telefono1) }}"
                                                    placeholder="Introduzca telefono del establecimiento">
                                                    @foreach ($errors->get('telefono1') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
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
                                                    value="{{ old('telefono2', $establecimiento->telefono2) }}"
                                                    placeholder="Introduzca telefono secundario del establecimiento">
                                                    @foreach ($errors->get('telefono2') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
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
                                            value="{{ old('email', $establecimiento->email) }}"
                                            placeholder="Introduzca email del establecimiento">
                                            @foreach ($errors->get('email') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Barrio</label>
                                        <select class="form-control" name="barrio" id="barrio">
                                            @foreach($barrios as $key => $barrio)
                                                <option value="{{ $barrio }}"
                                                @if ($barrio->barrio == old('barrio', $establecimiento->barrio->barrio))
                                                selected="selected"
                                                @endif>{{ $barrio->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('barrio') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Distrito</label>
                                        <select class="form-control" name="distrito" id="distrito" readonly>
                                        <option value="{{ $establecimiento->barrio->distrito->distrito }}">
                                        {{ $establecimiento->barrio->distrito->nombre }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Region Sanitaria</label>
                                        <select class="form-control" name="region" id="region" readonly>
                                        <option value="{{ $establecimiento->barrio->distrito->region->region }}">
                                        {{ $establecimiento->barrio->distrito->region->nombre }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacion">Ubicacion</label>
                                        <input class="form-control"
                                            type="text"
                                            name="ubicacion"
                                            id="ubicacion"
                                            value="{{ old('ubicacion', $establecimiento->ubicacion) }}"
                                            placeholder="Introduzca ubicacion del establecimiento">
                                            @foreach ($errors->get('ubicacion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input readonly type="hidden"
                                                    id="latitud"
                                                    name="latitud"
                                                    value="{{ old('latitud', $establecimiento->latitud) }}"
                                                    class="form-control"
                                                    placeholder="Latitud">
                                            </div>
                                            <div class="col-sm-6">
                                                <input readonly type="hidden"
                                                    id="longitud"
                                                    name="longitud"
                                                    value="{{ old('longitud', $establecimiento->longitud) }}"
                                                    class="form-control"
                                                    placeholder="Longitud">
                                            </div>
                                            </div>
                                        <div id="map" style="width:100%;height:400px; margin-top: 2%">
                                            <div style="width: 100%; height: 100%" id="address-map"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('establecimiento.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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
	<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"
	async defer></script>
    <script type="text/javascript">
    $(function(){
        
        $("#barrio").change(function(){
            var value = $(this).val();
            if(value) {
                let barrio = JSON.parse(value);
                 distrito = document.getElementById('distrito');
                 region = document.getElementById('region');
                 distrito.remove(0);
                 region.remove(0);
                distrito.options[distrito.options.length] = new Option(barrio.distrito.nombre, barrio.distrito.distrito);
                region.options[region.options.length] = new Option(barrio.distrito.region.nombre, barrio.distrito.region.distrito);

            }
        });

    });
    </script>
@stop

