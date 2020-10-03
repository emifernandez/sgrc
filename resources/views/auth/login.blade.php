@extends('layouts.header')
@section('content')
  <div class="hold-transition login-page">
    <div class="login-box">

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <div class="login-logo">
          <img src="./img/logo1.png" class="brand-image" style="opacity: .8">
        </div>

        <p class="login-box-msg">{{ env('APP_FULL_NAME') }}</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="text-center">
                @foreach ($errors->get('autenticacion') as $error)
                    <span class="text text-danger">{{ $error }}</span>
                @endforeach
            </div>
            <div class="input-group mb-3">
                <select class="form-control @error('establecimiento') is-invalid @enderror" name="establecimiento" id="establecimiento">
                        <option value="">Seleccione un Establecimiento</option>
                    @foreach($establecimientos as $key => $establecimiento)
                        <option value="{{ $establecimiento->establecimiento }}"
                            @if($establecimiento->establecimiento == old('establecimiento')) selected @endif
                            >{{ $establecimiento->nombre }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-building"></span>
                    </div>
                  </div>
                  @error('establecimiento')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
          <div class="input-group mb-3">
              <input
                id="usuario"
                type="usuario"
                class="form-control @error('usuario') is-invalid @enderror"
                name="usuario"
                value="{{ old('usuario') }}"
                autocomplete="usuario"
                autofocus
                placeholder="Usuario">
              <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
              </div>

              @error('usuario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="input-group mb-3">
            <input id="clave"
              type="password"
              class="form-control @error('clave') is-invalid @enderror"
              name="clave"
              autocomplete="current-password"
              placeholder="Contraseña">
              <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
              @error('clave')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror


          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Ingresar</button>
          <!-- /.col -->
          </div>
        </form>


      </div>
      <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->

  </div>
@endsection

