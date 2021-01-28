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
            Informe de Horarios de Atención
          </h3>
        </div>
      </div>

    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
                <th>Establecimiento</th>
                <th>Especialidad</th>
                <th>Profesional</th>
                <th>Dia</th>
                <th>Desde</th>
                <th>Hasta</th>
          </tr>
          </thead>
          <tbody>
                @foreach($horarios as $key => $horario)
                <tr>
                    <td>{{ mb_convert_case($horario->establecimiento, MB_CASE_TITLE, "UTF-8") }}</td>
                    <td>{{  mb_convert_case($horario->especialidad, MB_CASE_TITLE, "UTF-8") }}</td>
                    <td>{{  mb_convert_case($horario->nombre . ' ' . $horario->apellido, MB_CASE_TITLE, "UTF-8") }}</td>
                    <td>{{ $horario->dia }}</td>
                    <td>{{ $horario->hora_desde }}</td>
                    <td>{{ $horario->hora_hasta }}</td>
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
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Reporte</title>
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            margin: 3cm 2cm 2cm;
        }
        h3 {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #343a40;
            color: white;
            text-align: center;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color: #343a40;
            color: white;
            text-align: center;
            line-height: 35px;
        }
        th {
            border: solid 1px #777;
            border-collapse: collapse;
            padding: 2px;
            margin: 2px;
            font-size: 0.8em;
            text-align: center;
        }
        td {
            border: solid 1px #777;
            border-collapse: collapse;
            padding: 2px;
            margin: 2px;
            font-size: 0.7em;
        }
    </style>
</head>
<body>
    <header>
        <br>
        <p><strong>{{ env('APP_FULL_NAME') }}</strong></p>
    </header>
    <main>
        <h3>Informe de Profesionales</h3>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>Establecimiento</th>
                    <th>Dia</th>
                    <th>Especialidad</th>
                    <th>Profesional</th>
                    <th>Hora Desde</th>
                    <th>Hora Hasta</th>

                </tr>
                </thead>
                <tbody>
                    @foreach($horarios as $key => $horario)
                    <tr>
                        <td>{{ $horario->establecimiento }}</td>
                        <td>{{ $horario->dia }}</td>
                        <td>{{ $horario->especialidad }}</td>
                        <td>{{ $horario->nombre . ' ' . $horario->apellido }}</td>
                        <td>{{ $horario->hora_desde }}</td>
                        <td>{{ $horario->hora_hasta }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Página {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 20;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </footer>
</body>
</html> --}}
