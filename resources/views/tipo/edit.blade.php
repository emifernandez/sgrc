@extends('layouts.app')

@section('title', 'Tipos de Establecimiento')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('tipo.index') }}">Tipos de Establecimiento</a></li>
    <li class="breadcrumb-item active">Editar Tipo</a></li>
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
                                <h3 class="card-title">Editar Tipo</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('tipo.update', $tipo->tipo) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Tipo</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre',$tipo->nombre) }}"
                                            placeholder="Introduzca nombre del tipo">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Nivel</label>
                                        <select class="form-control" name="nivel" id="nivel">
                                            @foreach($niveles as $key => $nivel)
                                                <option value="{{ $nivel->nivel }}"
                                                    @if ($tipo->nivel == old('nivel',$nivel->nivel))
                                                        selected="selected"
                                                    @endif
                                                    >{{ $nivel->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('tipo.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

