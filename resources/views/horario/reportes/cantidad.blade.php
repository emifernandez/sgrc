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
    <input type="hidden" id="establecimiento_data" value="{{ $establecimiento }}">
    <input type="hidden" id="atenciones_data" value="{{ $atenciones }}">
    <input type="hidden" id="referencias_data" value="{{ $referencias }}">
    <input type="hidden" id="contrareferencias_data" value="{{ $contrareferencias }}">
    @foreach($establecimientos->groupBy('red') as $key => $red)
    <div class="row">
      <div class="col-12 table-responsive">
        <div class="card-header">
            <h3 class="card-title">Red: {{mb_convert_case($key, MB_CASE_TITLE, "UTF-8")}}</h3>
        </div>
        <table class="table table-striped">
          <thead>
          <tr>
            <th style="width: 30%">Red</th>
            <th style="width: 0%">Establecimiento</th>
            <th style="width: 10%">Atenciones</th>
            <th style="width: 10%">Referencias</th>
            <th style="width: 10%">Contrareferencias</th>
          </tr>
          </thead>
          <tbody>
            @foreach($red as $i => $establecimiento)
            <tr>
                <td>{{ $establecimiento->red }}</td>
                <td id="establecimiento">{{ $establecimiento->establecimiento }}</td>
                <td id="atenciones">{{ $establecimiento->atenciones }}</td>
                <td id="referencias">{{ $establecimiento->referencias }}</td>
                <td id="contrareferencias">{{ $establecimiento->contrareferencias }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endforeach
        <div class="container">
          <div class="row">
              <div class="col-md-10 offset-md-1">
                  <div class="panel panel-default">
                      <div class="panel-body">
                          <canvas id="canvas" height="280" width="600"></canvas>
                      </div>
                  </div>
              </div>
          </div>
        </div>
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
      var establecimiento = JSON.parse(document.getElementById('establecimiento_data').value);
      var atenciones = JSON.parse(document.getElementById('atenciones_data').value);
      var referencias = JSON.parse(document.getElementById('referencias_data').value);
      var contrareferencias = JSON.parse(document.getElementById('contrareferencias_data').value);
      var color = Chart.helpers.color;
      var barChartData = {
          labels: establecimiento,
          datasets: [{
              label: 'Atenciones',
              backgroundColor: "pink",
              borderWidth: 1,
              data: atenciones
          },
          {
            label: 'Referencias',
              backgroundColor: "aliceblue",
              borderWidth: 1,
              data: referencias
          },
          {
            label: 'Contrareferencias',
              backgroundColor: "lemonchiffon",
              borderWidth: 1,
              data: contrareferencias
          }]
      };
  
      window.onload = function() {
          var ctx = document.getElementById("canvas").getContext("2d");
          window.myBar = new Chart(ctx, {
              type: 'bar',
              data: barChartData,
              options: {
                  elements: {
                      rectangle: {
                          borderWidth: 2,
                          borderColor: '#c1c1c1',
                          borderSkipped: 'bottom'
                      }
                  },
                  responsive: true,
                  title: {
                      display: true,
                      text: 'Gráfico de Barras'
                  }
              }
          });
          $('.print').print({
                addGlobalStyles : true,
                rejectWindow : true,
                noPrintSelector : ".no-print",
                iframe : true,
                append : null,
                prepend : null
            });
      };
  </script>
    
@endsection