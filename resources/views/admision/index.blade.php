@extends('layouts.app')
@section('title', 'Admisiones')
@section('menu-header')
    <li class="breadcrumb-item active">Admisiones</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('admision.create')}}" class="btn btn-primary">Nueva Admision</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Fecha Admision</th>
                        <th>Paciente</th>
                        <th>Establecimiento</th>
                        <th>Especialidad</th>
                        <th>Profesional</th>
                        <th>Servicio Medico</th>
                        <th>Prioridad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admisiones as $key => $admision)
                    <tr>
                        <td>{{ $admision->fecha_admision->forForm() }}</td>
                        <td>{{ $admision->paciente->nombres }}</td>
                        <td>{{ $admision->establecimiento->nombre }}</td>
                        <td>{{ $admision->especialidad->nombre }}</td>
                        <td>{{ $admision->profesional->nombres . ' ' . $admision->profesional->apellidos }}</td>
                        <td>{{ $admision->servicio->nombre }}</td>
                        <td>{{ $prioridades[$admision->prioridad] }}</td>
                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$admision->admision}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('admision.edit', $admision->admision) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
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
          <h4 class="modal-title">Eliminar Admision</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admision.destroy', 'test')}}" method="post">
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
