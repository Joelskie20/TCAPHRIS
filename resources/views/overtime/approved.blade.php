@extends('layouts.master')

@section('title', 'Overtime')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper" style="min-height: 697px;">

    <section class="content-header" style="overflow: hidden">
        <h1 class="pull-left">Approved</h1>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title pull-left">Overtime Approved</h3>
                <div class="box-options pull-right">
                    <button type="button" class="btn btn-success btn-sm btn-add-leave pull-right" data-toggle="modal" data-target="#modal-default-add"><i class="fa fa-plus mr05"></i> ADD OVERTIME</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Filed By</th>
                                        <th>Overtime Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Filing Date</th>
                                        <th>Approved by</th>
                                        <th>Date Approved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($overtimes as $key => $overtime)
                                    <div class="modal fade" id="modal-default-edit-{{ $overtime->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Edit Overtime</h4>
                                                </div>
                                                <form method="POST" action="{{ action('OvertimeController@update', ['id' => $overtime->id]) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="leaveDate">Overtime Date</label>
                                                                    <div class="input-group date" data-provide="datepicker">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" value="{{ Carbon::parse($overtime->date)->format('m/d/Y') }}" id="overtimeDate" name="overtime_date" class="form-control datepicker" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group employee" id="employee-add">
                                                                    <label for="employee-add">Employee</label>
                                                                    <select class="form-control" id="employee-add" name="employee_id">
                                                                        @foreach($users as $user)
                                                                        <option value="{{ $user->id }}" {{ $user->id === $overtime->user_id ? 'selected' : '' }}>[{{ $user->employee_id }}] {{ $user->lastNameFirst() }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group" id="overtime_time_in">
                                                                    <div class="bootstrap-timepicker">

                                                                        <label>Time In</label>

                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control timepicker" name="time_in" value="{{ Carbon::parse(date('g:i A', $overtime->time_in))->format('g:i A') }}">
                                                                            <div class="input-group-addon">
                                                                                <i class="fa fa-clock-o"></i>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group" id="overtime_time_out">
                                                                    <div class="bootstrap-timepicker">
                                                                        <div class="form-group">

                                                                            <label>Time Out</label>

                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control timepicker" name="time_out" value="{{ Carbon::parse(date('g:i A', $overtime->time_out))->format('g:i A') }}"">
                                                                                <div class="input-group-addon">
                                                                                    <i class="fa fa-clock-o"></i>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.input group -->

                                                                        </div>
                                                                        <!-- /.form group -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="form-group remarks" id="remarks-add">
                                                                    <label for="remarks-add">Remarks/Reason</label>
                                                                    <textarea class="form-control" id="remarks-add" name="remarks">{{ $overtime->remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update Overtime</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><a href="/employee/{{ $overtime->user_id }}">{{ $overtime->user->firstNameFirst() }}</a></td>
                                        <td>{{ Carbon::parse($overtime->date)->format('F j, Y') }}</td>
                                        <td>{{ Carbon::parse(date('g:i A', $overtime->time_in))->format('g:i A') }}</td>
                                        <td>{{ Carbon::parse(date('g:i A', $overtime->time_out))->format('g:i A') }}</td>
                                        <td>{{ Carbon::parse($overtime->filing_date)->format('F j, Y - g:i:s A') }}</td>
                                        <td><a href="/employee/{{ $overtime->approved_by }}">{{ App\User::where('id', $overtime->approved_by)->first()->firstAndLastName() }}</a></td>
                                        <td>{{ Carbon::parse($overtime->date_approved)->format('F j, Y - g:i:s A') }}</td>
                                        {{-- <td>
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-default-edit-{{ $overtime->id }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            <form style="display: inline-block;" action="#" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                            
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </section>

    <div class="modal fade" id="modal-default-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">File Leave</h4>
            </div>
            <form method="POST" action="{{ action('OvertimeController@store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="leaveDate">Overtime Date</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="overtimeDate" name="overtime_date" placeholder="mm/dd/yyyy" class="form-control datepicker" required>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-sm-6">
                            <div class="form-group employee" id="employee-add">
                                <label for="employee-add">Employee</label>
                                <select class="form-control" id="employee-add" name="employee_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">[{{ $user->employee_id }}] {{ $user->lastNameFirst() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" id="overtime_time_in">
                                <div class="bootstrap-timepicker">

                                    <label>Time In</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="time_in">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" id="overtime_time_out">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">

                                        <label>Time Out</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" name="time_out">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                        
                                    </div>
                                    <!-- /.form group -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group remarks" id="remarks-add">
                                <label for="remarks-add">Remarks/Reason</label>
                                <textarea class="form-control" id="remarks-add" name="remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">File Overtime</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function() {
    $('#table').dataTable({
        'iDisplayLength': 100,
		'ordering': false
    });

    $('.datepicker').datepicker({
        autoclose: true
    });

    $('.timepicker').timepicker({
      showInputs: false,
      minuteStep: 5
    });
});
</script>
@endsection