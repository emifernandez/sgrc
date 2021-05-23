@extends('layouts.app')
@section('title', 'Referencias')
@section('menu-header')
    <li class="breadcrumb-item active">Referencias</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('registro-consulta.index')}}" class="btn btn-primary">Nueva Referencia</a>
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
                    @foreach($referencias as $key => $referencia)
                    <tr>
                        <td>{{ $referencia->fecha->forForm() }}</td>
                        <td>{{ $referencia->paciente->nombres }}</td>
                        <td>{{ $referencia->establecimiento->nombre }}</td>
                        <td>{{ $referencia->establecimiento_derivacion->nombre }}</td>
                        <td>{{ $referencia->profesional_derivante->nombres . ' ' . $referencia->profesional_derivante->apellidos }}</td>
                        <td>{{ $referencia->profesional_derivado->nombres . ' ' . $referencia->profesional_derivado->apellidos }}</td>
                        <td>{{ $prioridades[$referencia->prioridad] }}</td>
                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$referencia->derivacion}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('referencia.edit', $referencia->derivacion) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{ route('contrarreferencia.show', $referencia->derivacion) }}" class= "btn btn-info" style="margin-top: 5px;">Contrarreferencia</a>
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
          <h4 class="modal-title">Eliminar Referencia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('referencia.destroy', 'test')}}" method="post">
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
