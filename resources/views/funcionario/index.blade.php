@extends('layouts.app')
@section('title', 'Funcionarios')
@section('menu-header')
    <li class="breadcrumb-item active">Funcionarios</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('funcionario.create')}}" class="btn btn-primary">Nuevo Funcionario</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>C.I.</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Cargo</th>
                        <th>Especialidad</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funcionarios as $key => $funcionario)
                    <tr>
                        <td>{{ $funcionario->cedula_identidad }}</td>
                        <td>{{ $funcionario->nombres }}</td>
                        <td>{{ $funcionario->apellidos }}</td>
                        <td>{{ $funcionario->cargo->nombre}}</td>
                        <td>{{ $funcionario->especialidad->nombre}}</td>
                        <td>{{ $funcionario->telefono_principal}}</td>
                        <td>{{ $funcionario->estado }}</td>

                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$funcionario->funcionario}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('funcionario.edit', $funcionario->funcionario) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
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
          <h4 class="modal-title">Eliminar Funcionario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('funcionario.destroy', 'test')}}" method="post">
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
