@extends('layouts.master')

@section('title', 'Dashboard')

@section('styles')
<style>
.latest-attendance tr, .latest-attendance tr th {text-align: center;}
/* .latest-attendance tr td:first-child {vertical-align: middle;} */
</style>
@endsection

@section('content')
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">
				@if (Session::has('message'))
					<div class="alert alert-success alert-dismissible" style="font-size: 25px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}
					</div>
				@endif
        <div class="col-xs-12 col-sm-6">
							<!-- TIME CLOCK -->
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Time</h3>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-xs-12 col-sm-6">
										@can('time in')
										<form method="POST" action="{{ action('DashboardController@store') }}">
												@csrf
												<button class="btn btn-primary btn-block btn-lg"	{{ ($disabled) ? 'disabled' : '' }}>TIME IN</button>
										</form>
										@endcan
									</div>
									<div class="col-xs-12 col-sm-6">
										@can('time out')
										<form method="POST" action="{{ action('DashboardController@update', ['id' => Auth::user()->id]) }}">
											@method('PUT')
											@csrf
											<button class="btn btn-primary btn-block btn-lg" {{ ($disabled) ? '' : 'disabled' }}>TIME OUT</button>
										</form>
										@endcan
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<h1 class="pull-left">{{ Carbon::now()->format('F d, Y') }}</h1>
										<h1 class="display-time pull-right"></h1>
									</div>
								</div>
							</div>
						</div>
							
						</div>

						<div class="col-md-6">
							<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Attendances</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="latest-attendance table table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
										<th>Work Hours</th>
                  </tr>
                  </thead>
                  <tbody>

									@foreach($user->attendances()->latest()->limit(10)->get() as $attendance)
									<tr>

										{{-- <span style="font-size: 80%; opacity: .50;">({{ Carbon::createFromTimestamp($attendance->time_in)->format('m/d') }})</span> --}}
										
										<td style="vertical-align: middle;">{{ Carbon::createFromTimestamp($attendance->time_in)->format('F j, Y') }} </td>
										<td>{{ Carbon::createFromTimestamp($attendance->time_in)->format('g:i:s a') }}<br><span style="font-size: 80%; opacity: .50;">({{ Carbon::createFromTimestamp($attendance->time_in)->format('m/d') }})</span></td>
										<td>{{ empty($attendance->time_out) ? '' : Carbon::createFromTimestamp($attendance->time_out)->format('g:i:s a') }} <br><span style="font-size: 80%; opacity: .50;">{{ empty($attendance->time_out) ? '' : '(' . Carbon::createFromTimestamp($attendance->time_out)->format('m/d') . ')' }}</span></td>
										<td style="vertical-align: middle;">{{ empty($attendance->time_out) ? '' : App\Dtr::timeDiff($attendance->time_out, $attendance->time_in) }}</td>

									</tr>
									@endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="/daily-time-records" class="btn btn-sm btn-default btn-flat pull-left">View All Attendances</a>
            </div>
            <!-- /.box-footer -->
          </div>
						</div>

      </section>
      <!-- /.content -->
  </div>
@endsection