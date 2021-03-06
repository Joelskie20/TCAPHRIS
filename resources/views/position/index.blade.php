@extends('layouts.master')

@section('title', 'Positions')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
	    <h1>Positions</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Positions List</h3>
                @can('add position')
                <button type="button" class="btn btn-success pull-right btn-add-department" data-toggle="modal" data-target="#modal-default-add">
                    <i class="fa fa-plus mr05"></i> ADD POSITION
                </button>
                @endcan

                <div class="modal fade add-position-modal" id="modal-default-add">
                        <form action="{{ action('PositionController@store') }}" method="POST">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Add Position</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group {{ ($errors->any()) ? 'has-error' : '' }}" id="position-name-add">
                                            @if($errors->any())
                                                <i class="fa fa-times-circle-o"></i>
                                            @endif
                                            <label for="position-name-add-label">Position Name</label>
                                            <input type="text" class="form-control" id="position-name-add-label" name="name" placeholder="Enter position name" required>
                                            @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                    <span class="help-block">{{ $error }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-create-position">Create Position</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </form>
                        <!-- /.modal-dialog -->
                    </div>

            </div>
            <div class="box-body">

                <div class="modal fade" id="modal-default-edit">
                    <form action="#" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Position</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group position-name" id="position-name-add">
                                        <label for="position-name-add-label">Position Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-update-position">Update Position</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </form>
                    <!-- /.modal-dialog -->
                </div>
                
                <table id="table" class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="85%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Position Name</th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $key => $position)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="positionName">{{ $position->name }}</td>
                                <td>
                                    @can('edit position')                                
                                    <button onclick="infoToModal('{{ $position->id }}','{{ $position->name }}','positions')" type="button" class="btn btn-success btn-xs btn-edit" data-toggle="modal" data-target="#modal-default-edit"><i class="fa fa-pencil"></i></button>
                                    @endcan

                                    @can('delete position')
                                    <form style="display: inline-block;" action="/positions/{{ $position->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('This process is irreversible. Please make sure before you confirm. All teams, subteams and employees under this department will be unassigned. Reconsider updating the department instead.\n\n Are you sure you want to delete this item?');" title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').dataTable({
        'iDisplayLength': 100,
        'columnDefs': [{'targets': 'no-sort','orderable': false,}]
    });
});
</script>
@endsection