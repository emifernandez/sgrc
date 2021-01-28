@extends('layouts.app')

@section('title', 'Atenciones Médicas')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('registro-consulta.index') }}">Atenciones Médicas</a></li>
    <li class="breadcrumb-item active">Crear Consulta</a></li>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Crear Consulta</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('registro-consulta.store') }}">
                                @csrf
                                <input type="hidden" name="admision" id="admision" value="{{ $admision->admision }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy"
                                                    data-mask
                                                    name="fecha"
                                                    id="fecha"
                                                    value="{{ old('fecha', $todayDate = date("d-m-Y")) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select class="form-control" name="tipo_consulta" id="tipo_consulta">
                                                    @foreach($tipos_consultas as $key => $tipo_consulta)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('tipo_consulta')) selected @endif
                                                            >{{ $tipo_consulta }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('tipo_consulta') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="estado" id="estado">
                                                    @foreach($estados as $key => $estado)
                                                        <option value="{{ $key }}"
                                                            @if($key == old('estado')) selected @endif
                                                            >{{ $estado }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('estado') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Paciente</label>
                                                <select class="form-control" name="paciente" id="paciente" readonly>
                                                    @foreach($pacientes as $key => $paciente)
                                                        <option value="{{ $paciente->paciente }}"
                                                            @if($paciente->paciente == old('paciente')) selected @endif
                                                            >{{ $paciente->nombres }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('paciente') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Establecimiento</label>
                                                <select class="form-control" name="establecimiento" id="establecimiento" readonly>
                                                    @foreach($establecimientos as $key => $establecimiento)
                                                        <option value="{{ $establecimiento->establecimiento }}"
                                                            @if($establecimiento->establecimiento == old('establecimiento')) selected @endif
                                                            >{{ $establecimiento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('establecimiento') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Profesional</label>
                                                <select class="form-control" name="profesional" id="profesional" readonly>
                                                    @foreach($profesionales as $key => $profesional)
                                                        <option value="{{ $profesional->funcionario }}"
                                                            @if($profesional->funcionario == old('profesional')) selected @endif
                                                            >{{ $profesional->nombres . ' ' . $profesional->apellidos}}</option>
                                                    @endforeach
                                                </select>
                                                @foreach ($errors->get('profesional') as $error)
                                                    <span class="text text-danger">{{ $error }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="observacion">Observacion</label>
                                        <textarea class="form-control"
                                            rows="3"
                                            name="observacion"
                                            id="observacion"
                                            value="{{ old('observacion') }}"
                                            placeholder="Introduzca observacion para la consulta"></textarea>
                                            @foreach ($errors->get('observacion') as $error)
                                                <span class="text text-danger">{{ $error }}</span>
                                            @endforeach
                                    </div>

                                    {{-- MOTIVOS      --}}
                                    <hr>
                                    <div class="form-group text-center">
                                        <h4>Motivos de Consulta</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla-motivo">
                                                <thead>
                                                    <tr>
                                                        <th style="display:none;">Codigo</td>
                                                        <th>
                                                            <div class="input-group ">
                                                                <select class="form-control" name="motivo" id="motivo">
                                                                    <option value=null>Seleccione un Motivo</option>
                                                                    @foreach($motivos as $key => $motivo)
                                                                        <option value="{{ $motivo }}"
                                                                            @if($motivo->motivo == old('motivo')) selected @endif
                                                                            >{{ $motivo->descripcion }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @foreach ($errors->get('motivo') as $error)
                                                                    <span class="text text-danger">{{ $error }}</span>
                                                                @endforeach
                                                            </div>
                                                        </th>
                                                        <th><input type="text" class="form-control" id="motivo_descripcion" placeholder="Introduzca una descripcion para el motivo"></td>
                                                        <th style="horizontal-align: middle; display: block; margin: auto;">
                                                            <a class="btn btn-info addMotivo" data-toggle="tooltip" title="Agregar Motivo">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- DIAGNOSTICOS      --}}
                                    <div class="form-group text-center">
                                        <h4>Diagnosticos de Consulta</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla-enfermedad">
                                                <thead>
                                                    <tr>
                                                        <th style="display:none;">Codigo</td>
                                                        <th>
                                                            <div class="input-group ">
                                                                <select class="form-control" name="enfermedad" id="enfermedad">
                                                                    <option value=null>Seleccione una Enfermedad</option>
                                                                    @foreach($enfermedades as $key => $enfermedad)
                                                                        <option value="{{ $enfermedad }}"
                                                                            @if($enfermedad->enfermedad == old('enfermedad')) selected @endif
                                                                            >{{ $enfermedad->codigo . ' - ' . $enfermedad->descripcion }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @foreach ($errors->get('enfermedad') as $error)
                                                                    <span class="text text-danger">{{ $error }}</span>
                                                                @endforeach
                                                            </div>
                                                        </th>
                                                        <th><input type="text" class="form-control" id="enfermedad_observacion" placeholder="Introduzca una observación para la enfermedad"></td>
                                                        <th style="horizontal-align: middle; display: block; margin: auto;">
                                                            <a class="btn btn-info addDiagnostico" data-toggle="tooltip" title="Agregar Diagnostico">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- ORDENES --}}
                                    <hr>
                                    <div class="form-group text-center">
                                        <h4>Ordenes Médicas</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla-orden">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-10"><input type="text" class="form-control" id="orden" placeholder="Introduzca la Orden Médica"></th>
                                                        <th class="col-sm-2">
                                                            <a class="btn btn-info addOrden" data-toggle="tooltip" title="Agregar Orden">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- INDICACIONES --}}
                                    <hr>
                                    <div class="form-group text-center">
                                        <h4>Indicaciones Médicas</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla-indicacion">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-10"><input type="text" class="form-control" id="indicacion" placeholder="Introduzca la Indicación Médica"></th>
                                                        <th class="col-sm-2">
                                                            <a class="btn btn-info addIndicacion" data-toggle="tooltip" title="Agregar Indicacion">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('consultas.pendientes') }}" class="btn btn-secondary btn-close">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.tabla-simple').DataTable({
            responsive: true,
        });
        $('.addMotivo').on('click', function() {
            addMotivo();
        })
        $('.addOrden').on('click', function() {
            addOrden();
        })
        $('.addDiagnostico').on('click', function() {
            addDiagnostico();
        })
        $('.addIndicacion').on('click', function() {
            addIndicacion();
        })

        $( "table" ).on( "click", ".eliminar", function() {
            $(this).parent().parent().remove();
        });

        function addMotivo() {
            var m = document.getElementById("motivo");
            var d = document.getElementById("motivo_descripcion");
            var motivo = JSON.parse(m.value);
            var table = document.getElementById("tabla-motivo");
            var row = table.insertRow(-1);

            row.innerHTML = '<td style="display:none;"><input type="text" class="form-control" name="motivo[]" readonly value="' + motivo.motivo + '"></td>' 
                + '<td><input type="text" class="form-control" name="descripcion[]" readonly value="' + motivo.descripcion + '"></td>' 
                + '<td><input type="text" class="form-control" name="descripcion_motivo[]" readonly value="' + d.value + '"></td>' 
                + '<td><a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Motivo"><i class="fas fa-trash-alt"></i></a></td>';
            d.value = null;
        }

        function addOrden() {
            var orden = document.getElementById("orden");
            var table = document.getElementById("tabla-orden");
            var row = table.insertRow(-1);

            row.innerHTML = '<td><input type="text" class="form-control" name="orden[]" readonly value="' + orden.value + '"></td>' 
                + '<td><a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Orden"><i class="fas fa-trash-alt"></i></a></td>';
            orden.value = null;
        }

        function addDiagnostico() {
            var e = document.getElementById("enfermedad");
            var o = document.getElementById("enfermedad_observacion");
            var enfermedad = JSON.parse(e.value);
            var table = document.getElementById("tabla-enfermedad");
            var row = table.insertRow(-1);

            row.innerHTML = '<td style="display:none;"><input type="text" class="form-control" name="enfermedad[]" readonly value="' + enfermedad.enfermedad + '"></td>' 
                + '<td><input type="text" class="form-control" name="descripcion[]" readonly value="' + enfermedad.codigo +' - '+ enfermedad.descripcion + '"></td>' 
                + '<td><input type="text" class="form-control" name="enfermedad_observacion[]" readonly value="' + o.value + '"></td>' 
                + '<td><a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Diagnostico"><i class="fas fa-trash-alt"></i></a></td>';
            o.value = null;
        }

        function addIndicacion() {
            var indicacion = document.getElementById("indicacion");
            var table = document.getElementById("tabla-indicacion");
            var row = table.insertRow(-1);

            row.innerHTML = '<td><input type="text" class="form-control" name="indicacion[]" readonly value="' + indicacion.value + '"></td>' 
                + '<td><a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Indicacion"><i class="fas fa-trash-alt"></i></a></td>';
            indicacion.value = null;
        }
    });
</script> 
@endsection

