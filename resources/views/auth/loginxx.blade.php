@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">
                            @foreach ($errors->get('autenticacion') as $error)
                                <span class="text text-danger">{{ $error }}</span>
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <label for="establecimiento" class="col-md-4 col-form-label text-md-right">Establecimiento</label>
                            <div class="col-md-6">
                                <select class="form-control @error('establecimiento') is-invalid @enderror" name="establecimiento" id="establecimiento">
                                        <option value="">Seleccione un Establecimiento</option>
                                    @foreach($establecimientos as $key => $establecimiento)
                                        <option value="{{ $establecimiento->establecimiento }}"
                                            @if($establecimiento->establecimiento == old('establecimiento')) selected @endif
                                            >{{ $establecimiento->nombre }}</option>
                                    @endforeach
                                </select>
                                @foreach ($errors->get('establecimiento') as $error)
                                    <span class="text text-danger">{{ $error }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="usuario" type="usuario" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" autocomplete="usuario" autofocus>

                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clave" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="clave" type="password" class="form-control @error('clave') is-invalid @enderror" name="clave" autocomplete="current-password">

                                @error('clave')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
