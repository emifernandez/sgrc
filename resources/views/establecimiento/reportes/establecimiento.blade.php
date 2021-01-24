<!DOCTYPE html>
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
            padding: 2px;
            margin: 2px;
            font-size: 0.8em;
            text-align: center;
        }
        td {
            border: solid 1px #777;
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
        <h3>Informe de Establecimientos</h3>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
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
</html>
