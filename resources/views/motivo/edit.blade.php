@extends('layouts.app')

@section('title', 'Motivos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('motivo.index') }}">Motivos</a></li>
    <li class="breadcrumb-item active">Editar Motivo</a></li>
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
                                <h3 class="card-title">Editar Motivo</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('motivo.update', $motivo->motivo) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="descripcion">Motivo</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="descripcion"
                                            id="descripcion"
                                            value="{{ old('descripcion', $motivo->descripcion) }}"
                                            placeholder="Introduzca descripcion del Motivo">
                                        @foreach ($errors->get('descripcion') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('motivo.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

