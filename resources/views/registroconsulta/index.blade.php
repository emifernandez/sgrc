@extends('layouts.app')
@section('title', 'Atenciones Médicas')
@section('menu-header')
    <li class="breadcrumb-item active">Atenciones Médicas</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('consultas.pendientes')}}" class="btn btn-primary">Nueva Consulta</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Paciente</th>
                        <th>Establecimiento</th>
                        <th>Profesional</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultas as $key => $consulta)
                    <tr>
                        <td>{{ $consulta->fecha->forForm() }}</td>
                        <td>{{ $consulta->paciente->nombres }}</td>
                        <td>{{ $consulta->establecimiento->nombre }}</td>
                        <td>{{ $consulta->profesional->nombres . ' ' . $consulta->profesional->apellidos}}</td>
                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$consulta->consulta}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('referencia.show', $consulta->consulta) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i> Referencia</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Eliminar Consulta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('registro-consulta.destroy', 'test')}}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-body">
            <p>¿Esta seguro que desea eliminar el registro?</p>
            <input type="hidden" id="id" name="id" value="">
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt" aria-hidden="true"></i> Eliminar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        $('#modal-danger').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var data = button.data('data')
            var modal = $(this)
            modal.find('.modal-body #id').val(data)
          })
    </script>
@endsection
