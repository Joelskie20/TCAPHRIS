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
.userTimeIn{display:block;background:green;color:white;padding:0 4px}
.userTimeOut{display:block;background:black;color:white;padding:0 4px}
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
                            <form class="form-horizontal mr10" method="GET" action="{{ action('WorkshiftController@calendar') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="row">

                                        <label for="dateRange" class="col-sm-1 control-label">Date range:</label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right daterange" id="daterange" name="daterange" value="{{ old('daterange') }}">
                                            </div>
                                        </div>

                                        <label for="Team" class="col-sm-1 control-label">Team:</label>

                                        <!-- TEAM -->
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control" id="teamID" name="team_id" >
                                                    <option value="0" class="opt-none">-- None --</option>
                                                    @foreach($teams as $team)
                                                        <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                                    @endforeach
                                                </select>
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
                    <div class="box-body table-responsive">
                        <table id="work-rate" class="fht-table table-hover table-striped">

                            <thead>
                                <tr class="month-header">
                                    <th colspan="2"></th> 
                                    <th class="text-center" colspan="{{ App\WorkshiftSched::getAllDays(Carbon::parse($from), Carbon::parse($to)->endOfMonth())->count() }}">{{ Carbon::parse($from)->format('F') }}</th>
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

                                @php
                                $td_ctr = 1;    
                                @endphp

                                @foreach($users as $key => $user)

                                    <tr id="u-{{ $user->id }}" class="user-row sched-row" data-user-id="{{ $user->id }}">
                                        <td style="padding:5px;">{{ $user->id }}</td>
                                        <td class="cell-norm user-name-row" style="padding:5px;"><a href="/employee/{{ $user->id }}" target="_blank" style="float:left;width:175px;">{{ $user->firstNameFirst() }}</a></td>
                                        
                                        @foreach($dateRange as $date)

                                            <td style="text-align:center;padding:3px;font-size:14px;vertical-align:top;" class="td-{{ $td_ctr }} day-cell" data-cell-id="{{ $td_ctr }}"
                                                id="day-{{ App\WorkshiftPerDay::where('user_id', $user->id)->where('date_code', $date->format('Ymd'))->value('id') }}" 
                                                data-id="{{ App\WorkshiftPerDay::where('user_id', $user->id)->where('date_code', $date->format('Ymd'))->value('id') }}"
                                                data-date="{{ $date->format('Ymd') }}">
                                                
                                                <span class="btn btn-xs btn-block btn-default"><i class="fa fa-plus"></i></span>

                                                @foreach($user->workshiftPerDay as $schedPerDay)
                                                    @if($date->format('Ymd') === $schedPerDay->date_code)
                                                        <div class="btn btn-default btn-block" id="ws-{{ $schedPerDay->id }}"
                                                        data-id="{{ $schedPerDay->id }}"
                                                        data-toggle="modal"
                                                        data-target="#workshift-modal"
                                                        data-time-in="{{ App\Workshift::getUserTimeIn($user, $date->format('Ymd'), $schedPerDay->id) }}"
                                                        data-time-out="{{ App\Workshift::getUserTimeOut($user, $date->format('Ymd'), $schedPerDay->id) }}"
                                                        data-rest-day="{{ App\WorkshiftPerDay::where('user_id', $user->id)->where('date_code', $date->format('Ymd'))->value('rest_day') }}">
                                                            <span class="userTimeIn">{{ App\Workshift::formatTime(App\Workshift::getUserTimeIn($user, $schedPerDay->date_code, $schedPerDay->id)) }}</span>
                                                            <span class="userTimeOut">{{ App\Workshift::formatTime(App\Workshift::getUserTimeOut($user, $schedPerDay->date_code, $schedPerDay->id)) }}</span>
                                                            @if ($schedPerDay->rest_day)
                                                                <span class="userRestDay">Rest Day</span>
                                                            @endif
                                                            </div>
                                                    @endif
                                                @endforeach
                                                
                                            </td>

                                            @php
                                            $td_ctr++;
                                            @endphp
                                        @endforeach
                                        
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    <style>
    td.day-cell > span {
        opacity: 0.2;
    }
    td.day-cell:hover > span {
        opacity: 1;
    }
    </style>
        
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

                  
                    <div class="row">

                        <!-- TIME IN -->
                        <div class="col-md-6">
                            <label for="timeIn">Time In</label>
                            <select class="form-control time_in" name="time_in" id="time_in" required>
                                <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>
                            </select>                        
                        </div>

                        <!-- TIME OUT -->
                        <div class="col-md-6">
                            <label for="timeIn">Time Out</label>
                            <select class="form-control time_out" name="time_out" id="time_out" required>
                                <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>
                            </select>                        
                        </div>

                        <!-- REST DAY -->
                        <div class="col-md-6">
                            <label for="timeIn">Rest Day?</label>
                            <input type="checkbox" id="rest_day" name="rest_day" value="1">
                        </div>

                    </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left btn-modal-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete-workshift"><i class="fa fa-trash"></i> Delete</button>
                <button type="submit" class="btn btn-default" id="edit-workshift">Update</button>
                <button type="submit" class="btn btn-primary btn-add" id="add-workshift">Create</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div id="loader"></div>
            
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
    $(function() {

        var select_td_id = 0;
        var select_user_id = 0;
        var select_date = '';
        var div_id = 0;
        var time_in = '';
        var time_out = '';
        var rest_day = 0;

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

        $("td.day-cell").click(function() {

            if($(this).find('div').length == 0) {
                select_user_id = $(this).parent().attr('data-user-id');
                var user_name = $(this).parent().find('.user-name-row').text();
                select_date = $(this).attr('data-date');
                select_td_id = $(this).attr('data-cell-id');

                $('#workshift-modal .date').html(moment(select_date).format('LL'));
                $('#workshift-modal .user_name').html(user_name);
                $('#workshift-modal .time_in').val('800');
                $('#workshift-modal .time_out').val('1700');

                $('#workshift-modal').modal();
            }
            
        });


        $("td.day-cell > span").click(function() {

            if($(this).find('div').length == 0) {
                select_user_id = $(this).parent().parent().attr('data-user-id');
                var user_name = $(this).parent().parent().find('.user-name-row').text();
                select_date = $(this).parent().attr('data-date');
                select_td_id = $(this).parent().attr('data-cell-id');

                $('#workshift-modal .date').html(moment(select_date).format('LL'));
                $('#workshift-modal .user_name').html(user_name);
                $('#workshift-modal .time_in').val('800');
                $('#workshift-modal .time_out').val('1700');

                $('#workshift-modal #edit-workshift').hide();
                $('#workshift-modal #delete-workshift').hide();
                $('#workshift-modal #add-workshift').show();
                $('#workshift-modal').modal();
            }
            
        });

        $('td.day-cell > div').click(function() {
            select_user_id = $(this).parent().parent().attr('data-user-id');
            time_in = $(this).attr('data-time-in');
            time_out = $(this).attr('data-time-out');
            select_date = $(this).parent().attr('data-date');
            var user_name = $(this).parent().parent().find('.user-name-row').text();
            select_td_id = $(this).parent().attr('data-cell-id');
            div_id = $(this).attr('data-id');

            $('#workshift-modal .date').html(moment(select_date).format('LL'));
            $('#workshift-modal .user_name').html(user_name);
            $('#workshift-modal .time_in').val(time_in);
            $('#workshift-modal .time_out').val(time_out);

            if ($(this).attr('data-rest-day') == 1) {
                $('#rest_day').prop('checked', true);
            } else {
                $('#rest_day').prop('checked', false);
            }

            $('#workshift-modal #edit-workshift').show();
            $('#workshift-modal #delete-workshift').show();
            $('#workshift-modal #add-workshift').hide();
            // $('#workshift-modal').modal();
        });

        
        // $('#add-workshift').click(function() {
        //     var time_in = $('#time_in').val();
        //     var time_out = $('#time_out').val();
        //     var rest_day = $('#rest_day').is(':checked');
        //     $('#loader').load('/workshift-per-day?tid='+encodeURIComponent(select_td_id)+'&uid='+encodeURIComponent(select_user_id)+'&date='+encodeURIComponent(select_date)+'&time_in='+encodeURIComponent(time_in)+'&time_out='+encodeURIComponent(time_out)+'&restday='+encodeURIComponent(rest_day));
        // });

        // $('#edit-workshift').click(function() {
        //     var time_in = $('#time_in').val();
        //     var time_out = $('#time_out').val();
        //     var rest_day = $('#rest_day').is(':checked');
        //     $('#loader').load('/workshift-per-day/' + encodeURIComponent(div_id) + '?time_in=' + encodeURIComponent(time_in) + '&time_out=' + encodeURIComponent(time_out) + '&restday=' + encodeURIComponent(rest_day));
        // });

        $('#add-workshift').click(function() {

            var time_in = $('#time_in').val();
            var time_out = $('#time_out').val();
            var rest_day = $('#rest_day').is(':checked');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                cache: false,
                url: '/workshift-per-day',
                data: {
                    'td_id': select_td_id,
                    'user_id': select_user_id,
                    'date': select_date,
                    'time_in' : time_in,
                    'time_out' : time_out,
                    'rest_day' : rest_day
                },
                success: function( response ) {
                    
                    var html = '<div id="ws-'+ response.new_id +'" class="btn btn-default btn-block" data-id="' + response.new_id +'" data-time-in="' + response.time_in_raw +'" data-time-out="'+ response.time_out_raw +'" data-toggle="modal" data-target="#workshift-modal"><span class="userTimeIn">'+ response.time_in + '</span><span class="userTimeOut">'+ response.time_out +'</span>';
                    
                    if(response.rest_day == 1) {
                        html += '<span class="userRestDay">Rest Day</span>';
                    }
                    html += '</div>';

                    $(function() {
                        $('.td-' + response.td_id).append(html);

                        $('td.day-cell > div').click(function() {
                            select_user_id = $(this).parent().parent().attr('data-user-id');
                            time_in = $(this).attr('data-time-in');
                            time_out = $(this).attr('data-time-out');
                            select_date = $(this).parent().attr('data-date');
                            var user_name = $(this).parent().parent().find('.user-name-row').text();
                            select_td_id = $(this).parent().attr('data-cell-id');
                            div_id = $(this).attr('data-id');

                            $('#workshift-modal .date').html(moment(select_date).format('LL'));
                            $('#workshift-modal .user_name').html(user_name);
                            $('#workshift-modal .time_in').val(time_in);
                            $('#workshift-modal .time_out').val(time_out);

                            if ($(this).attr('data-rest-day') == 1) {
                                $('#rest_day').prop('checked', true);
                            } else {
                                $('#rest_day').prop('checked', false);
                            }

                            $('#workshift-modal #edit-workshift').show();
                            $('#workshift-modal #delete-workshift').show();
                            $('#workshift-modal #add-workshift').hide();
                            // $('#workshift-modal').modal();
                        });

                        $('#delete-workshift').click(function() {
                            $.ajax({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'DELETE',
                                url: '/workshift-per-day/' + div_id,
                                data: {
                                    '_method' : 'DELETE',
                                    'id' : div_id
                                },
                                success: function( response ) {
                                    $(function() {
                                        console.log(div_id);
                                        $('#ws-' + div_id).remove();
                                    });
                                },
                                complete: function( response ) {
                                    $(function() {
                                        $('.btn-modal-close').click();
                                    });
                                }
                            });
                        });

                        $('#edit-workshift').click(function() {

                        var time_in = $('#time_in').val();
                        var time_out = $('#time_out').val();
                        var rest_day = $('#rest_day').is(':checked');
            
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'PATCH',
                            url: '/workshift-per-day/' + div_id,
                            data: { 
                                '_method' : 'PATCH',
                                'id' : div_id,
                                'time_in' : time_in,
                                'time_out' : time_out,
                                'rest_day' : rest_day
                            },
                            success: function( response ) {
                                $(function() {
                                    $('#ws-' + div_id + ' span.userTimeIn').text(response.time_in);
                                    $('#ws-' + div_id + ' span.userTimeOut').text(response.time_out);

                                    $('#ws-' + div_id).attr('data-time-in', response.time_in_raw);
                                    $('#ws-' + div_id).attr('data-time-out', response.time_out_raw);
                                    $('#ws-' + div_id).attr('data-rest-day', response.rest_day);

                                    if (response.rest_day == true) {
                                        $('#ws-' + div_id).append('<span class="userRestDay">Rest Day</span>');
                                    } else {
                                        $('#ws-' + div_id + ' .userRestDay').remove();
                                    }
                                })
                            },
                            complete: function( response ) {
                                $(function() {
                                    $('.btn-modal-close').click();
                                });
                            }
                        });

                    });
                });
                    
                },
                complete: function() {
                    $(function() {
                        $('.btn-modal-close').click();
                        $('#workshift-modal #edit-workshift').show();
                        $('#workshift-modal #delete-workshift').show();
                        $('#workshift-modal #add-workshift').hide();

                    });

                    
                }
            });
        });

        $('#edit-workshift').click(function() {

            var time_in = $('#time_in').val();
            var time_out = $('#time_out').val();
            var rest_day = $('#rest_day').is(':checked');
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PATCH',
                url: '/workshift-per-day/' + div_id,
                data: { 
                    '_method' : 'PATCH',
                    'id' : div_id,
                    'time_in' : time_in,
                    'time_out' : time_out,
                    'rest_day' : rest_day
                },
                success: function( response ) {
                    $(function() {
                        $('#ws-' + div_id + ' span.userTimeIn').text(response.time_in);
                        $('#ws-' + div_id + ' span.userTimeOut').text(response.time_out);

                        $('#ws-' + div_id).attr('data-time-in', response.time_in_raw);
                        $('#ws-' + div_id).attr('data-time-out', response.time_out_raw);
                        $('#ws-' + div_id).attr('data-rest-day', response.rest_day);

                        if (response.rest_day == true) {
                            $('#ws-' + div_id).append('<span class="userRestDay">Rest Day</span>');
                        } else {
                            $('#ws-' + div_id + ' .userRestDay').remove();
                        }
                    })
                },
                complete: function( response ) {
                    $(function() {
                        $('.btn-modal-close').click();
                    });
                }
            });

        });

        $('#delete-workshift').click(function() {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: '/workshift-per-day/' + div_id,
                data: {
                    '_method' : 'DELETE',
                    'id' : div_id
                },
                success: function( response ) {
                    $(function() {
                        console.log(div_id);
                        $('#ws-' + div_id).remove();
                    });
                },
                complete: function( response ) {
                    $(function() {
                        $('.btn-modal-close').click();
                    });
                }
            });
        });
    });
</script>
@endsection
