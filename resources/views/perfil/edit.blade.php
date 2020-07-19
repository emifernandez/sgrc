@extends('layouts.app')

@section('title', 'Perfiles')
@section('content')
<div class="row">
	<div class="col-lg-12">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Editar Perfil</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('perfil.update', $perfil->perfil) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombre">Perfil</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nombre"
                                            id="nombre"
                                            value="{{ $perfil->nombre }}"
                                            placeholder="Introduzca nombre del perfil">
                                        @foreach ($errors->get('nombre') as $error)
                                            <span class="text alert-danger">{{ $error }}</span>
                                        @endforeach
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

