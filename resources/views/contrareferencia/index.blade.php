@extends('layouts.app')
@section('title', 'Contrarreferencias')
@section('menu-header')
    <li class="breadcrumb-item active">Contrarreferencias</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('referencia.index')}}" class="btn btn-primary">Nueva Contrarreferencia</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Paciente</th>
                        <th>Establecimiento</th>
                        <th>Derivacion</th>
                        <th>Derivante</th>
                        <th>Derivado A</th>
                        <th>Prioridad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contrareferencias as $key => $contrareferencia)
                    <tr>
                        <td>{{ $contrareferencia->fecha->forForm() }}</td>
                        <td>{{ $contrareferencia->paciente->nombres }}</td>
                        <td>{{ $contrareferencia->establecimiento->nombre }}</td>
                        <td>{{ $contrareferencia->establecimiento_derivacion->nombre }}</td>
                        <td>{{ $contrareferencia->profesional_derivante->nombres . ' ' . $contrareferencia->profesional_derivante->apellidos }}</td>
                        <td>{{ $contrareferencia->profesional_derivado->nombres . ' ' . $contrareferencia->profesional_derivado->apellidos }}</td>
                        <td>{{ $prioridades[$contrareferencia->prioridad] }}</td>
                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$contrareferencia->derivacion}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('contrarreferencia.edit', $contrareferencia->derivacion) }}" class= "btn btn-secondary" target="_blank"><i class="fas fa-print"></i></a>
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
          <h4 class="modal-title">Eliminar Contrarreferencia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('contrarreferencia.destroy', 'test')}}" method="post">
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
