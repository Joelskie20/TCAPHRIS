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
                                    <th>Date</th>
                                    <th>Workshift</th>
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
                                <?php
                                foreach($dtr as $i => $d) {
                                    echo '<tr class="';
                                    if(!$d[12]) {
                                        echo 'bg-gray';
                                    }
                                    if($i >= 14) {
                                        echo ' date-to-come';
                                    }
                                    echo '">';
                                        echo '<td>'.$d[0].'</td>';
                                        echo '<td>'.$d[1].'</td>';
                                        echo '<td class="text-center">'.$d[2].'</td>';
                                        echo '<td class="text-center">'.$d[3].'</td>';
                                        echo '<td class="text-center">'.$d[4].'</td>';
                                        echo '<td class="text-center">'.$d[5].'</td>';
                                        echo '<td class="text-center">'.$d[6].'</td>';
                                        echo '<td class="text-center">'.$d[7].'</td>';
                                        echo '<td class="text-center">'.$d[8].'</td>';
                                        echo '<td class="text-center">'.$d[9].'</td>';
                                        echo '<td class="text-center">'.$d[10].'</td>';
                                        echo '<td class="text-center">'.$d[11].'</td>';
                                    echo '</tr>';
                                }
                                ?>
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