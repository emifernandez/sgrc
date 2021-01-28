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
            Informe de Derivaciones
          </h3>
        </div>
      </div>
    @foreach($collection->groupBy('tipo') as $key => $derivacion)
    <div class="row">
      <div class="col-12 table-responsive">
        <div class="card-header">
            <h3 class="card-title">{{mb_convert_case($key, MB_CASE_TITLE, "UTF-8")}}s</h3>
        </div>
        @foreach($derivacion as $i => $item)
        <address>
        <strong>ID: </strong> {{$item->derivacion}} <br>
        <strong>Establecimiento Origen: </strong> {{mb_convert_case($item->establecimiento_origen, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Establecimiento Destino: </strong> {{mb_convert_case($item->establecimiento_destino, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Paciente:</strong> {{mb_convert_case($item->paciente, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Documento:</strong> {{$item->documento_paciente}} <br>
        <strong>Consulta:</strong> {{$item->consulta}} <br>
        <strong>Especialidad:</strong> {{mb_convert_case($item->especialidad, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Profesional Derivado:</strong> {{mb_convert_case($item->funcionario_derivado_nombres . ' ' . $item->funcionario_derivado_apellidos, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Profesional Derivante:</strong> {{mb_convert_case($item->funcionario_derivante_nombres . ' ' . $item->funcionario_derivante_apellidos, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Fecha:</strong> {{$item->fecha}} <br>
        <strong>Motivo:</strong> {{mb_convert_case($item->motivo, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Diagnóstico:</strong> {{mb_convert_case($item->diagnostico, MB_CASE_TITLE, "UTF-8")}} <br>
        <strong>Tipo:</strong> {{$item->tipo}} <br>
        <strong>Descripción del Caso:</strong> {{$item->descripcion_caso}} <br>
        <strong>Impresión Diagnóstica</strong> {{$item->impresion_diagnostica}} <br>
        <strong>Recomendación:</strong> {{$item->recomendacion}} <br>
        <strong>Prioridad:</strong> {{$item->prioridad}} <br>
        <strong>Usuario:</strong> {{$item->usuario}} <br>
        </address>
        <hr>
    @endforeach
    @endforeach
      </div>
    </div>
    <div class="row">
        <div class="col-6">
          
        </div>
        <!-- /.col -->
        <div class="col-6">
          <p class="lead">Resumen</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Referencias:</th>
                <td>{{$referencias[0]->referencias}}</td>
              </tr>
              <tr>
                <th>Contra Referencias:</th>
                <td>{{$contrareferencias[0]->contrareferencias}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{$total[0]->total}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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