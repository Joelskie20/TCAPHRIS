@extends('layouts.master')

@section('title', 'Employee ' . $employee->employee_id)

@section('styles')
<style>
.box-options {
    float: right;
}
/* OVERRIDES */
.list-group-item{padding:5px 15px;}

/* TABLE DATA */
.profile-image img{margin:-5px;width:46px;}
table.data-list small.icon{display:inline-block;width:12px;text-align:center;}
table tr.rest-day{background:#98fb98 !important;}

/* FORM */
.permanent-address{display:none;}

/* PROFILE */
.employee-profile .tab-pane table tr th:first-child{width:150px;}
.employee-profile .tab-pane table tr th,.employee-profile .tab-pane table tr td{font-size:14px;}
.nav-tabs-custom>.nav-tabs>li{margin-right:0;}
.btn-profile{margin-top:10px;}
.actual-salary.hide{display:none;}
@media screen and (max-width:480px) {
	.employee-profile .tab-pane table tr th,.employee-profile .tab-pane table tr td{display:block;width:100% !important;border:0 !important;border-bottom:1px solid #f4f4f4 !important;}
	.employee-profile .tab-pane table tr:last-child td{border-bottom:0 !important;}
}
@media screen and (max-width:425px) {
	.nav-tabs-custom>.nav-tabs>li>a{padding:9px;}
}
@media screen and (max-width:375px) {
	.nav-tabs-custom>.nav-tabs>li>a{padding:6px;font-size:12px;}
}
</style>
@endsection

@section('content')
<div class="content-wrapper employee-profile">
			
			<section class="content-header">
				<h1>201 File &raquo; [{{ $employee->employee_id }}] {{ $employee->firstAndLastName() }}</h1>
				<ol class="breadcrumb">
					<li><a href="/employees"><i class="fa fa-users"></i>Employee Records</a></li>
					<li class="active">{{ $employee->firstAndLastName() }}</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">

				<div class="row">
					
					<!-- leftcol -->
					<div class="col-md-4">

						<!-- Main Profile -->
						<div class="box box-primary">
							<div class="box-body box-profile">
								<img class="profile-user-img img-responsive img-circle" src="{{ ($employee->getGender() == "Male") ? asset('dist/img/default-male.png') : asset('dist/img/default-female.png') }}" alt="{{ $employee->firstAndLastName() }}">
								<h3 class="profile-username text-center">{{ $employee->firstAndLastName() }}</h3>
								<p class="text-muted text-center">{{ $employee->getPosition() }}</p>
								<ul class="list-group list-group-unbordered">
									<li class="list-group-item">
										<b>Employee ID</b> <a class="pull-right">{{ $employee->employee_id }}</a>
									</li>
									<li class="list-group-item">
										<b>Division</b> <a class="pull-right">{{ $employee->getDivision() }}</a>
									</li>
									<li class="list-group-item">
										<b>Team</b> <a class="pull-right">{{ $employee->getTeam() }}</a>
									</li>
									<li class="list-group-item">
										<b>Account Status</b>
										<a class="pull-right text-{{ $employee->getStatus() == 'Deactivated' ? 'danger' : 'success' }}">{{ $employee->getStatus() }}</a>
									</li>
								</ul>

								<div class="row">
									<div class="col-sm-6">
										<a href="/employees/{{ $employee->id }}/edit" class="btn btn-success btn-block btn-profile"><i
												class="fa fa-pencil"></i> Edit</a>
									</div>
									<div class="col-sm-6">
										<a href="/daily-time-records/{{ $employee->id }}" class="btn btn-warning btn-block btn-profile"><i class="fa fa-clock-o"></i> Employee Time Records</a>
									</div>
								</div>

							</div>
						</div>

						<!-- Summary Info -->
						<div class="box box-info">
							<div class="box-body">
								<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
								<p class="text-muted">To Follow</p>
							</div>
						</div>

					</div><!-- /.leftcol -->
					
					<!-- rightcol -->
					<div class="col-md-8">
						
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Employee Overview</h3>
								<div class="box-options">
									<div class="btn-group">
										<button type="button" class="btn btn-default btn-flat selected-tab" style="width:220px;height:30px;padding:3px 10px;text-align:left;text-transform:capitalize;">Employee Overview</button>
										<button type="button" class="btn btn-default btn-flat dropdown-toggle" style="height:30px;padding:3px 10px;" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu select-tab" role="menu" style="top:25px;">
											<li><a href="#tab1">Employee Overview</a></li>
											<li><a href="#tab2">Personal &amp; Contact Information</a></li>
											<li><a href="#tab3">Employee &amp; Government Details</a></li>
											<li><a href="#tab4">Attendance &amp; Leaves</a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="tab-content">
									<div class="active tab-pane" id="tab1">
										
										<h4>Employee Overview</h4>
										<table class="table table-bordered table-hover table-striped">
											<tbody>
												<tr>
													<th>Last Login</th>
													<td>{{ Carbon::parse($employee->last_login)->format('F d, Y - h:i:s a') }}</td>
												</tr>
											</tbody>
										</table>
										
										<h4>Current Workshift</h4>
										<table class="table table-bordered table-hover table-striped">
											<tbody>
												<tr>
													<th>Code</th>
													<td>{{ $employee->getWorkshiftCode() }}</td>
												</tr>
												<tr>
													<th>Name</th>
													<td>{{ $employee->getWorkshiftName() }}</td>
												</tr>
												<tr>
												<th>Workshift</th>
												@foreach(config('app.day_workshift') as $day)
												<td>
													<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
														{{ App\Workshift::regularTime($employee->workshift->getWorkshiftInfo($day)['timein']) . ' - ' . App\Workshift::regularTime($employee->workshift->getWorkshiftInfo($day)['timeout']) }}
													</span>
													<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getWorkshiftInfo($day)['workhours'] }}</span>
													@if(strpos($employee->workshift->$day,'RD') > -1)
														<br><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span>
													@endif
												</td>
												@endforeach
												</tr>
												{{-- <tr>
													<th>Tuesday</th>
													@if ($employee->workshift->tuesday_workshift == 'RD')
														<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
													@else
														<td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> {{ App\Workshift::regularTime($employee->workshift->getTuesdayTimeIn()) }} - {{ App\Workshift::regularTime($employee->workshift->getTuesdayTimeOut()) }}</span> &nbsp; <span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getTuesdayWorkHours() }}</span></td>
													@endif
												</tr>
												<tr>
													<th>Wednesday</th>
													@if ($employee->workshift->wednesday_workshift == 'RD')
														<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
													@else
														<td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> {{ App\Workshift::regularTime($employee->workshift->getWednesdayTimeIn()) }} - {{ App\Workshift::regularTime($employee->workshift->getWednesdayTimeOut()) }}</span> &nbsp; <span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getWednesdayWorkHours() }}</span></td>
													@endif
												</tr>
												<tr>
													<th>Thursday</th>
													@if ($employee->workshift->thursday_workshift == 'RD')
														<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
													@else
														<td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> {{ App\Workshift::regularTime($employee->workshift->getThursdayTimeIn()) }} - {{ App\Workshift::regularTime($employee->workshift->getThursdayTimeOut()) }}</span> &nbsp; <span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getThursdayWorkHours() }}</span></td>
													@endif
												</tr>
												<tr>
													<th>Friday</th>
													@if ($employee->workshift->friday_workshift == 'RD')
														<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
													@else
														<td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> {{ App\Workshift::regularTime($employee->workshift->getFridayTimeIn()) }} - {{ App\Workshift::regularTime($employee->workshift->getFridayTimeOut()) }}</span> &nbsp; <span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getFridayWorkHours() }}</span></td>
													@endif
												</tr>
												<tr>
													<th>Saturday</th>
													@if ($employee->workshift->saturday_workshift == 'RD')
														<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
													@else
														<td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> {{ App\Workshift::regularTime($employee->workshift->getSaturdayTimeIn()) }} - {{ App\Workshift::regularTime($employee->workshift->getSaturdayTimeOut()) }}</span> &nbsp; <span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getSaturdayWorkHours() }}</span></td>
													@endif
												</tr>
												<tr>
													<th>Sunday</th>
													@if ($employee->workshift->sunday_workshift == 'RD')
														<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
													@else
														<td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> {{ App\Workshift::regularTime($employee->workshift->getSundayTimeIn()) }} - {{ App\Workshift::regularTime($employee->workshift->getSundayTimeOut()) }}</span> &nbsp; <span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $employee->workshift->getSundayWorkHours() }}</span></td>
													@endif
												</tr> --}}
											</tbody>
										</table>
										
										<h4>Workshift Schedules
											{{-- <a href="#" class="btn btn-info btn-xs pull-right">MANAGE WORKSHIFT</a> --}}
										</h4>
										@if ($employee->workshiftSchedules->count() > 0)
										<table class="table table-bordered table-hover table-striped">
											<thead>
												<tr>
													<th>Effectivity Date</th>
													<th>Code</th>
													<th>Workshift</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>{{ Carbon::parse($employee->workshiftSchedules->first()->date_from)->format('F j, Y') }} - {{ Carbon::parse($employee->workshiftSchedules->first()->date_to)->format('F j, Y') }}</td>
													<td>{{ $employee->workshift->code }}</td>
													<td>{{ $employee->workshift->name }}</td>
												</tr>
												<tr>
													<td colspan="3"></td>
												</tr>
											</tbody>
										</table>
										@else
										<p class="text-muted">None</p>
										@endif
										
									</div>
	
									<!-- PERSONAL INFORMATION -->
									<div class="tab-pane" id="tab2">
										
										<h4>Personal Information</h4>
										<table class="table table-bordered table-hover table-striped">
											<tbody>
												<tr>
													<th>Full Name</th>
													<td {{ str_contains($employee->lastNameFirst(), 'Unassigned') ? 'class=apply-opacity' : '' }}>{{ $employee->lastNameFirst() }}</td>
												</tr>
												<tr>
													<th>Birth Date</th>
													<td>{{ date('m/d/Y', strtotime($employee->birth_date)) }}</td>
												</tr>
												<tr>
													<th>Gender</th>
													<td>{{ $employee->getGender() }}</td>
												</tr>
												<tr>
													<th>Nationality</th>
													<td {{ $employee->nationality == NULL ? 'class=apply-opacity' : '' }}>{{ $employee->nationality == NULL ? 'Unassigned' : $employee->nationality }}</td>
												</tr>
												<tr>
													<th>Religion</th>
													<td {{ $employee->religion == NULL ? 'class=apply-opacity' : '' }}>{{ $employee->religion == NULL ? 'Unassigned' : $employee->religion }}</td>
												</tr>
											</tbody>
										</table>
										
										<h4>Contact Details</h4>
										<table class="table table-bordered table-hover table-striped">
											<tbody>
												<tr>
													<th>Present Address</th>
													<td>-</td>
												</tr>
												<tr>
													<th>Permanent Address</th>
													<td>-</td>
												</tr>
												<tr>
													<th>Email</th>
													<td {{ $employee->email == NULL ? 'class=apply-opacity' : '' }}>{{ $employee->email == NULL ? 'Unassigned' : $employee->email }}</td>
												</tr>
												<tr>
													<th>Mobile</th>
													<td {{ $employee->mobile_number == NULL ? 'class=apply-opacity' : '' }}>{{ $employee->mobile_number == NULL ? 'Unassigned' : $employee->mobile_number }}</td>
												</tr>
												<tr>
													<th>Landline</th>
													<td {{ $employee->landline == NULL ? 'class=apply-opacity' : '' }}>{{ $employee->landline == NULL ? 'Unassigned' : $employee->landline }}</td>
												</tr>
											</tbody>
										</table>
										
									</div>
	
									<!-- EMPLOYEE DETAILS -->
									<div class="tab-pane" id="tab3">
										
										<h4>Employee Details</h4>
										<table class="table table-bordered table-hover table-striped">
											<tbody>
												<tr>
													<th>Employee ID</th>
													<td {{ $employee->employee_id == NULL ? 'class=apply-opacity' : '' }}>{{ empty($employee->employee_id) ? 'Unassigned' : $employee->employee_id }}</td>
												</tr>
												<tr>
													<th>Position</th>
													<td {{ str_contains($employee->getPosition(), 'Unassigned') ? 'class=apply-opacity' : '' }}>{{ $employee->getPosition() }}</td>
												</tr>
												<tr>
													<th>Division</th>
													<td {{ str_contains($employee->getDivision(), 'Unassigned') ? 'class=apply-opacity' : '' }}>{{ $employee->getDivision() }}</td>
												</tr>
												<tr>
													<th>Team</th>
													<td {{ str_contains($employee->getTeam(), 'Unassigned') ? 'class=apply-opacity' : '' }}>{{ $employee->getTeam() }}</td>
												</tr>
												<tr>
													<th>Account</th>
													<td {{ str_contains($employee->getAccount(), 'Unassigned') ? 'class=apply-opacity' : '' }}>{{ $employee->getAccount() }}</td>
												</tr>
												<tr>
													<th>Job Code</th>
													<td {{ str_contains($employee->getJobCode(), 'Unassigned') ? 'class=apply-opacity' : '' }}><span title="{{ str_contains($employee->getJobCode(), 'Unassigned') ? 'Unassigned' : $employee->getJobCodeName() }}">{{ $employee->getJobCode() }}</span></td>
												</tr>
												<tr>
													<th>Direct Managers</th>
													<td>
														@foreach($employee->managers() as $manager)
															@if(! empty($manager))
																<a href="/employee/{{ $manager->id }}" target="_blank">{{ $manager->firstAndLastName() }}</a><br>
															@else
																{{ '' }}
															@endif
														@endforeach
													</td>
												</tr>
												<tr>
													<th>Hire Date</th>
													<td>{{ date('m/d/Y', strtotime($employee->hire_date)) }}</td>
												</tr>
												<tr>
													<th>Base Salary</th>
													<td><span class="actual-salary hide mr05">P {{ number_format($employee->base_salary, 2,'.',',') }}</span> <button class="btn btn-default btn-xs btn-view-salary">View Salary</button></td>
												</tr>
												<tr>
													<th>Payment Frequency</th>
													<td>{{ ucwords($employee->payment_frequency) }}</td>
												</tr>
												<tr>
													<th>Tax Status</th>
													<td>{{ ucwords($employee->tax_status) }}</td>
												</tr>
											</tbody>
										</table>
										
										<h4>Government Details</h4>
										<table class="table table-bordered table-hover table-striped">
											<tbody>
												<tr>
													<th>TIN</th>
													<td>{{ $employee->tin_number }}</td>
												</tr>
												<tr>
													<th>SSS</th>
													<td>{{ $employee->sss_number }}</td>
												</tr>
												<tr>
													<th>PhilHealth</th>
													<td>{{ $employee->philhealth_number }}</td>
												</tr>
												<tr>
													<th>Pag-Ibig</th>
													<td>{{ $employee->pagibig_number }}</td>
												</tr>
											</tbody>
										</table>
										
									</div>
	
									<div class="tab-pane" id="tab4">
										<h4>Attendance &amp; Leaves</h4>
									</div>
	
								</div>
							</div>
						</div>
						
					</div><!-- /.rightcol -->
				
				</div>

			</section><!-- /.content -->
			
		</div>
@endsection

@section('scripts')
<script>
$(function() {
    
    $('.select-tab li a').click(function(e) {
        e.preventDefault();
        var selected_section = $(this).text();
        $('.box-title').html(selected_section);
        $('.selected-tab').html(selected_section);
        $('.tab-content .tab-pane').removeClass('active');
        var selected_tab = $(this).attr('href');
        $(selected_tab).addClass('active');
    });
    
    $('.btn-view-salary').click(function() {
        var actual_salary = $('.actual-salary');
        if(actual_salary.hasClass('hide')) {
            actual_salary.removeClass('hide');
            $(this).remove();
        } else {
            actual_salary.addClass('hide');
        }
    });
    
});
</script>
@endsection