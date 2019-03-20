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
                            <form class="form-horizontal mr10" method="POST" action="{{ action('WorkshiftController@calendar') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="row">

                                        <label for="inputEmail3" class="col-sm-1 control-label">Date range:</label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right daterange" id="daterange" name="daterange"
                                                    value="03/15/2019 - 04/01/2019">
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
                                    <th class="text-center" style="border-right:1px solid #ccc;" colspan="{{ App\WorkshiftSched::getAllDays($from, $to)->count() }}">March</th>

                                    {{-- @if($from->between()) --}}

                                </tr>
                                <tr>
                                    <th style="padding:5px 10px;"></th>
                                    <th class="sortable" style="padding:5px;">Employee <i class="fa fa-chevron-down ml05" style="display: none;"></i></th>

                                    @foreach($dateRange as $date)
                                        <th class="text-center cell-gen">{{ $date->day }}<br>
                                            <span style="font-size:80%;opacity:0.5">
                                                {{-- {{ array_key_exists($date->dayOfWeek, config('app.days')) ? 'test' }} --}}
                                                {{ array_key_exists( $date->dayOfWeek, config('app.days') ) ? config('app.days')[$date->dayOfWeek] : '' }}
                                            </span>
                                        </th>
                                    @endforeach

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)

                                    <tr id="u-{{ $user->id }}" class="user-row sched-row" data-user="{{ $user->id }}">
                                        <td style="padding:5px;">{{ $user->id }}</td>
                                        <td class="cell-norm user-name-row" style="padding:5px;"><a href="/employee/{{ $user->id }}" target="_blank" style="float:left;width:175px;">{{ $user->lastNameFirst() }}</a></td>
                                        @foreach($dateRange as $date)
                                            <td style="text-align: center;padding:3px;">
                                                {{ App\Workshift::getUserWorkshift($date, $user) }}
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
</script>
@endsection
