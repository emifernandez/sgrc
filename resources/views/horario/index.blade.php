@extends('layouts.app')
@section('title', 'Horarios de Atención')
@section('menu-header')
    <li class="breadcrumb-item active">Horarios de Atención</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('horario.create')}}" class="btn btn-primary">Nuevo Horario</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Establecimiento</th>
                        <th>Especialidad</th>
                        <th>Funcionario</th>
                        <th>Dia</th>
                        <th>Hora Desde</th>
                        <th>Hora Hasta</th>
                        <th>Capacidad</th>
                        <th>Uso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($horarios as $key => $horario)
                    <tr>
                        <td>{{ $horario->establecimiento->nombre }}</td>
                        <td>{{ $horario->especialidad->nombre }}</td>
                        <td>{{ $horario->funcionario->nombres . ' ' . $horario->funcionario->apellidos }}</td>
                        <td>{{ $horario->dia }}</td>
                        <td>{{ $horario->hora_desde->format('H:i') }}</td>
                        <td>{{ $horario->hora_hasta->format('H:i') }}</td>
                        <td>{{ $horario->capacidad_atencion }}</td>
                        <td>{{ $horario->uso_atencion }}</td>
                        <td>{{ $estados[$horario->estado] }}</td>
                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$horario->horario}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('horario.edit', $horario->horario) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
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
          <h4 class="modal-title">Eliminar Horario de Atención</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('horario.destroy', 'test')}}" method="post">
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
