
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body>
  <div class="wrapper">
    <section class="invoice">
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <i class="fas fa-globe"></i> Confirmación de Contrarreferencia
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 table-responsive">
          <address>
          <h3><strong>Prioridad:</strong> {{$data->prioridad}}</h3> <br>
          <strong>ID: </strong> {{$data->derivacion}} <br>
          <strong>Establecimiento Origen: </strong> {{mb_convert_case($data->establecimiento->nombre, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Establecimiento Destino: </strong> {{mb_convert_case($data->establecimiento_derivacion->nombre, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Paciente:</strong> {{mb_convert_case($data->paciente->nombres, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Documento:</strong> {{$data->paciente->numero_documento}} <br>
          <strong>Consulta ID:</strong> {{$data->consulta}} <br>
          <strong>Especialidad:</strong> {{mb_convert_case($data->especialidad->nombre, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Profesional Derivado:</strong> {{mb_convert_case($data->profesional_derivado->nombres . ' ' . $data->profesional_derivado->apellidos, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Profesional Derivante:</strong> {{mb_convert_case($data->profesional_derivante->nombres . ' ' . $data->profesional_derivante->apellidos, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Diagnóstico:</strong> {{mb_convert_case($data->cie_derivacion->codigo . ' ' . $data->cie_derivacion->decripcion, MB_CASE_TITLE, "UTF-8")}} <br>
          <strong>Descripción del Caso:</strong> {{$data->descripcion_caso}} <br>
          <strong>Impresión Diagnóstica</strong> {{$data->impresion_diagnostica}} <br>
          <strong>Tratamiento Actual:</strong> {{$data->tratamiento_actual}} <br>
          <strong>Recomendación:</strong> {{$data->recomendacion}} <br>
          <strong>Situación Socio-Familiar:</strong> {{$data->situacion_sociofamiliar}} <br>
          </address>
          <hr>
        </div>
      </div>
    </section>
  </div>
<!-- ./wrapper -->
</body>
</html>
