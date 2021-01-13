@extends('layouts.app')
@section('title', 'Asignar Permisos')
@section('menu-header')
@section('menu-header')
    <li class="breadcrumb-item"><a href="{{ route('permiso.index') }}">Permisos</a></li>
    <li class="breadcrumb-item active">Asignar Permisos</a></li>
@endsection
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('permiso.create')}}" class="btn btn-primary">Nuevo Permiso</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Acceso</th>
                        <th style="width: 5%">Habilitado</th>
                        <th><a href="javascript:;" class="btn btn-info addRow"><i class="fas fa-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="acceso" id="acceso">
                                <option value="">Seleccione un acceso</option>
                            @foreach($accesos as $key => $acceso)
                                <option value="{{ $acceso->acceso }}"
                                    >{{ $acceso->nombre }}</option>
                            @endforeach
                            </select>
                        </td>
                        <td class="text-center"><input type="checkbox" class="form-chack-input"></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$acceso->acceso}}">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                        </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Eliminar Acceso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('permiso.destroy', 'test')}}" method="post">
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
        });

        $('thead').on('click', '.addRow', function() {
            var tr = '<tr>' +
                '<td>' +
                    '<select class="form-control" name="acceso" id="acceso">' +
                        '<option value="">Seleccione un acceso</option>' +
                    '@foreach($accesos as $key => $acceso)' +
                        '<option value="{{ $acceso->acceso }}"' +
                            '>{{ $acceso->nombre }}</option>' +
                    '@endforeach' +
                    '</select>' +
                '</td>' +
                '<td class="text-center"><input type="checkbox" class="form-chack-input"></td>' +
                '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$acceso->acceso}}">' +
                    '<i class="fas fa-trash-alt" aria-hidden="true"></i>' +
                '</button></td>' +
            '</tr>';
            $('tbody').append(tr);
        });

    </script>
@endsection
