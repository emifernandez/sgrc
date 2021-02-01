@extends('layouts.header')
@section('content')
<div class="wrapper">
  <section class="invoice">
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
                <th>Día</th>
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