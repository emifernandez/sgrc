@extends('layouts.header')
@section('content')
<div class="wrapper">
  <section class="invoice">
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> {{ $derivacion->establecimiento->nombre }}
        </h2>
      </div>
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>{{$derivacion->establecimiento->ubicacion}}</strong><br>
          {{$derivacion->establecimiento->barrio->distrito->nombre}}<br>
          Teléfono: {{$derivacion->establecimiento->telefono1 . ' - ' . $derivacion->establecimiento->telefono2}}<br>
          Email: {{$derivacion->establecimiento->email}}<br>
          Fecha: {{ $todayDate = date("d/m/Y H:i:s")}}
        </address>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
          <h3 >
            Informe de Derivación
          </h3>
        </div>
      </div>
   
    <div class="row">
      <div class="col-12 table-responsive">
          <table>
              <tbody>
                <tr>
                    <td>ID</td>
                    <td>: {{$derivacion->derivacion}}</td>
                </tr>
                <tr>
                    <td>Establecimiento Origen</td>
                    <td>: {{mb_convert_case($derivacion->establecimiento->nombre, MB_CASE_TITLE, "UTF-8")}}</td>
                </tr>
                <tr>
                    <td>Establecimiento Destino</td>
                    <td>: {{mb_convert_case($derivacion->establecimiento_derivacion->nombre, MB_CASE_TITLE, "UTF-8")}}</td>
                </tr>
                <tr>
                    <td>Paciente</td>
                    <td>: {{mb_convert_case($derivacion->paciente->nombres, MB_CASE_TITLE, "UTF-8")}}</td>
                </tr>
                <tr>
                    <td>Documento</td>
                    <td>: {{$derivacion->paciente->numero_documento}}</td>
                </tr>
                <tr>
                    <td>Consulta ID</td>
                    <td>: {{$derivacion->consulta}}</td>
                </tr>
                <tr>
                    <td>Especialidad</td>
                    <td>: {{mb_convert_case($derivacion->especialidad->nombre, MB_CASE_TITLE, "UTF-8")}}</td>
                </tr>
                <tr>
                    <td>Profesional Derivado</td>
                    <td>: {{mb_convert_case($derivacion->profesional_derivado->nombres . ' ' . $derivacion->profesional_derivado->apellidos, MB_CASE_TITLE, "UTF-8")}} </td>
                </tr>
                <tr>
                    <td>Profesional Derivante</td>
                    <td>: {{mb_convert_case($derivacion->profesional_derivante->nombres . ' ' . $derivacion->profesional_derivante->apellidos, MB_CASE_TITLE, "UTF-8")}}</td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td>: {{$derivacion->fecha->forForm()}}</td>
                </tr>
                <tr>
                    <td>Diagnóstico</td>
                    <td>: {{mb_convert_case($derivacion->cie_derivacion->codigo . ' - ' . $derivacion->cie_derivacion->descripcion, MB_CASE_TITLE, "UTF-8")}}</td>
                </tr>
                <tr>
                    <td>Tipo</td>
                    <td>: {{$derivacion->tipo}} </td>
                </tr>
                <tr>
                    <td>Descripción del Caso</td>
                    <td>: {{$derivacion->descripcion_caso}}</td>
                </tr>
                <tr>
                    <td>Impresión Diagnóstica</td>
                    <td>: {{$derivacion->impresion_diagnostica}}</td>
                </tr>
                <tr>
                    <td>Tratamiento Actual</td>
                    <td>: {{$derivacion->tratamiento_actual}} </td>
                </tr>
                <tr>
                    <td>Recomendación</td>
                    <td>: {{$derivacion->recomendacion}}</td>
                </tr>
                <tr>
                    <td>Situación Socio-Familiar</td>
                    <td>: {{$derivacion->situacion_sociofamiliar}} </td>
                </tr>
                <tr>
                    <td>Prioridad</td>
                    <td>: {{$derivacion->prioridad}} </td>
                </tr>
                <tr>
                    <td>Usuario</td>
                    <td>: {{$derivacion->usuario}} </td>
                </tr>
              </tbody>
          </table>
        <hr>
      </div>
    </div>
    <hr>
        <div class="text-center">
            Fin del informe
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