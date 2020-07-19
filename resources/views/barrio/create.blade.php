@extends('layouts.app')

@section('title', 'Barrios')
@section('content')
<div class="row">
	<div class="col-lg-12">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Crear Barrio</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('barrio.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Barrios</label>
                                        <input class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            placeholder="Introduzca nombre del barrio">
                                            @foreach ($errors->get('nombre') as $error)
                                                <span class="text alert-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Distrito</label>
                                        <select class="form-control" name="distrito" id="distrito">
                                            @foreach($distritos as $key => $distrito)
                                                <option value="{{ $distrito->distrito }}">{{ $distrito->nombre }}</option>
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

