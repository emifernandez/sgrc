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
            Informe de Capacidad de Atención
          </h3>
        </div>
      </div>
    @foreach($capacidades->groupBy('red') as $key => $capacidad)
    <div class="row">
      <div class="col-12 table-responsive">
        <div class="card-header">
            <h3 class="card-title">Red: {{mb_convert_case($key, MB_CASE_TITLE, "UTF-8")}}</h3>
        </div>
        @foreach($capacidad->groupBy('establecimiento') as $e => $establecimiento)
        <div class="card-header">
            <h5 style="margin-left: 5%">Establecimiento: {{mb_convert_case($e, MB_CASE_TITLE, "UTF-8")}}</h5>
        </div>
        @foreach($establecimiento->groupBy('especialidad') as $f => $funcionario)
        <div style="margin-left: 10%">
            <h5>Especialidad: {{mb_convert_case($f, MB_CASE_TITLE, "UTF-8")}}</h5>
            <table class="table table-striped">
                <thead>
                <tr>
                      <th style="width: 30%">Profesional</th>
                      <th style="width: 10%">Dia</th>
                      <th style="width: 10%">Horario</th>
                      <th style="width: 5%">Capacidad</th>
                      <th style="width: 5%">Cupo</th>
                      <th></th>
                </tr>
                </thead>
                <tbody>
                      @foreach($funcionario as $h => $horario)
                      <tr>
                          <td>{{ mb_convert_case($horario->nombre, MB_CASE_TITLE, "UTF-8") . ' ' . mb_convert_case($horario->apellido, MB_CASE_TITLE, "UTF-8") }}</td>
                          <td>{{ mb_convert_case($horario->dia, MB_CASE_TITLE, "UTF-8") }}</td>
                          <td>{{ $horario->hora_desde . ' ' . $horario->hora_hasta }}</td>
                          <td>{{ $horario->capacidad }}</td>
                          <td>{{ $horario->cupo }}</td>
                          <td>
                            <progress id="file" value="{{$horario->porcentaje}}" max="100">{{round($horario->porcentaje)}}% </progress>
                            {{round($horario->porcentaje)}}%
                          </td>
                      </tr>
                      @endforeach
                </tbody>
              </table>
        </div>
        @endforeach
        @endforeach
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