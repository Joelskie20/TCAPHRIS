@extends('layouts.master')

@section('title', 'Daily Time Records')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>Daily Time Records &raquo; {{ now()->format('Ym') }}</h1>
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
                                <option selected>{{ now()->format('Ym') }}</option>
                                <option>{{ now()->format('Ym') - 1 }}</option>
                                <option>{{ now()->format('Ym') - 2 }}</option>
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
                        
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Workshift</th>
                                    <th class="text-center">Time<br>In</th>
                                    <th class="text-center">Time<br>Out</th>
                                    <th class="text-center">Work<br>Hours</th>
                                    <th class="text-center">Late</th>
                                    <th class="text-center">Undertime</th>
                                    <th class="text-center">Overtime</th>
                                    <th class="text-center">Leave Type</th>
                                    <th class="text-center">Leave Days</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if($user->id === Auth::id())
                                @foreach($user->leaves()->where('status', 'approved')->get() as $approved)
                                <tr style="text-align:center; background-color:#20bf6b; color:#333">
                                    <td>{{ Carbon::parse($approved->leave_date)->format("m/d/Y") }}</td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td>
                                        @if($approved->leave_type === 'Vacation Leave')
                                            {{ 'VL' }}
                                        @elseif($approved->leave_type === 'Sick Leave')
                                            {{ 'SL' }}
                                        @endif
                                    </td>
                                    <td>{{ $approved->day_count }}</td>
                                </tr>
                                @endforeach
                            @endif

                            
                            @foreach ($attendances as $attendance)
                            <tr style="text-align: center;">
                                <td>{{ date('m/d/Y', $attendance->time_in) }}</td>
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
                            </tr>
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

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').dataTable({
        'iDisplayLength': 50,
        'order': [[ 0, "desc" ]]
    });
});
</script>
@endsection