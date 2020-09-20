@extends('layouts.app')

@section('title', 'Barrios')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('barrio.index') }}">Barrios</a></li>
    <li class="breadcrumb-item active">Editar Barrio</a></li>
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
                                <h3 class="card-title">Editar Barrio</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('barrio.update', $barrio->barrio) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Barrio</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ old('nombre', $barrio->nombre)  }}"
                                            placeholder="Introduzca nombre del barrio">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Distrito</label>
                                        <select class="form-control" name="distrito" id="distrito">
                                            @foreach($distritos as $key => $distrito)
                                                <option value="{{ $distrito->distrito }}"
                                                    @if ($barrio->distrito == old('distrito', $distrito->distrito))
                                                        selected="selected"
                                                    @endif
                                                    >{{ $distrito->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('barrio.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

