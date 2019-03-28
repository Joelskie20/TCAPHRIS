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
		@if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">
					Workshift Schedule</h3>
				<div class="box-tools pull-right">
					@can('add workshift')
					<a href="workshifts/create" class="btn btn-success btn-sm"><i class="fa fa-plus mr05"></i> ADD WORKSHIFT</a>
					@endcan
				</div>
			</div>
			<!-- /.box-header -->
		<div class="box-body">
			<div class="form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-6">
						{{-- <div class="dataTables_filter search-bar">
							<label>Search:
								<input type="search" class="form-control w200 input-sm search-field" placeholder="Workshift Code or Name" value="">
							</label>
							<input class="btn btn-primary btn-sm btn-search mr05" style="margin-top:-2px;" type="submit" value="Search">
							<button class="btn btn-default btn-sm btn-clear-search" style="margin-top:-2px;">Clear</button>
						</div> --}}
					</div>
					{{-- <div class="col-sm-6">
						<div class="dataTables_paginate paging_simple_numbers">
							<ul class="pagination">
								<li class="paginate_button previous disabled" id="invoice-list_previous"><a href="#" class="pagination-disabled">Previous</a></li>
								<li class="paginate_button active"><a href="/workshift?p=1">1</a></li>
								<li class="paginate_button next disabled" id="invoice-list_next"><a href="#" class="pagination-disabled">Next</a></li>
							</ul>
						</div>
					</div> --}}
				</div>
				<div class="row">
					<div class="col-xs-12 table-responsive">
						<table id="table" class="table table-bordered table-striped">
						<thead>
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
								{{-- <th>Remarks</th> --}}
								<th style="width:34px;">Actions</th>
							</tr>
						</thead>
							<tbody>
								{{-- @php
								$day_arr = array('monday_workshift','tuesday_workshift','wednesday_workshift','thursday_workshift','friday_workshift','saturday_workshift','sunday_workshift');	
								@endphp --}}
								@foreach($workshifts as $key => $workshift)
									<tr id="w2" data-id="2">
										<td>{{ ++$key }}</td>
										<td><a title="{{ $workshift->code }}" href="/workshifts/{{ $workshift->id }}/edit">{{ $workshift->code }}</a></td>
										<td><a title="{{ $workshift->name }}" href="/workshifts/{{ $workshift->id }}/edit"">{{ $workshift->name }}</a></td>

										@foreach(config('app.day_workshift') as $day)
										<td>
											<span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 
													{{ App\Workshift::regularTime($workshift->getWorkshiftInfo($day)['timein']) . ' - ' . App\Workshift::regularTime($workshift->getWorkshiftInfo($day)['timeout']) }}
												</span>
												<br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> {{ $workshift->getWorkshiftInfo($day)['workhours'] }}</span>
											@if(strpos($workshift->$day,'RD') > -1)
												<br><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span>
											@endif
										</td>
										@endforeach
										
										{{-- <td></td> --}}
										<td class="data-row-options-cell">
											<div class="inner" style="width:75px;">
												@can('edit workshift')
												<a href="/workshifts/{{ $workshift->id }}/edit" class="btn btn-success btn-xs" title="Edit Workshift"><i class="fa fa-pencil"></i></a>
												@endcan

												@can('delete workshift')
												<form style="display: inline-block;" action="/workshifts/{{ $workshift->id }}" method="POST">
													@method('DELETE')
													@csrf
													<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete">
														<i class="fa fa-trash-o"></i>
													</button>
                                				</form>
												@endcan
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					{{-- <div class="col-sm-6">
						Showing 1 to 4 out of 4 results. 
					</div> --}}
					{{-- <div class="col-sm-6">
						<div class="dataTables_paginate paging_simple_numbers">
							<ul class="pagination">
								<li class="paginate_button previous disabled" id="invoice-list_previous"><a href="#" class="pagination-disabled">Previous</a></li>
								<li class="paginate_button active"><a href="/workshift?p=1">1</a></li>
								<li class="paginate_button next disabled" id="invoice-list_next"><a href="#" class="pagination-disabled">Next</a></li>
							</ul>
						</div>
					</div> --}}
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
        'iDisplayLength': 100,
		'ordering': false
    });
});
</script>
@endsection