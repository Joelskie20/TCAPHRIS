@extends('layouts.master')

@section('title', 'Departments')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Departments</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            
            <div class="box-header with-border">
                <h3 class="box-title">Departments List</h3>
                @can('add department')
                <button type="button" class="btn btn-success pull-right btn-add-department" data-toggle="modal" data-target="#modal-default-add">
                    <i class="fa fa-plus mr05"></i> ADD DEPARTMENT
                </button>
                @endcan

                <div class="modal fade add-department-modal" id="modal-default-add">
                    <form action="{{ action('DepartmentController@store') }}" method="POST">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Department</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group {{ ($errors->any()) ? 'has-error' : '' }}" id="department-name-add">
                                        @if($errors->any())
                                            <i class="fa fa-times-circle-o"></i>
                                        @endif
                                        <label for="department-name-add-label">Department Name</label>
                                        <input type="text" class="form-control" id="department-name-add-label" name="name" placeholder="Enter department name" required>
                                        @if($errors->any())
                                            @foreach($errors->all() as $error)
                                                <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-create-department">Create Department</button>
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
									<h4 class="modal-title">Edit Department</h4>
								</div>
								<div class="modal-body">
									<div class="form-group department-name" id="department-name-add">
										<label for="department-name-add-label">Department Name</label>
										<input type="text" class="form-control" name="name" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary btn-update-department">Update Department</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								</div>
							</div>

						</div>
					</form>
				</div>
					
                <table id="table" class="table table-bordered table-striped">
					<colgroup width="5%">
					<colgroup width="85%">
					<colgroup width="10%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Department Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $key => $department)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td class="departmentName">{{ $department->name }}</td>
                            <td>
                                <input type="hidden" name="department_id" value="{{ $department->id }}">
                                @can('edit department')
                                <button type="button" class="btn btn-success btn-xs btn-edit" data-toggle="modal" data-target="#modal-default-edit"><i class="fa fa-pencil"></i></button>
                                @endcan
                                
                                @can('delete department')
                                <form style="display: inline-block;" action="/departments/{{ $department->id }}" method="POST">
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
        'iDisplayLength': 100
    });

    $('.btn-edit').click(function(){
        let id = $(this).closest('tr').find('input[name="department_id"]').val();
        let departmentName = $(this).closest('tr').find('.departmentName').html();
        $('#modal-default-edit').find('input[name="name"]').val(departmentName);
		$('#modal-default-edit form').attr('action', '/departments/' + id);
    });

});
</script>

<script>
    @if(count($errors) > 0)
        $('#modal-default-add').modal('show');
    @endif
</script>
@endsection