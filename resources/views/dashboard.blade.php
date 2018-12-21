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
					<div class="alert alert-success alert-dismissible">{{ Session::get('message') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
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
										<form method="POST" action="{{ action('HomeController@store') }}">
											@csrf
											<button onclick="return confirm('Are you sure you want to Time In?');" class="btn btn-primary btn-block btn-lg" {{ ($disabled) ? 'disabled' : '' }}>TIME IN</button>
										</form>
									</div>
									<div class="col-xs-12 col-sm-6">
										<form method="POST" action="{{ action('HomeController@update', ['id' => Auth::user()->id]) }}">
											@method('PUT')
											@csrf
											<button onclick="return confirm('Are you sure you want to Time Out?');" class="btn btn-primary btn-block btn-lg" {{ ($disabled) ? '' : 'disabled' }}>TIME OUT</button>
										</form>
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