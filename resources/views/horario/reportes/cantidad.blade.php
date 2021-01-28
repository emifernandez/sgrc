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
            Informe de Cantidad de Atención
          </h3>
        </div>
      </div>
    @foreach($establecimientos->groupBy('red') as $key => $red)
    <div class="row">
      <div class="col-12 table-responsive">
        <div class="card-header">
            <h3 class="card-title">Red: {{mb_convert_case($key, MB_CASE_TITLE, "UTF-8")}}</h3>
        </div>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Red</th>
            <th>Establecimiento</th>
            <th>Atenciones</th>
            <th>Referencias</th>
            <th>Contrareferencias</th>
          </tr>
          </thead>
          <tbody>
            @foreach($red as $i => $establecimiento)
            <tr>
                <td>{{ $establecimiento->red }}</td>
                <td>{{ $establecimiento->establecimiento }}</td>
                <td>{{ $establecimiento->atenciones }}</td>
                <td>{{ $establecimiento->referencias }}</td>
                <td>{{ $establecimiento->contrareferencias }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{-- <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">{{mb_convert_case($key, MB_CASE_TITLE, "UTF-8")}}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div> --}}
        @endforeach
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