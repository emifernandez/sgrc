@extends('layouts.app')

@section('title', 'Nacionalidades')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('nacionalidad.index') }}">Nacionalidades</a></li>
    <li class="breadcrumb-item active">Editar Nacionalidad</a></li>
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
                                <h3 class="card-title">Editar Nacionalidad</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('nacionalidad.update', $nacionalidad->nacionalidad) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Nacionalidad</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $nacionalidad->nombre) }}"
                                            placeholder="Introduzca nombre de la Nacionalidad">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('nacionalidad.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

