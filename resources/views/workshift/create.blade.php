@extends('layouts.master')

@section('title', 'Add Workshift')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>Add Workshift</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="post" action="{{ action('WorkshiftController@store') }}">
            @csrf
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Workshift Details</h3>
                </div>
                <div class="box-body workshift-form">

                    <div class="callout callout-warning">
                        <h4>Important!</h4>
                        <p>Workshift greatly affects the computation of payroll of an employee assigned to a specific work shift.<br>Please make sure that the workshift details are correct.</p>
                    </div>

                    <!-- BASIC INFO -->
                    <div class="row">

                        <!-- WORKSHIFT CODE -->
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="workshiftCode">Workshift Code <small class="label label-danger">Required</small></label>
                                <input type="text" maxlength="200" class="form-control" id="workshiftCode" name="workshift_code" data-inputmask="&quot;mask&quot;: &quot;9999999&quot;" data-mask="" required="">
                            </div>
                        </div>

                        <!-- WORKSHIFT NAME -->
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="workshiftName">Workshift Name <small class="label label-danger">Required</small></label>
                                <input type="text" maxlength="200" class="form-control" id="workshiftName" name="workshift_name" data-inputmask="&quot;mask&quot;: &quot;9999999&quot;" data-mask="" required="">
                            </div>
                        </div>

                    </div>

                    <!-- MONDAY -->
                    <div class="row">

                        <!-- MONDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="mondayTimeIn">Monday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="mondayTimeIn" name="monday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- MONDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="mondayTimeOut">Monday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Tuesday)</span></label>
                                <select class="form-control" id="mondayTimeOut" name="monday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- MONDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="mondayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="mondayWorkHours" name="monday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- MONDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox form-group">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="monday_rest_day" value="RD"> Monday Restday
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- TUESDAY -->
                    <div class="row">

                        <!-- TUESDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="tuesdayTimeIn">Tuesday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="tuesdayTimeIn" name="tuesday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- TUESDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="tuesdayTimeOut">Tuesday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Wednesday)</span></label>
                                <select class="form-control" id="tuesdayTimeOut" name="tuesday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- TUESDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="tuesdayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="tuesdayWorkHours" name="tuesday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- TUESDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="tuesday_rest_day" value="RD"> Tuesday Restday
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- WEDNESDAY -->
                    <div class="row">

                        <!-- WEDNESDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="wednesdayTimeIn">Wednesday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="wednesdayTimeIn" name="wednesday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- WEDNESDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="wednesdayTimeOut">Wednesday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Thursday)</span></label>
                                <select class="form-control" id="wednesdayTimeOut" name="wednesday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- WEDNESDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="wednesdayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="wednesdayWorkHours" name="wednesday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- WEDNESDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="wednesday_rest_day" value="RD"> Wednesday Restday
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- THURSDAY -->
                    <div class="row">

                        <!-- THURSDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="thursdayTimeIn">Thursday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="thursdayTimeIn" name="thursday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- THURSDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="thursdayTimeOut">Thursday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Friday)</span></label>
                                <select class="form-control" id="thursdayTimeOut" name="thursday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- THURSDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="thursdayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="thursdayWorkHours" name="thursday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- THURSDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="thursday_rest_day" value="RD"> Thursday Restday
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- FRIDAY -->
                    <div class="row">

                        <!-- FRIDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="fridayTimeIn">Friday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="fridayTimeIn" name="friday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- FRIDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="fridayTimeOut">Friday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Saturday)</span></label>
                                <select class="form-control" id="fridayTimeOut" name="friday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- FRIDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="fridayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="fridayWorkHours" name="friday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- FRIDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="friday_rest_day" value="RD"> Friday Restday
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- SATURDAY -->
                    <div class="row">

                        <!-- SATURDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="saturdayTimeIn">Saturday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="saturdayTimeIn" name="saturday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- SATURDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="saturdayTimeOut">Saturday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Sunday)</span></label>
                                <select class="form-control" id="saturdayTimeOut" name="saturday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- SATURDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="saturdayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="saturdayWorkHours" name="saturday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- SATURDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="saturday_rest_day" value="RD"> Saturday Restday
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- SUNDAY -->
                    <div class="row">

                        <!-- SUNDAY TIME IN -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="sundayTimeIn">Sunday Time In <small class="label label-success">Required</small></label>
                                <select class="form-control" id="sundayTimeIn" name="sunday_time_in" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800" selected="">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- SUNDAY TIME OUT -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="sundayTimeOut">Sunday Time Out <small class="label label-success">Required</small> <span class="day-overlap">(on Monday)</span></label>
                                <select class="form-control" id="sundayTimeOut" name="sunday_time_out" required="">
                                    <option value="0">12:00 AM</option><option value="30">12:30 AM</option><option value="100">1:00 AM</option><option value="130">1:30 AM</option><option value="200">2:00 AM</option><option value="230">2:30 AM</option><option value="300">3:00 AM</option><option value="330">3:30 AM</option><option value="400">4:00 AM</option><option value="430">4:30 AM</option><option value="500">5:00 AM</option><option value="530">5:30 AM</option><option value="600">6:00 AM</option><option value="630">6:30 AM</option><option value="700">7:00 AM</option><option value="730">7:30 AM</option><option value="800">8:00 AM</option><option value="830">8:30 AM</option><option value="900">9:00 AM</option><option value="930">9:30 AM</option><option value="1000">10:00 AM</option><option value="1030">10:30 AM</option><option value="1100">11:00 AM</option><option value="1130">11:30 AM</option><option value="1200">12:00 PM</option><option value="1230">12:30 PM</option><option value="1300">1:00 PM</option><option value="1330">1:30 PM</option><option value="1400">2:00 PM</option><option value="1430">2:30 PM</option><option value="1500">3:00 PM</option><option value="1530">3:30 PM</option><option value="1600">4:00 PM</option><option value="1630">4:30 PM</option><option value="1700" selected="">5:00 PM</option><option value="1730">5:30 PM</option><option value="1800">6:00 PM</option><option value="1830">6:30 PM</option><option value="1900">7:00 PM</option><option value="1930">7:30 PM</option><option value="2000">8:00 PM</option><option value="2030">8:30 PM</option><option value="2100">9:00 PM</option><option value="2130">9:30 PM</option><option value="2200">10:00 PM</option><option value="2230">10:30 PM</option><option value="2300">11:00 PM</option><option value="2330">11:30 PM</option>										</select>
                            </div>
                        </div>

                        <!-- SUNDAY WORK HOURS -->
                        <div class="col-md-6 col-lg-4 form-dropdown">
                            <div class="form-group">
                                <label for="sundayWorkHours">Work Hours <small class="label label-success">Required</small></label>
                                <select class="form-control" id="sundayWorkHours" name="sunday_work_hours" required="">
                                    <option value="0.5">0.5 H</option><option value="1.0">1.0 H</option><option value="1.5">1.5 H</option><option value="2.0">2.0 H</option><option value="2.5">2.5 H</option><option value="3.0">3.0 H</option><option value="3.5">3.5 H</option><option value="4.0">4.0 H</option><option value="4.5">4.5 H</option><option value="5.0">5.0 H</option><option value="5.5">5.5 H</option><option value="6.0">6.0 H</option><option value="6.5">6.5 H</option><option value="7.0">7.0 H</option><option value="7.5">7.5 H</option><option value="8.0" selected="">8.0 H</option><option value="8.5">8.5 H</option><option value="9.0">9.0 H</option><option value="9.5">9.5 H</option><option value="10.0">10.0 H</option><option value="10.5">10.5 H</option><option value="11.0">11.0 H</option><option value="11.5">11.5 H</option><option value="12.0">12.0 H</option>										</select>
                            </div>
                        </div>

                        <!-- SUNDAY REST DAY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="checkbox">
                                <label class="restday-toggle">
                                    <input type="checkbox" name="sunday_rest_day" value="RD"> Sunday Restday
                                </label>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

            <div class="form-options mb20 clearfix">
                <a href="/workshifts" class="btn btn-default pull-right">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right mr05">Add Workshift</button>
            </div>

        </form>

    </section>
				<!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
		$(function() {
			
			$('.restday-toggle').click(function() {
				console.log($(this).find('input').is(':checked'));
				if($(this).find('input').is(':checked')) {
					$(this).addClass('text-bold');
					$(this).parent().parent().parent().find('.form-dropdown').hide();
				} else {
					$(this).removeClass('text-bold');
					$(this).parent().parent().parent().find('.form-dropdown').show();
				}
			});
			
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			$('#mondayTimeIn, #mondayTimeOut').change(function() {
				if($('#mondayTimeIn').val()*1 > $('#mondayTimeOut').val()*1) {
					$('#mondayTimeOut').parent().find('.day-overlap').show();
				} else {
					$('#mondayTimeOut').parent().find('.day-overlap').hide();
				}
			});
			
		});
	</script>
@endsection
