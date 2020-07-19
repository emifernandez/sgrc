@extends('layouts.app')
@section('title', 'Redes')
@section('content')
<div class="col-sm-12">
  </div>
<div class="panel panel-default">
    <div style="margin: 10px;" class="panel-heading">
        <a  href="{{route('red.create')}}" class="btn btn-primary">Nueva Red</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabla">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Red</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($redes as $key => $red)
                    <tr>
                        <td>{{ $red->red }}</td>
                        <td>{{ $red->nombre }}</td>
                        <td>
                            <div class="row">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-data="{{$red->red}}">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('red.edit', $red->red) }}" class= "btn btn-info"><i class="fas fa-pencil-alt"></i></a>
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
          <h4 class="modal-title">Eliminar Red</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('red.destroy', 'test')}}" method="post">
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
            var button = $(event.relatedTarget) // Button that triggered the modal
            var data = button.data('data') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('.modal-body #id').val(data)
          })
    </script>
@endsection
