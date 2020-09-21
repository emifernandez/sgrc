@extends('layouts.app')

@section('title', 'Permisos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('permiso.index') }}">Permisos</a></li>
    <li class="breadcrumb-item active">Editar Permiso</a></li>
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
                                <h3 class="card-title">Editar Permiso</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('permiso.update', $permiso->permiso) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Perfil</label>
                                        <select class="form-control" name="perfil" id="perfil">
                                                <option value="">Seleccione un perfil</option>
                                                @foreach($perfiles as $key => $perfil)
                                                <option value="{{ $perfil->perfil }}"
                                                    @if($perfil->perfil == old('perfil', $permiso->perfil)) selected @endif
                                                    >{{ $perfil->nombre }}</option>
                                                @endforeach
                                        </select>
                                        @foreach ($errors->get('perfil') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('permiso.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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

