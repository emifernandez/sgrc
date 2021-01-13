@extends('layouts.app')

@section('title', 'Seguros')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('seguro.index') }}">Seguros</a></li>
    <li class="breadcrumb-item active">Editar Seguro</a></li>
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
                                <h3 class="card-title">Editar Seguro</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('seguro.update', $seguro->seguro) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Seguro</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $seguro->nombre) }}"
                                            placeholder="Introduzca nombre del Seguro">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('seguro.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

