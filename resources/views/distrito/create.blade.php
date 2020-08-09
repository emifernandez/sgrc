@extends('layouts.app')

@section('title', 'Distritos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('distrito.index') }}">Distritos</a></li>
    <li class="breadcrumb-item active">Crear Distrito</a></li>
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
                                <h3 class="card-title">Crear Distrito</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('distrito.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Distrito</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre') }}"
                                            placeholder="Introduzca nombre del Distrito">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select class="form-control" name="region" id="region">
                                            @foreach($regiones as $key => $region)
                                                <option value="{{ $region->region }}"
                                                    {{ old('region') == $region->region ? 'selected' : '' }}
                                                >{{ $region->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('distrito.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

