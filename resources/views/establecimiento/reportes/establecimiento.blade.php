@extends('layouts.header')
@section('content')
<div class="wrapper">
  <section class="invoice">
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> {{ $establecimiento_usuario->nombre }}
        </h2>
      </div>
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>{{$establecimiento_usuario->ubicacion}}</strong><br>
          {{$establecimiento_usuario->barrio->distrito->nombre}}<br>
          Teléfono: {{$establecimiento_usuario->telefono1 . ' - ' . $establecimiento_usuario->telefono2}}<br>
          Email: {{$establecimiento_usuario->email}}<br>
          Fecha: {{ $todayDate = date("d/m/Y H:i:s")}}
        </address>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
          <h3 class="text-center">
            Informe de Establecimientos
          </h3>
        </div>
      </div>

    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Región</th>
            <th>Distrito</th>
            <th>Tipo</th>
            <th>Nivel</th>
            <th>Establecimiento Encargado</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Ubicación</th>
            <th>Estado</th>
          </tr>
          </thead>
          <tbody>
            @foreach($establecimientos as $key => $establecimiento)
            <tr>
                <td>{{ $establecimiento->codigo }}</td>
                <td>{{ $establecimiento->nombre }}</td>
                <td>{{ $establecimiento->region }}</td>
                <td>{{ $establecimiento->distrito }}</td>
                <td>{{ $establecimiento->barrio }}</td>
                <td>{{ $establecimiento->tipo }}</td>
                @if(isset($establecimiento->establecimiento_encargado))
                <td>{{ $establecimiento->establecimiento_encargado->nombre }}</td>
                @else
                <td> Sin Encargado</td>
                @endif
                <td>{{ $establecimiento->email }}</td>
                <td>{{ $establecimiento->telefono1 . ' - ' . $establecimiento->telefono2 }}</td>
                <td>{{ $establecimiento->ubicacion }}</td>
                <td>{{ $establecimiento->estado }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <hr>
        <div class="text-center">
            Fin del informe
        </div>

      </div>
    </div>
  </section>
</div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript"> 
        $(document).ready(function() {
            $('.print').print({
                addGlobalStyles : true,
                rejectWindow : true,
                noPrintSelector : ".no-print",
                iframe : true,
                append : null,
                prepend : null
            });
        })
    </script>
@endsection