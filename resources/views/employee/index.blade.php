@extends('layouts.master')

@section('title', 'Employees')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style>
.data-list th { 
    vertical-align: middle !important;
}

.data-list td { 
    font-size:14px; 
    padding:5px; 
    vertical-align:middle !important; 
}

.profile-image {
    padding:0 !important;
}

.profile-image img {
    width:40px;
}

.data-row-options-cell{
    width:170px;
}

form h5 {
    margin-top:0;
    padding:10px;
    background:#eee;
    overflow:hidden;
}

.permanent-address {
    display: none;
}
</style>
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>Employees</h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Employee List</h3>
                <div class="box-tools pull-right">
                    <a href="/employees/create" class="btn btn-success btn-sm"><i class="fa fa-plus mr05"></i> ADD EMPLOYEE</a>
                </div>
            </div>
            <div class="box-body">
                <table id="employeeTable" class="table table-bordered table-hover table-striped data-list sortable" role="grid">
                    <tbody>
                        <tr>
                            <th></th>
                            <th class="text-center" style="width:100px;">Employee ID</th>
                            <th>Full Name</th>
                            <th style="width:150px;">Workshift</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Team</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th></th>
                        </tr>
                        @foreach($employees as $employee)
                            <tr id="e3" data-id="3">
                            <td class="profile-image"><img alt="{{ $employee->name }}" src="{{ ($employee->getGender() == "Male") ? asset('dist/img/default-male.png') : asset('dist/img/default-female.png') }}"></td>
                            <td class="text-center"><a title="Lao, Kennt Gilbert Garcia" href="{{ url()->current() }}employee-profile">{{ $employee->employee_id }}</a></td>
                            <td><a title="Lao, Kennt Gilbert Garcia" href="{{ url()->current() }}employee-profile">{{ $employee->name }}</a></td>
                            <td><span title="Morning Monday-Friday 6AM-3PM Sat-Sun Restday">-</span></td>
                            <td>{{ $employee->getGender() }}</td>
                            <td>{{ $employee->getPosition() }}</td>
                            <td>{{ $employee->getTeam() }}</td>
                            <td>{{ $employee->getDepartment() }}</td>
                            <td>-</td>
                            <td><small class="text-green">-</small></td>
                            <td>{{ ($employee->last_login == NULL) ? '-'  : $employee->last_login }}</td>
                            <td class="data-row-options-cell">
                                <a href="#" class="btn btn-primary btn-xs mr05" title="View Profile"><i class="fa fa-user"></i></a>
                                <a href="#" class="btn btn-success mr05 btn-xs" title="Edit Employee"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-warning mr05 btn-xs" title="Time Records"><i class="fa fa-clock-o"></i></a>
                                <a href="#" class="btn btn-info mr05 btn-xs" title="Workshifts"><i class="fa fa-calendar"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div>

    </section>
				<!-- /.content -->
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
@endsection