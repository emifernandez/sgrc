@php
use App\Permiso;
use App\Usuario;
    $usuario = Usuario::findOrFail(Auth::user()->usuario);
    $permisos = Permiso::where('perfil', $usuario->perfil)->get();
    $accesos = collect([]);
    if($permisos->count() > 0) {
        foreach ($permisos[0]->accesos as $acceso) {
            $accesos->push($acceso);
        }
    }  
@endphp
<!DOCTYPE html>
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
            <img src="{!! asset('img/logo32x32.png') !!}" alt="SGRC Logo" class="brand-image"
            style="opacity: .8">
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
                            {{ Auth::user()->usuario }}
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
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Datos Básicos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Nacionalidades')->first() && $accesos->where('nombre', 'Nacionalidades')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Nacionalidades')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Nacionalidades')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Cargos')->first() && $accesos->where('nombre', 'Cargos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Cargos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Cargos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Profesiones')->first() && $accesos->where('nombre', 'Profesiones')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Profesiones')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Profesiones')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Funcionarios')->first() && $accesos->where('nombre', 'Funcionarios')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Funcionarios')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Funcionarios')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Niveles de Atención')->first() && $accesos->where('nombre', 'Niveles de Atención')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Niveles de Atención')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Niveles de Atención')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Tipos de Establecimiento')->first() && $accesos->where('nombre', 'Tipos de Establecimiento')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Tipos de Establecimiento')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-h-square nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Tipos de Establecimiento')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Especialidades Médicas')->first() && $accesos->where('nombre', 'Especialidades Médicas')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Especialidades Médicas')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Especialidades Médicas')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-map-marked-alt"></i>
                    <p>
                        Ubicaciones
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Regiones')->first() && $accesos->where('nombre', 'Regiones')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Regiones')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-city nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Regiones')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Distritos')->first() && $accesos->where('nombre', 'Distritos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Distritos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-city nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Distritos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Barrios')->first() && $accesos->where('nombre', 'Barrios')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Barrios')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-city nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Barrios')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Establecimientos')->first() && $accesos->where('nombre', 'Establecimientos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Establecimientos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clinic-medical nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Establecimientos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Redes')->first() && $accesos->where('nombre', 'Redes')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Redes')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-sitemap nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Redes')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>
                        Usuarios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Usuarios')->first() && $accesos->where('nombre', 'Usuarios')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Usuarios')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-user nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Usuarios')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Usuarios Establecimientos')->first() && $accesos->where('nombre', 'Usuarios Establecimientos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Usuarios Establecimientos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-user-tag nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Usuarios Establecimientos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Perfiles de Usuarios')->first() && $accesos->where('nombre', 'Perfiles de Usuarios')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Perfiles de Usuarios')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-users nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Perfiles de Usuarios')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Permisos de Usuarios')->first() && $accesos->where('nombre', 'Permisos de Usuarios')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Permisos de Usuarios')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Permisos de Usuarios')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>
                        Admisión
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Servicios Médicos')->first() && $accesos->where('nombre', 'Servicios Médicos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Servicios Médicos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-medkit nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Servicios Médicos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Horarios de Atención')->first() && $accesos->where('nombre', 'Horarios de Atención')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Horarios de Atención')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-clock nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Horarios de Atención')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Niveles Educativos')->first() && $accesos->where('nombre', 'Niveles Educativos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Niveles Educativos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-graduation-cap nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Niveles Educativos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Seguros')->first() && $accesos->where('nombre', 'Seguros')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Seguros')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-calendar-plus nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Seguros')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Pacientes')->first() && $accesos->where('nombre', 'Pacientes')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Pacientes')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-wheelchair nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Pacientes')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Admisiones')->first() && $accesos->where('nombre', 'Admisiones')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Admisiones')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-calendar-check nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Admisiones')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder-open"></i>
                    <p>
                        Consultas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Motivo de Consulta')->first() && $accesos->where('nombre', 'Motivo de Consulta')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Motivo de Consulta')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Motivo de Consulta')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Enfermedades')->first() && $accesos->where('nombre', 'Enfermedades')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Enfermedades')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Enfermedades')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Atenciones Médicas')->first() && $accesos->where('nombre', 'Atenciones Médicas')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Atenciones Médicas')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-folder-plus nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Atenciones Médicas')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-people-arrows"></i>
                    <p>
                        Derivaciones
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Referencias')->first() && $accesos->where('nombre', 'Referencias')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Referencias')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-arrow-circle-down nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Referencias')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Contrareferencias')->first() && $accesos->where('nombre', 'Contrareferencias')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Contrareferencias')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-arrow-circle-up nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Contrareferencias')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Reportes
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if($accesos->where('nombre', 'Informe de Establecimientos')->first() && $accesos->where('nombre', 'Informe de Establecimientos')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Informe de Establecimientos')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Informe de Establecimientos')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Informe de Horarios de Atención')->first() && $accesos->where('nombre', 'Informe de Horarios de Atención')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Informe de Horarios de Atención')->first()->url) }}" class="nav-link ">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Informe de Horarios de Atención')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Informe de Derivaciones')->first() && $accesos->where('nombre', 'Informe de Derivaciones')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Informe de Derivaciones')->first()->url) }}" class="nav-link ">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Informe de Derivaciones')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Informe de Capacidad de Atención')->first() && $accesos->where('nombre', 'Informe de Capacidad de Atención')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Informe de Capacidad de Atención')->first()->url) }}" class="nav-link ">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Informe de Capacidad de Atención')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                        @if($accesos->where('nombre', 'Informe de Cantidades de Atención')->first() && $accesos->where('nombre', 'Informe de Cantidades de Atención')->first()->detalle->habilitado == '1')
                            <li class="nav-item">
                                <a href="{{ route($accesos->where('nombre', 'Informe de Cantidades de Atención')->first()->url) }}" class="nav-link ">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>{{ $accesos->where('nombre', 'Informe de Cantidades de Atención')->first()->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper home">
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

            $('.datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
            $('.datetimemask').inputmask('dd-mm-yyyy H:i:s', { 'placeholder': 'dd-mm-yyyy 00:00:00' })
            $(".time").inputmask("H:s",{ "placeholder": "00:00" });
        });
    </script>
</body>
</html>
