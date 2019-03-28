@extends('layouts.master')

@section('title', 'Workshift Assignment')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>Workshift Assignment</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ action('WorkshiftController@assignmentStore') }}" method="POST" class="box box-info">
            @csrf
            <div class="box-header with-border">
                <h3 class="box-title">Assign Workshift</h3>
                <a href="/workshift-assignment/calendar" class="btn btn-success pull-right">Calendar View</a>
            </div>
            <div class="box-body">
                <div class="col-lg-6">
                    <div class="row">

                        <!-- DATE RANGE -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Workshift Range</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="workshift-sched-range" name="workshift_schedule_range">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                        <!-- WORKSHIFT -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="workshift">Workshift</label>
                                <select class="form-control" id="workshift" name="workshift_id" >
                                @foreach($workshifts as $workshift)
                                    <option value="{{ $workshift->id }}">[{{ $workshift->code }}] {{ $workshift->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- LEVEL -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="workshift">Level</label>
                                <select class="form-control" id="level" name="level_id" >
                                    <option value="1">Division</option>
                                    <option value="2">Team</option>
                                    <option value="3">Account</option>
                                    <option value="4">Employee</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">

                        <!-- DIVISION -->
                        <div class="col-md-12" id="division">
                            <div class="form-group">
                                <label for="divisionID">Division</label>
                                <select class="form-control" id="divisionID" name="division_id" >
                                    <option value="0">-- None --</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach								
                                </select>
                            </div>
                        </div>

                        <!-- TEAM -->
                        <div class="col-md-12" style="display: none;" id="team">
                            <div class="form-group">
                                <label for="teamID">Team</label>
                                <select class="form-control" id="teamID" name="team_id" >
                                    <option value="0" class="opt-none">-- None --</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- ACCCOUNT -->
                        <div class="col-md-12" style="display: none;" id="account">
                            <div class="form-group">
                                <label for="teamID">Account</label>
                                <select class="form-control" id="teamID" name="account_id" >
                                    <option value="0" class="opt-none">-- None --</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- EMPLOYEE -->
                        <div class="col-md-12" style="display: none;" id="employee">
                            <div class="form-group employee">
                                <label for="employee-add">Employee</label>
                                <div class="form-group">
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select Employee" style="width: 100%;" name="employee_id[]">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">[{{ $user->employee_id }}] {{ $user->firstNameFirst() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <button type="submit" class="btn btn-success">Apply</button>
                    <a href="/workshift-assignment" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
$("#workshift-sched-range").daterangepicker();

$('.select2').select2();

$('#level').change( function() {
    if ($(this).val() == 2) {
        $('#team').css('display', 'block');
        $('#account').css('display', 'none');
        $('#account > select').prop('disabled', true);
    $('#employee').css('display', 'none');
    } else if ( $(this).val() == 3 ) {
        $('#division').css('display', 'block');
        $('#team').css('display', 'block');
        $('#account').css('display', 'block');
        $('#employee').css('display', 'none');
    } else if ( $(this).val() == 4 ) {
        $('#division').css('display', 'none');
        $('#team').css('display', 'none');
        $('#account').css('display', 'none');
        $('#employee').css('display', 'block');
    } else {
        $('#division').css('display', 'block');
        $('#team').css('display', 'none');
        $('#account').css('display', 'none');
        $('#employee').css('display', 'none');
    }
});
</script>
@endsection
