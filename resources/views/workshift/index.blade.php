@extends('layouts.master')

@section('title', 'Workshifts')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

	<section class="content-header">
		<h1>Workshifts</h1>
	</section>

				<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">
					Workshift Schedule</h3>
				<div class="box-tools pull-right">
					<a href="workshifts/create" class="btn btn-success btn-sm"><i class="fa fa-plus mr05"></i> ADD WORKSHIFT</a>
				</div>
			</div>
			<!-- /.box-header -->
		<div class="box-body">
			<div class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-6">
						<div class="dataTables_filter search-bar">
							<label>Search:
								<input type="search" class="form-control w200 input-sm search-field" placeholder="Workshift Code or Name" value="">
							</label>
							<input class="btn btn-primary btn-sm btn-search mr05" style="margin-top:-2px;" type="submit" value="Search">
							<button class="btn btn-default btn-sm btn-clear-search" style="margin-top:-2px;">Clear</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="dataTables_paginate paging_simple_numbers">
							<ul class="pagination">
								<li class="paginate_button previous disabled" id="invoice-list_previous"><a href="#" class="pagination-disabled">Previous</a></li>
								<li class="paginate_button active"><a href="/workshift?p=1">1</a></li>
								<li class="paginate_button next disabled" id="invoice-list_next"><a href="#" class="pagination-disabled">Next</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table" class="table table-bordered table-striped" role="grid">
							<tbody>
								<tr>
									<th></th>
									<th>Code</th>
									<th>Name</th>
									<th>Monday</th>
									<th>Tuesday</th>
									<th>Wednesday</th>
									<th>Thursday</th>
									<th>Friday</th>
									<th>Saturday</th>
									<th>Sunday</th>
									<th>Remarks</th>
									<th style="width:34px;"></th>
								</tr>
								@foreach($workshifts as $key => $workshift)
									<tr id="w2" data-id="2">
										<td>{{ ++$key }}</td>
										<td><a title="{{ $workshift->code }}" href="#">{{ $workshift->code }}</a></td>
										<td><a title="{{ $workshift->name }}" href="#"">{{ $workshift->name }}</a></td>

										@if($workshift->monday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getMondayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getMondayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getMondayWorkHours() }}</span>
											</td>
										@endif

										@if($workshift->tuesday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getTuesdayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getTuesdayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getTuesdayWorkHours() }}</span>
											</td>
										@endif

										@if($workshift->wednesday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getWednesdayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getWednesdayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getWednesdayWorkHours() }}</span>
											</td>
										@endif

										@if($workshift->thursday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getThursdayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getThursdayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getThursdayWorkHours() }}</span>
											</td>
										@endif

										@if($workshift->friday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getFridayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getFridayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getFridayWorkHours() }}</span>
											</td>
										@endif

										@if($workshift->saturday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getSaturdayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getSaturdayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getSaturdayWorkHours() }}</span>
											</td>
										@endif

										@if($workshift->sunday_workshift == 'RD')
											<td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td>
										@else
											<td>
												<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getSundayTimeIn()) . ' - ' . App\Workshift::regularTime($workshift->getSundayTimeOut()) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getSundayWorkHours() }}</span>
											</td>
										@endif
										
										<td></td>
										<td class="data-row-options-cell">
											<div class="inner" style="width:61px;">
												<a href="#" class="btn btn-primary btn-xs mr05" title="View Workshift Info"	target="_blank"><i class="fa fa-clock-o"></i></a>
												<a href="/workshifts/{{ $workshift->id }}/edit" class="btn btn-success btn-xs" title="Edit Workshift"><i class="fa fa-pencil"></i></a>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						Showing 1 to 4 out of 4 results. </div>
					<div class="col-sm-6">
						<div class="dataTables_paginate paging_simple_numbers">
							<ul class="pagination">
								<li class="paginate_button previous disabled" id="invoice-list_previous"><a href="#" class="pagination-disabled">Previous</a></li>
								<li class="paginate_button active"><a href="/workshift?p=1">1</a></li>
								<li class="paginate_button next disabled" id="invoice-list_next"><a href="#" class="pagination-disabled">Next</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- /.box-body -->
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
<script>
    $('div.alert').delay(3000).fadeOut(300);
</script>
@endsection