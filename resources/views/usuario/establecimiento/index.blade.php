@extends('layouts.app')
@section('title', 'Establecimientos asignados a Usuarios')
@section('menu-header')
    <li class="breadcrumb-item active">Establecimientos asignados a Usuarios</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading row">
        <div class="col-sm-3">
            <div class="form-group form-inline">
                <label for="usuario" class="col-sm-3 col-form-label">Usuario</label>
                <form method="GET">
                    <select class="form-control" name="usuario" id="usuario" onchange="this.form.submit()">
                        <option value="">Seleccione un Usuario</option>
                        @foreach($usuarios as $key => $usuario)
                            <option value="{{ $usuario->usuario }}"
                                @if ($usuario->usuario == $usuario_selected)
                                    selected="true"
                                @endif>{{ $usuario->usuario }}</option>
                        @endforeach
                </select>
            </form>
            </div>
        </div>
        <div class="col-sm-3">
            <a  href="{{route('usuario-establecimiento.create')}}" class="btn btn-primary">Asignar Establecimiento</a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Establecimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($establecimientos as $key => $establecimiento)
                    <tr>
                        <td>{{ $establecimiento->establecimiento }}</td>
                        <td>{{ $establecimiento->nombre }}</td>

                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$establecimiento->establecimiento}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
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
          <h4 class="modal-title">Eliminar Establecimiento Asignado</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('usuario-establecimiento.destroy', 'test')}}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-body">
            <p>¿Esta seguro que desea eliminar el registro?</p>
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" id="usuario" name="usuario" value="">
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
            var usuario = document.getElementById("usuario").value;
            var modal = $(this)
            modal.find('.modal-body #id').val(data)
            modal.find('.modal-body #usuario').val(usuario)

        })
    </script>
@endsection
