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
                    </div>
                    <div class="box-body">
                        
                        <?php
                        $dtr = array(
                            array('11/1/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','VL','0.5',1),
                            array('11/2/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/3/2018','TA1','-','-','0','0','0','0','0','0','-','-',0),
                            array('11/4/2018','TA1','','','0','0','0','0','0','0','-','-',0),
                            array('11/5/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/6/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/7/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/8/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/9/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/10/2018','TA1','','','0','0','0','0','0','0','-','-',0),
                            array('11/11/2018','TA1','','','0','0','0','0','0','0','-','-',0),
                            array('11/13/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/14/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/15/2018','TA1','8:00 AM','5:00 PM','0','0','0','0','0','0','-','-',1),
                            array('11/16/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/17/2018','TA2','','','0','0','0','0','0','0','-','-',0),
                            array('11/18/2018','TA2','','','0','0','0','0','0','0','-','-',0),
                            array('11/19/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/20/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/21/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/22/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/23/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/24/2018','TA2','','','0','0','0','0','0','0','-','-',0),
                            array('11/25/2018','TA2','','','0','0','0','0','0','0','-','-',0),
                            array('11/26/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/27/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/28/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/29/2018','TA2','','','0','0','0','0','0','0','-','-',1),
                            array('11/30/2018','TA2','','','0','0','0','0','0','0','-','-',1)
                        );
                        ?>
                        
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
                                        <td>{{ "REG-MF-8A5P-SSR" }}</td>
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