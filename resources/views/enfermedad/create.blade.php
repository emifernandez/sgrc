@extends('layouts.app')

@section('title', 'Enfermedades')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('enfermedad.index') }}">Enfermedades</a></li>
    <li class="breadcrumb-item active">Crear Enfermedad</a></li>
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
                                <h3 class="card-title">Crear Enfermedad</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('enfermedad.store') }}">
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
                                                    value="{{ old('codigo') }}"
                                                    placeholder="Introduzca codigo de la enfermedad">
                                                    @foreach ($errors->get('codigo') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Enfermedad</label>
                                        <input class="form-control"
                                            type="text"
                                            name="descripcion"
                                            id="descripcion"
                                            value="{{ old('descripcion') }}"
                                            placeholder="Introduzca descripcion de la enfermedad">
                                            @foreach ($errors->get('descripcion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('enfermedad.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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