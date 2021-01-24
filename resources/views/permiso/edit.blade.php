@extends('layouts.app')

@section('title', 'Permisos')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('permiso.index') }}">Permisos</a></li>
    <li class="breadcrumb-item active">Editar Permiso</a></li>
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
                                <h3 class="card-title">Editar Permiso</h3>
                            </div>
                            <form role="form" id="form" method="POST" action="{{ route('permiso.update', $permiso->permiso) }}">
                                @method('PATCH')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="fecha_asignacion">Fecha</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control datemask"
                                                    readonly
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd-mm-yyyy H:M:S"
                                                    data-mask
                                                    name="fecha_asignacion"
                                                    id="fecha_asignacion"
                                                    value="{{ old('fecha_asignacion', $permiso->fecha_asignacion->forFormDateHour()) }}">
                                                </div>
                                                    @foreach ($errors->get('fecha_asignacion') as $error)
                                                        <span class="text text-danger">{{ $error }}</span>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Perfil</label>
                                        <select class="form-control" name="perfil" id="perfil">
                                                <option value="">Seleccione un perfil</option>
                                            @foreach($perfiles as $key => $perfil)
                                                <option value="{{ $perfil->perfil }}"
                                                    @if($perfil->perfil == old('perfil', $permiso->perfil)) selected @endif
                                                    >{{ $perfil->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('perfil') as $error)
                                            <span class="text text-danger">{{ $error }}</span>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group text-center">
                                        <h4>Accesos</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla-acceso">
                                                <thead>
                                                    <tr>
                                                        <th style="display:none;">Acceso</td>
                                                        <th>
                                                            <div class="input-group ">
                                                                <select class="form-control" name="acceso" id="acceso">
                                                                    <option value=null>Seleccione un Acceso</option>
                                                                    @foreach($accesos as $key => $acceso)
                                                                        <option value="{{ $acceso }}"
                                                                            @if($acceso->acceso == old('acceso')) selected @endif
                                                                            >{{ $acceso->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @foreach ($errors->get('acceso') as $error)
                                                                    <span class="text text-danger">{{ $error }}</span>
                                                                @endforeach
                                                            </div>
                                                        </th>
                                                        <th class="text-center" valign="center">
                                                            <label class="form-check-label" for="habilitado">Habilitado</label>
                                                        </th>
                                                        <th style="horizontal-align: middle; display: block; margin: auto;">
                                                            <a class="btn btn-info addAcceso" data-toggle="tooltip" title="Agregar Acceso">
                                                                <i class="fas fa-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($permiso_accesos as $key => $permiso_acceso)
                                                        <tr>
                                                            <td style="display:none;">
                                                                <input type="text" class="form-control" name="acceso[]" readonly value="{{ $permiso_acceso->acceso }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="nombre[]" readonly value="{{ $permiso_acceso->nombre }}">
                                                            </td>
                                                            <td class="text-center" valign="center">
                                                                <input class="form-check-input" type="checkbox" name="habilitado[]" @if($permiso_acceso->detalle->habilitado == true) checked @endif  value="{{ $permiso_acceso->detalle->habilitado }}">
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Acceso">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Grabar</button>
                                    <a href="{{ route('permiso.index') }}" class="btn btn-secondary btn-close">Cancelar</a>
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
        $('.addAcceso').on('click', function() {
            addAcceso();
        })
        $( "table" ).on( "click", ".eliminar", function() {
            $(this).parent().parent().remove();
        });

        function addAcceso() {
            var a = document.getElementById("acceso");
            var h = document.getElementById("habilitado");
            var acceso = JSON.parse(a.value);
            var table = document.getElementById("tabla-acceso");
            var row = table.insertRow(-1);

            row.innerHTML = '<td style="display:none;"><input type="text" class="form-control" name="acceso[]" readonly value="' + acceso.acceso + '"></td>' 
                + '<td><input type="text" class="form-control" name="nombre[]" readonly value="' + acceso.nombre + '"></td>' 
                + '<td class="text-center" valign="center">'
                    +' <input class="form-check-input" type="checkbox" name="habilitado[]" checked value="'+acceso.acceso+'">'
                +'</td>'
                + '<td><a class="btn btn-danger eliminar" data-toggle="tooltip" title="Eliminar Acceso"><i class="fas fa-trash-alt"></i></a></td>';
            d.value = null;
        }
    });
</script> 
@endsection