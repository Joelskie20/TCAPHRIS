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
                        
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Workshift</th>
                                    <th class="text-center">Time<br>In</th>
                                    <th class="text-center">Time<br>Out</th>
                                    <th class="text-center">Work<br>Hours</th>
                                    <th class="text-center">Late</th>
                                    <th class="text-center">UT</th>
                                    <th class="text-center">OT Time<br>In</th>
                                    <th class="text-center">OT Time<br>Out</th>
                                    <th class="text-center">OT<br>Hours</th>
                                    <th class="text-center">Leave<br>Type</th>
                                    <th class="text-center">Leave<br>Count</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if($holidays->count() > 0)
                                @foreach($holidays as $holiday)
                                <tr style="text-align:center;background:lightyellow">
                                    <td style="vertical-align:middle;" title="{{ Carbon::parse($holiday->date)->format('F j, Y') }}">{{ Carbon::parse($holiday->date)->format('m/d/Y') }}</td>
                                    <td>{{ $holiday->name }}</td>
                                    <td>
                                        {{-- @if($user->workshiftPerDay()->pluck('date_code')->contains(Carbon::parse($holiday->date)->format('Ymd')))
                                            @foreach($user->attendances()->latest()->get() as $attendance)

                                                @if(Carbon::parse($holiday->date)->format('Ymd') === Carbon::createFromTimestamp($attendance->time_in)->format('Ymd'))
                                                    {{ Carbon::createFromTimestamp($attendance->time_in)->format('g:i:s a') }}
                                                    <br><span style="font-size:80%;opacity:0.5">({{ Carbon::createFromTimestamp($attendance->time_in)->format('m/d') }})</span>
                                                @endif

                                            @endforeach
                                        @endif --}}
                                        -
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                @endforeach
                            @endif

                            @if($user->id === Auth::id())
                                @foreach($user->leaves()->where('status', 'approved')->get() as $approved)
                                <tr style="text-align:center;background:#627162;color:white">
                                    <td title="{{ Carbon::parse($approved->leave_date)->format('F j, Y') }}">{{ Carbon::parse($approved->leave_date)->format('m/d/Y') }}</td>
                                    <td> - </td>
                                    <td> - </td>
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
                                        @elseif($approved->leave_type === 'Birthday Leave')
                                            {{ 'BL' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($approved->day_count === 'Whole Day')
                                            {{ '1.0' }}
                                        @elseif($approved->day_count === '1st Half' || $approved->day_count === '2nd Half')
                                            {{ '0.5' }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                            
                            @foreach ($user->attendances()->latest()->get() as $attendance)

                            {{-- @if(App\Holiday::dates()->contains(Carbon::createFromTimestamp($attendance->time_in)->format('Y-m-d')))
                                @continue
                            @endif --}}

                            <tr style="text-align: center;">
                                <td title="{{ Carbon::createFromTimestamp($attendance->time_in)->format('F j, Y') }}">{{ Carbon::createFromTimestamp($attendance->time_in)->format('m/d/Y') }}</td>
                                <td>
                                    @foreach($user->workshiftPerDay()->get() as $day)
                                        
                                        @if (Carbon::createFromTimestamp($attendance->time_in)->format('Ymd') === $day->date_code)

                                            {{ is_null($day->workshift_id) ? 'Custom: ' . App\Workshift::formatTime(App\Workshift::getUserTimeIn($user, $day->date_code, $day->id)) . ' - ' . App\Workshift::formatTime(App\Workshift::getUserTimeOut($user, $day->date_code, $day->id)) : App\Workshift::where('id', $day->workshift_id)->value('code')  }}<br>

                                        @endif

                                    @endforeach
                                </td>
                                
                                <td style="line-height: 1.1;">
                                    {{ date('g:i:s a', $attendance->time_in) }}
                                    <br><span style="font-size: 80%; opacity: .50"> ({{ date('m/d', $attendance->time_in) }})</span>
                                </td>
                                <td style="line-height: 1.1;">
                                    {{ ($attendance->time_out == NULL) ? '' : date('g:i:s a', $attendance->time_out) }} <br><span style="font-size: 80%; opacity: .50"> {{ ($attendance->time_out == NULL) ? '' : '('. date('m/d', $attendance->time_out) .')' }}</span>
                                </td>
                                <td>{{ ($attendance->time_out == NULL) ? '' : App\Dtr::timeDiff($attendance->time_out, $attendance->time_in) }}</td>
                                {{-- <td> {{ App\Dtr::checkIfLate( $user, $attendance, Carbon::createFromTimestamp($attendance->time_in)->dayOfWeek ) }}</td> --}}
                                <td>
                                     @foreach($user->workshiftPerDay()->get() as $day)
                                        
                                        @if (Carbon::createFromTimestamp($attendance->time_in)->format('Ymd') === $day->date_code)

                                            {{ App\Dtr::checkIfLate(Carbon::createFromTimestamp($attendance->time_in)->format('h:i a'), App\Workshift::formatTime(App\Workshift::getUserTimeIn($user, $day->date_code, $day->id))) }}

                                        @endif

                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->workshiftPerDay()->get() as $day)
                                        
                                        @if (Carbon::createFromTimestamp($attendance->time_out)->format('Ymd') === $day->date_code && Carbon::createFromTimestamp($attendance->time_out)->format('Ymd') === Carbon::createFromTimestamp($attendance->time_in)->format('Ymd'))

                                            {{ App\Dtr::checkIfUndertime(Carbon::createFromTimestamp($attendance->time_out)->format('h:i a'), App\Workshift::formatTime(App\Workshift::getUserTimeOut($user, $day->date_code, $day->id))) }}
                                        
                                        @endif

                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->overtimes()->where('status', 'approved')->get() as $overtime)
                                        @if(date('Y-m-d', $attendance->time_in) === $overtime->date)
                                            {{ date('g:i a', $overtime->time_in) }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->overtimes()->where('status', 'approved')->get() as $overtime)
                                        @if(date('Y-m-d', $attendance->time_in) === $overtime->date)
                                            {{ date('g:i a', $overtime->time_out) }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->overtimes()->where('status', 'approved')->get() as $overtime)
                                        @if(date('Y-m-d', $attendance->time_in) === $overtime->date)
                                            {{ App\Dtr::timeDiff($overtime->time_out, $overtime->time_in) }}
                                        @endif
                                    @endforeach
                                </td>
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
        'order': [ [ 0, "desc" ] ]
    });
});
</script>
@endsection 