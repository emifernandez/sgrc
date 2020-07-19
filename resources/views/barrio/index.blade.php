@extends('layouts.app')
@section('title', 'Barrios')
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('barrio.create')}}" class="btn btn-primary">Nuevo Barrio</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Barrio</th>
                        <th>Distrito</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barrios as $key => $barrio)
                    <tr>
                        <td>{{ $barrio->barrio }}</td>
                        <td>{{ $barrio->nombre }}</td>
                        <td>{{ $barrio->distrito->nombre }}</td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$barrio->barrio}}">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('barrio.edit', $barrio->barrio) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                            </div>
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
          <h4 class="modal-title">Eliminar Barrio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('barrio.destroy', 'test')}}" method="post">
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
