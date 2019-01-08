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
                        <tr id="e3" data-id="3">
                            <td class="profile-image"><img alt="Lao, Kennt Gilbert Garcia" src="{{ asset('dist/img/default-male.png') }}"></td>
                            <td class="text-center"><a title="Lao, Kennt Gilbert Garcia" href="{{ url()->current() }}employee-profile">20180003</a></td>
                            <td><a title="Lao, Kennt Gilbert Garcia" href="{{ url()->current() }}employee-profile">Lao, Kennt Gilbert Garcia</a></td>
                            <td><span title="Morning Monday-Friday 6AM-3PM Sat-Sun Restday">MRG-MF-6A3P-SSR</span></td>
                            <td>Male</td>
                            <td>Developer</td>
                            <td>Web Integration</td>
                            <td>Digital Marketing</td>
                            <td>San Jose del Monte, Bulacan</td>
                            <td><small class="text-green">ACTIVE</small></td>
                            <td>9/23/2018<br>9:52:02 PM</td>
                            <td class="data-row-options-cell">
                                <a href="{{ url()->current() }}employee-profile" class="btn btn-primary btn-xs mr05" title="View Profile"><i class="fa fa-user"></i></a>
                                <a href="{{ url()->current() }}edit-employee/3" class="btn btn-success mr05 btn-xs" title="Edit Employee"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url()->current() }}employee-time-records/3/201811" class="btn btn-warning mr05 btn-xs" title="Time Records"><i class="fa fa-clock-o"></i></a>
                                <a href="{{ url()->current() }}employee-workshifts/3" class="btn btn-info mr05 btn-xs" title="Workshifts"><i class="fa fa-calendar"></i></a>
                                <a href="{{ url()->current() }}employee-base-salary/3" class="btn btn-success mr05 btn-xs" title="Base Salary"><i class="fa fa-money"></i></a>
                            </td>
                        </tr>
                        <tr id="e4" data-id="4">
                            <td class="profile-image"><img alt="Nicolas, Ian Gutierez" src="{{ asset('dist/img/default-male.png') }}"></td>
                            <td class="text-center"><a title="Nicolas, Ian Gutierez" href="{{ url()->current() }}employee-profile">20180004</a></td>
                            <td><a title="Nicolas, Ian Gutierez" href="{{ url()->current() }}employee-profile">Nicolas, Ian Gutierez</a></td>
                            <td><span title="Regular Monday-Friday 8AM-5PM Sat-Sun Restday">REG-MF-8A5P-SSR</span></td>
                            <td>Male</td>
                            <td>Developer</td>
                            <td>Web Integration</td>
                            <td>Digital Marketing</td>
                            <td>Mandaluyong City, Metro Manila</td>
                            <td><small class="text-green">ACTIVE</small></td>
                            <td>9/21/2018
                                <br>8:58:14 PM</td>
                            <td class="data-row-options-cell">
                                <a href="{{ url()->current() }}employee-profile" class="btn btn-primary btn-xs mr05" title="View Profile"><i class="fa fa-user"></i></a>
                                <a href="{{ url()->current() }}edit-employee/3" class="btn btn-success mr05 btn-xs" title="Edit Employee"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url()->current() }}employee-time-records/3/201811" class="btn btn-warning mr05 btn-xs" title="Time Records"><i class="fa fa-clock-o"></i></a>
                                <a href="{{ url()->current() }}employee-workshifts/3" class="btn btn-info mr05 btn-xs" title="Workshifts"><i class="fa fa-calendar"></i></a>
                                <a href="{{ url()->current() }}employee-base-salary/3" class="btn btn-success mr05 btn-xs" title="Base Salary"><i class="fa fa-money"></i></a>
                            </td>
                        </tr>
                        <tr id="e1" data-id="1">
                            <td class="profile-image"><img alt="Reyes, Ryan Michael Lao" src="{{ asset('dist/img/default-male.png') }}"></td>
                            <td class="text-center"><a title="Reyes, Ryan Michael Lao" href="{{ url()->current() }}employee-profile">20180001</a></td>
                            <td><a title="Reyes, Ryan Michael Lao" href="{{ url()->current() }}employee-profile">Reyes, Ryan Michael Lao</a></td>
                            <td><span title="Regular Monday-Friday 8AM-5PM Sat-Sun Restday">REG-MF-8A5P-SSR</span></td>
                            <td>Male</td>
                            <td>Senior Developer</td>
                            <td>Web Integration</td>
                            <td>Digital Marketing</td>
                            <td>Quezon City, Metro Manila</td>
                            <td><small class="text-green">ACTIVE</small></td>
                            <td>11/12/2018<br>3:50:42 PM</td>
                            <td class="data-row-options-cell">
                                <a href="{{ url()->current() }}employee-profile" class="btn btn-primary btn-xs mr05" title="View Profile"><i class="fa fa-user"></i></a>
                                <a href="{{ url()->current() }}edit-employee/3" class="btn btn-success mr05 btn-xs" title="Edit Employee"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url()->current() }}employee-time-records/3/201811" class="btn btn-warning mr05 btn-xs" title="Time Records"><i class="fa fa-clock-o"></i></a>
                                <a href="{{ url()->current() }}employee-workshifts/3" class="btn btn-info mr05 btn-xs" title="Workshifts"><i class="fa fa-calendar"></i></a>
                                <a href="{{ url()->current() }}employee-base-salary/3" class="btn btn-success mr05 btn-xs" title="Base Salary"><i class="fa fa-money"></i></a>
                            </td>
                        </tr>
                        <tr id="e2" data-id="2">
                            <td class="profile-image"><img alt="Rosales, Camille Jennifer Cabugao" src="{{ asset('dist/img/default-female.png') }}"></td>
                            <td class="text-center"><a title="Rosales, Camille Jennifer Cabugao" href="{{ url()->current() }}employee-profile">20180002</a></td>
                            <td><a title="Rosales, Camille Jennifer Cabugao" href="{{ url()->current() }}employee-profile">Rosales, Camille Jennifer Cabugao</a></td>
                            <td><span title="Morning Monday-Friday 6AM-3PM Sat-Sun Restday">MRG-MF-6A3P-SSR</span></td>
                            <td>Female</td>
                            <td>Communications Specialist</td>
                            <td><span class="text-gray">Unassigned</span></td>
                            <td>Human Resource</td>
                            <td>Quezon City, Metro Manila</td>
                            <td><small class="text-green">ACTIVE</small></td>
                            <td>9/21/2018<br>8:58:32 PM</td>
                            <td class="data-row-options-cell">
                                <a href="{{ url()->current() }}employee-profile" class="btn btn-primary btn-xs mr05" title="View Profile"><i class="fa fa-user"></i></a>
                                <a href="{{ url()->current() }}edit-employee/3" class="btn btn-success mr05 btn-xs" title="Edit Employee"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url()->current() }}employee-time-records/3/201811" class="btn btn-warning mr05 btn-xs" title="Time Records"><i class="fa fa-clock-o"></i></a>
                                <a href="{{ url()->current() }}employee-workshifts/3" class="btn btn-info mr05 btn-xs" title="Workshifts"><i class="fa fa-calendar"></i></a>
                                <a href="{{ url()->current() }}employee-base-salary/3" class="btn btn-success mr05 btn-xs" title="Base Salary"><i class="fa fa-money"></i></a>
                            </td>
                        </tr>
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