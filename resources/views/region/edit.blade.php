@extends('layouts.app')

@section('title', 'Regiones Sanitarias')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('region.index') }}">Regiones Sanitarias</a></li>
    <li class="breadcrumb-item active">Editar Region Sanitaria</a></li>
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
                                <h3 class="card-title">Editar Region Sanitaria</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('region.update', $region->region) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Region</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $region->nombre) }}"
                                            placeholder="Introduzca nombre de la Region Sanitaria">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('region.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

