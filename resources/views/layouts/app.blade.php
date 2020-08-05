<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ env('APP_NAME') }}</title>

  {{-- <link rel="stylesheet" href="/css/app.css">
  <link href="{{ asset('css/toastr.css') }}" rel="stylesheet"> --}}
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
    @include('admin.alert')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link">
            <img src="{!! asset('img/logo32x32.png') !!}" alt="AdminLTE Logo" class="brand-image"
            style="opacity: .8">
        {{--  <img src="./img/logo.png" alt="AdminLTE Logo" class="brand-image"
            style="opacity: .8">  --}}
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
                <nav class="mt-2 user-panel">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            {{ Auth::user()->name }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Cerrar Sesión</p>
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </li>
                    </ul>
                </nav>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                    Administracion
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('perfil.index') }}" class="nav-link ">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Perfiles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('region.index') }}" class="nav-link ">
                    <i class="fas fa-city nav-icon"></i>
                    <p>Regiones Sanitarias</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('distrito.index') }}" class="nav-link ">
                    <i class="fas fa-city nav-icon"></i>
                    <p>Distritos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('barrio.index') }}" class="nav-link ">
                    <i class="fas fa-city nav-icon"></i>
                    <p>Barrios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nivel.index') }}" class="nav-link ">
                    <i class="fas fa-plus-square nav-icon"></i>
                    <p>Niveles de Atencion</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tipo.index') }}" class="nav-link ">
                    <i class="fas fa-h-square nav-icon"></i>
                    <p>Tipos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('red.index') }}" class="nav-link ">
                    <i class="fas fa-sitemap nav-icon"></i>
                    <p>Redes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('establecimiento.index') }}" class="nav-link ">
                    <i class="fas fa-clinic-medical nav-icon"></i>
                    <p>Establecimientos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('especialidad.index') }}" class="nav-link ">
                    <i class="fas fa-clinic-medical nav-icon"></i>
                    <p>Especialidades Médicas</p>
                    </a>
                </li>
                </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
              @yield('menu-header')
              {{--  <li class="breadcrumb-item active">@yield('title')</li>
              <li class="breadcrumb-item active">@yield('item')</li>  --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <main class="py-4">
            @yield('content')
        </main>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

{{-- <script src="/js/app.js"></script> --}}
@yield('scripts')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
     <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        });
    </script>
</body>
</html>
