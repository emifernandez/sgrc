@extends('layouts.app')
@section('title', 'Permisos Insuficientes')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-warning"> 403</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Ups! Página no disponible.</h3>

        <p>
            <h5> No posee los permisos suficientes para acceder a esta página.</h5>
          Póngase en contacto con el administrador para obtener más información.
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
@endsection
