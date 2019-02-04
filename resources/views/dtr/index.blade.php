@extends('layouts.master')

@section('title', 'Daily Time Records')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>Daily Time Records &raquo; 201811</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-xs-12">

                <!-- DAILY TIME RECORDS -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Timesheet</h3>
                        
                        <div class="box-options pull-right">
                            <select class="form-control">
                                <option>201812</option>
                                <option selected>201811</option>
                                <option>201810</option>
                                <option>201809</option>
                            </select>
                        </div>

                        <div class="pull-right mr05">
                            <a href="/daily-time-records/export-second-cutoff" class="btn bnt btn-success"><i class="glyphicon glyphicon-file"></i> Export 2nd cutoff</a>
                        </div>
                        <div class="pull-right mr05">
                            <a href="/daily-time-records/export-first-cutoff" class="btn bnt btn-success"><i class="glyphicon glyphicon-file"></i> Export 1st cutoff</a>
                        </div>
                    </div>
                    <div class="box-body">
                        
                        <table class="table table-bordered table-striped table-hover table-dtr">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Workshift</th>
                                    <th class="text-center">Time<br>In</th>
                                    <th class="text-center">Time<br>Out</th>
                                    <th class="text-center">Work<br>Hours</th>
                                    <th class="text-center">Night Diff<br>Hours</th>
                                    <th class="text-center">Late</th>
                                    <th class="text-center">Undertime</th>
                                    <th class="text-center">Overtime</th>
                                    <th class="text-center">Overtime<br>Excess</th>
                                    <th class="text-center">Leave Type</th>
                                    <th class="text-center">Leave Days</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($attendances as $attendance)

                                @if($attendance->user_id == Auth::user()->id)
                                    <tr style="text-align: center;">
                                        <td>{{ $attendance->created_at->format('m/d/Y') }}</td>
                                        <td>{{ $attendance->user->workshift->code }}</td>
                                        <td style="line-height: 1.1;">
                                            {{ date('g:i:s a', $attendance->time_in) }}
                                            <br><span style="font-size: 80%; opacity: .50"> ({{ date('m/d', $attendance->time_in) }})</span>
                                        </td>
                                        <td style="line-height: 1.1;">
                                            {{ ($attendance->time_out == NULL) ? '' : date('g:i:s a', $attendance->time_out) }} <br><span style="font-size: 80%; opacity: .50"> {{ ($attendance->time_out == NULL) ? '' : '('. date('m/d', $attendance->time_out) .')' }}</span>
                                        </td>
                                        <td>{{ ($attendance->time_out == NULL) ? '' : App\Dtr::timeDiff($attendance->time_out, $attendance->time_in) }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                @endif

                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
@endsection