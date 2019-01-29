@extends('layouts.master')

@section('title', 'Approved Leaves')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header" style="overflow: hidden">
        <h1 class="pull-left">Approved Leaves</h1>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title pull-left">Leaves Table</h3>
                @can('add leave')
                <div class="box-options pull-right">
                    <button type="button" class="btn btn-success btn-sm btn-add-leave pull-right" data-toggle="modal" data-target="#modal-default-add"><i class="fa fa-plus mr05"></i> ADD LEAVE</button>
                </div>
                @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Filed By</th>
                                        <th>Leave Date</th>
                                        <th>Leave Type</th>
                                        <th>Day Count</th>
                                        <th>Filing Date</th>
                                        <th>Approved By</th>
                                        <th>Date Approved</th>
                                        {{-- <th>Remarks</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leaves as $key => $leave)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><a href="/employee/{{ $leave->user->id }}">{{ $leave->user->firstNameFirst() }}</a></td>
                                        <td>{{ Carbon::parse($leave->leave_date)->format('F d, Y') }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ $leave->day_count }}</td>
                                        <td>{{ Carbon::parse($leave->filing_date)->format('F d, Y - g:i:s A') }}</td>
                                        <td {{ $leave->user->getManagerName() == 'Unassigned' ? 'class=apply-opacity' : '' }}>
                                            @if($leave->user->getManagerName() == 'Unassigned')
                                                {{ 'Unassigned' }}
                                            @else
                                                <a href="/employee/{{ $leave->user->direct_manager_id }}">{{ $leave->user->getManagerName() }}</a>
                                            @endif
                                        </td>
                                        <td>{{ Carbon::parse($leave->date_approved)->format('F d, Y - g:i:s A') }}</td>
                                        {{-- <td>{{ $leave->approved_remarks }}</td> --}}
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

</div>

<div class="modal fade" id="modal-default-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">File Leave</h4>
            </div>
            <form method="POST" action="{{ action('LeaveController@store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="leaveDate">Leave Date</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="leaveDate" name="leave_date" placeholder="mm/dd/yyyy" class="form-control datepicker" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group employee" id="employee-add">
                                <label for="employee-add">Employee</label>
                                <select class="form-control" id="employee-add" name="employee_id">
                                    @foreach($users as $user) 
                                        <option value="{{ $user->id }}">[{{ $user->employee_id }}] {{ $user->firstNameFirst() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group leave-type" id="leave-type-add">
                                <label for="leave-type-add">Leave Type</label>
                                <select class="form-control" id="leave-type-add" name="leave_type">
                                    <option value="Vacation Leave">Vacation Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Birthday Leave">Birthday Leave</option>
                                    <option value="Emergency Leave">Emergency Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                    <option value="Paternity Leave">Paternity Leave</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group leave-schedule" id="leave-schedule-add">
                                <label for="leave-schedule-add">Leave Schedule</label>
                                <select class="form-control" id="leave-schedule-add" name="day_count">
                                    <option value="Whole Day">Whole Day</option>
                                    <option value="1st Half">1st Half</option>
                                    <option value="2nd Half">2nd Half</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group remarks" id="remarks-add">
                                <label for="remarks-add">Remarks/Reason</label>
                                <textarea class="form-control" id="remarks-add" name="approval_remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">File Leave</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
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
});
</script>
@endsection