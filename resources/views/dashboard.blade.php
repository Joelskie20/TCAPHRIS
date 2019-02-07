@extends('layouts.master')

@section('title', 'Dashboard')

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

      </section>
      <!-- /.content -->
  </div>
@endsection