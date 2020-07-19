@extends('layouts.header')
@section('content')
  <div class="hold-transition login-page">
    <div class="login-box">

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <div class="login-logo">
          <img src="./img/logo64x64.png" class="brand-image" style="opacity: .8">
        </div>

        <p class="login-box-msg">{{ env('APP_FULL_NAME') }}</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="input-group mb-3">
              <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                autofocus
                placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
              </div>

              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="input-group mb-3">
            <input id="password"
              type="password"
              class="form-control @error('password') is-invalid @enderror"
              name="password"
              required
              autocomplete="current-password"
              placeholder="Password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Ingresar</button>
            <p class="mb-1 text-center">
                @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                      Olvidé mi contraseña
                  </a>
                @endif
              </p>
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

