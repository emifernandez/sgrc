@extends('layouts.app')

@section('title', 'Distritos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('distrito.index') }}">Distritos</a></li>
    <li class="breadcrumb-item active">Editar Distrito</a></li>
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
                                <h3 class="card-title">Editar Distrito</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('distrito.update', $distrito->distrito) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Distrito</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $distrito->nombre) }}"
                                            placeholder="Introduzca nombre del ditrito">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select class="form-control" name="region" id="region">
                                            @foreach($regiones as $key => $region)
                                                <option value="{{ $region->region }}"
                                                    @if ($distrito->region == old('region', $region->region))
                                                        selected="selected"
                                                    @endif
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

