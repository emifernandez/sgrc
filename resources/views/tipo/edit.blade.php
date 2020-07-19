@extends('layouts.app')

@section('title', 'Tipos')
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
                                            value="{{ $tipo->nombre }}"
                                            placeholder="Introduzca nombre del tipo">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Nivel</label>
                                        <select class="form-control" name="nivel" id="nivel">
                                            @foreach($niveles as $key => $nivel)
                                                <option value="{{ $nivel->nivel }}"
                                                    @if ($tipo->nivel == $nivel->nivel)
                                                        selected="selected"
                                                    @endif
                                                    >{{ $nivel->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
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

