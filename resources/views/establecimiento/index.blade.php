@extends('layouts.app')
@section('title', 'Establecimientos')
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('establecimiento.create')}}" class="btn btn-primary">Nuevo Establecimiento</a>
        <a  href="{{route('establecimiento.report')}}" class="btn btn-success">Imprimir</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Establecimiento</th>
                        <th>Tipo</th>
                        <th>Red</th>
                        <th>Encargado</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($establecimientos as $key => $establecimiento)
                    <tr>
                        <td>{{ $establecimiento->establecimiento }}</td>
                        <td>{{ $establecimiento->nombre }}</td>
                        <td>{{ $establecimiento->tipo->nombre }}</td>
                        <td>{{ $establecimiento->red->nombre }}</td>
                        @if(isset($establecimiento->establecimiento_encargado))
                        <td>{{ $establecimiento->establecimiento_encargado->nombre }}</td>
                        @else
                        <td> Sin Encargado</td>
                        @endif
                        <td>{{ $establecimiento->telefono1 - $establecimiento->telefono2 }}</td>
                        <td>{{ $establecimiento->estado }}</td>

                        <td style="display: block;  margin: auto;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$establecimiento->establecimiento}}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('establecimiento.edit', $establecimiento->establecimiento) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
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
          <h4 class="modal-title">Eliminar Establecimiento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('establecimiento.destroy', 'test')}}" method="post">
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
