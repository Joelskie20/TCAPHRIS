@extends('layouts.master')

@section('title', 'Workshift Assignment')

@section('styles')
<style>
.bg-yellow{background:#cc0 !important;}
.user-row.bg-green a,.user-row.bg-orange a,.user-row.bg-yellow a,.user-row.bg-aqua a{color:#fff;}
.month-header th{padding:5px;font-weight:600;text-align:center;}
.work-day{position:relative;}
.fht-table th,.fht-table td{border:1px solid #eee;}
#work-rate thead th i{display:none;color:#666;}
#filter{width:300px;}
.fht-table,.fht-table thead,.fht-table tfoot,.fht-table tbody,.fht-table tr,.fht-table th,.fht-table td{margin:0;}
.fht-table{border:0 none;height:auto;width:100%;border-collapse:collapse;border-spacing:0;}
.fht-table th,.fht-table td{border-bottom:1px solid #eee;}
.fht-table-wrapper,.fht-table-wrapper .fht-thead,.fht-table-wrapper .fht-tfoot,.fht-table-wrapper .fht-fixed-column .fht-tbody,.fht-table-wrapper .fht-fixed-body .fht-tbody,.fht-table-wrapper .fht-tbody{overflow:hidden;position:relative;}
.fht-table-wrapper .fht-fixed-body .fht-tbody,.fht-table-wrapper .fht-tbody{overflow:auto;}
.fht-table-wrapper .fht-table .fht-cell {overflow:hidden;height:1px;}
.fht-table-wrapper .fht-fixed-column,.fht-table-wrapper .fht-fixed-body {top:0;left:0;position:absolute;}
.fht-table-wrapper .fht-fixed-column{z-index:1;}
.fht-table-wrapper .fht-fixed-column .fht-tbody{border-top:1px solid #eee;height:527px !important;}
.fht-fixed-body .fht-thead table{margin-right:20px;border:0 none;}
.cell-gen{border-top:1px solid #eee;border-left:1px solid #eee;font-weight:bold;padding:7px;text-align:center;}
.cell-gen:last-child{border-right:1px solid #eee;}
.cell-norm{border:1px solid #eee;padding:5px 0;height:30px;}
.userTimeIn{display:block;background:green;color:white;}
.userTimeOut{display:block;background:black;color:white;}
.userRestDay{display:block;background:midnightblue;color:white;}
.user_name{font-size:18px;}
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

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="box box-info">
                    <div class="box-body">

                        <!-- FILTER -->

                        <div class="col-md-12">
                            <form class="form-horizontal mr10" method="POST" action="{{ action('WorkshiftController@calendarPost') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="row">

                                        <label for="inputEmail3" class="col-sm-1 control-label">Date range:</label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right daterange" id="daterange" name="daterange" value="{{ $from->format('m/d/Y') }} - {{ $to->format('m/d/Y') }}">
                                            </div>
                                        </div>


                                        <div class="col-sm-2">
                                            <input type="submit" value="Filter" class="btn btn-primary btn-block">
                                        </div>

                                        <a href="/workshift-assignment" class="btn btn-success pull-right">Default View</a>

                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>


                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Calendar Table</h3>
                    </div>
                    <div class="box-body work-rate-table">
                        <table id="work-rate" class="fht-table table-hover">

                            <thead>
                                <tr class="month-header">
                                    <th colspan="2"></th> 
                                    <th class="text-center" colspan="{{ App\WorkshiftSched::getAllDays($from, $to)->count() }}">March</th>

                                    {{-- @if($from->between()) --}}

                                </tr>
                                <tr>
                                    <th style="padding:5px 10px;"></th>
                                    <th class="sortable" style="padding:5px;">Employee <i class="fa fa-chevron-down ml05" style="display: none;"></i></th>

                                    @foreach($dateRange as $date)
                                        <th class="text-center cell-gen">{{ $date->day }}<br>
                                            <span style="font-size:80%;opacity:0.5">
                                                {{ array_key_exists( $date->dayOfWeek, config('app.days') ) ? config('app.days')[$date->dayOfWeek] : '' }}
                                            </span>
                                        </th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $key => $user)

                                    <tr id="u-{{ $user->id }}" class="user-row sched-row" data-user-id="{{ $user->id }}">
                                        <td style="padding:5px;">{{ $user->id }}</td>
                                        <td class="cell-norm user-name-row" style="padding:5px;"><a href="/employee/{{ $user->id }}" target="_blank" style="float:left;width:175px;">{{ $user->firstNameFirst() }}</a></td>
                                        
                                        @foreach($dateRange as $date)

                                        
                                            <td style="text-align:center;padding:3px;font-size:14px;" data-toggle="modal" data-target="#workshift-modal"
                                                id="day-{{ App\WorkshiftPerDay::where('user_id', $user->id)->where('date_code', $date->format('Ymd'))->value('id') }}" 
                                                data-id="{{ App\WorkshiftPerDay::where('user_id', $user->id)->where('date_code', $date->format('Ymd'))->value('id') }}"
                                                data-time-in="{{ App\Workshift::getUserTimeIn($user, $date->format('Ymd')) }}"
                                                data-time-out="{{ App\Workshift::getUserTimeOut($user, $date->format('Ymd')) }}"
                                                data-date="{{ $date->format('Ymd') }}">
                                                
                                                @foreach($user->workshiftPerDay as $schedPerDay)

                                                    @if($date->format('Ymd') === $schedPerDay->date_code)

                                                        @if (! $schedPerDay->rest_day)
                                                            <span class="userTimeIn">{{ App\Workshift::getUserTimeIn($user, $schedPerDay->date_code) }}</span>
                                                            <span class="userTimeOut">{{ App\Workshift::getUserTimeOut($user, $schedPerDay->date_code) }}</span>
                                                        @else
                                                            <span class="userRestDay">Rest Day</span>
                                                        @endif
                                                        
                                                        

                                                    @endif
                                                
                                                @endforeach
                                            </td>

                                        @endforeach
                                        
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="modal fade" id="workshift-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title date"></h4>
              </div>
              <div class="modal-body">
                  <p class="user_name"></p>

                  <form action="#" method="POST">
                    <div class="row">

                        <!-- TIME IN -->
                        <div class="col-md-6">
                            <label for="timeIn">Time In</label>
                            <select class="form-control" id="time_in" name="time_in" required>
                                <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>
                            </select>                        
                        </div>

                        <!-- TIME IN -->
                        <div class="col-md-6">
                            <label for="timeIn">Time Out</label>
                            <select class="form-control" id="time_out" name="time_out" required>
                                <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>
                            </select>                        
                        </div>
                    </div>
                  </form>

                  {{-- <p class="time_in"></p>
                  <p class="time_out"></p>
                  <p class="date"></p> --}}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


            
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
$("#daterange").daterangepicker();

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

$("td").click(function() {

    // var url = '/workshift-per-day/' + $(this).parent().attr('data-user-id') + '/' + $(this).attr('id');

    var user_id = $(this).parent().attr('data-user-id');
    var time_in = $(this).attr('data-time-in');
    var time_out = $(this).attr('data-time-out');
    var date = $(this).attr('data-date');
    var user_name = $(this).parent().find('.user-name-row').text();

    $('#workshift-modal .date').html(moment(date).format('LL'));
    $('#workshift-modal .user_name').html(user_name);
    $('#workshift-modal .user_id').html(user_id);
    $('#workshift-modal .time_in').html(time_in);
    $('#workshift-modal .time_out').html(time_out);

});
</script>
@endsection
