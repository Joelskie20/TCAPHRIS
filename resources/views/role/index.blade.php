@extends('layouts.master')

@section('title', 'Roles')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

    <!-- CONTENT HEADER -->
    <section class="content-header">
        <h1>Permissions</h1>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Roles List</h3>
                <div class="pull-right box-options">
                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-default-add">
                    <i class="fa fa-plus mr05"></i> ADD ROLE
                </button>
                </div>
            </div>
            <div class="box-body">
                <div class="modal fade" id="modal-default-add">
                    <form action="{{ action('RoleController@store') }}" method="POST">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Add Role</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group {{ ($errors->any()) ? 'has-error' : '' }}" id="role-name-add">
                                        @if($errors->any())
                                            <i class="fa fa-times-circle-o"></i>
                                        @endif
                                        <label for="role-name-add-label">Role Name</label>
                                        <input type="text" class="form-control" id="role-name-add-label" name="name" placeholder="Enter role name" required>
                                        @if($errors->any())
                                            @foreach($errors->all() as $error)
                                                <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Create Role</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </form>
                    <!-- /.modal-dialog -->
                </div>
                <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="table" class="table table-bordered table-hover table-striped dataTable" role="grid" aria-describedby="data-table_info">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Role Name</th>
                                        <th style="width: 55px;">Members</th>
                                        <th style="width: 801px;">Permissions</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <div class="modal fade" id="modal-default-edit-{{ $role->id }}">
                                            <form action="{{ action('RoleController@update', ['id' => $role->id]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Edit Role</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group role-name" id="role-name-add">
                                                                <label for="role-name-add-label">Role Name</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary btn-update-role">Update Role</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                            </form>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        @if($role->name === 'superadmin') @continue @endif

                                        <tr>
                                            <td>
                                                {{ ucwords($role->name) }}
                                            </td>
                                            <td>{{ $role->users->count() }}</td>
                                            <td>
                                            @if($role->permissions->count() > 0)
                                                @foreach ($role->permissions as $permission)
                                                    {{ ucwords($permission->name) }}@if ( ! $loop->last),@endif
                                                @endforeach
                                            @else
                                                <em>No Permission(s) Set</em>
                                            @endif
                                            </td>
                                            <td class="data-options">
                                                <a href="/permissions/role/{{ $role->id }}" class="btn btn-primary btn-xs mr05" title="Permissions" target="_blank"><i class="fa fa-key"></i></a>
                                                <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-default-edit-{{ $role->id }}"><i class="fa fa-pencil"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </section>

</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').dataTable({
        'iDisplayLength': 100
    });
});
</script>
<script>
    @if(count($errors) > 0)
        $('#modal-default-add').modal('show');
    @endif
</script>
@endsection