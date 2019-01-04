@php
if(isset($_GET['v'])) {
	$view = $_GET['v'];
}    
@endphp
@extends('layouts.master')

@section('title', 'Team Schedule')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
            <h1>Team Schedule &raquo; 201811</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">

                <div class="col-xs-12">

                    <!-- DAILY TIME RECORDS -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Team Schedule Details</h3>
                            <div class="box-tools pull-right">
                                @if ($view == 'list')
                                    <a href="{{ url()->current() . '?v=calendar' }}" class="btn btn-primary btn-sm"><i class="fa fa-calendar mr05"></i> CALENDAR VIEW</a>
                                @else
                                    <a href="{{ url()->current()  . '?v=list' }}" class="btn btn-primary btn-sm"><i class="fa fa-list mr05"></i> LIST VIEW</a>
                                @endif
                            </div>
                        </div>
                        <div class="box-body">
                        
                            <table class="table table-bordered team-select">
                                <tbody>
                                    <tr>
                                        <th>Select Team</th>
                                        <td>
                                            <select class="form-control select2">
                                                <option>Site A</option>
                                                <option>Site B</option>
                                                <option>Site C</option>
                                            </select>
                                        </td>
                                        <th>Select Year Month</th>
                                        <td>
                                            <select class="form-control">
                                                <option>201812</option>
                                                <option selected>201811</option>
                                                <option>201810</option>
                                                <option>201809</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <hr>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:10px;">D</th>
                                        <td>Day Shift (8:00AM - 4:00PM)</td>
                                        <th style="width:10px;">E</th>
                                        <td>Evening Shift (4:00PM - 12:00MN)</td>
                                        <th style="width:10px;">M</th>
                                        <td>Midnight Shift (12:00MN - 8:00AM)</td>
                                    </tr>
                                    <tr>
                                        <th style="width:10px;">R</th>
                                        <td>Regular Office Hours (8:00AM - 5:00PM)</td>
                                        <th style="width:10px;">X</th>
                                        <td>Day-off</td>
                                        <th style="width:10px;">*</th>
                                        <td>Shift Supervisor</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            
                            <?php
                            $records = array(
                                array('Noel S. Gumayagay','CNSS Officer V','0756','Acting FIC',array('X','R','R','R','R','R','X')),
                                array('Julius Ruel D. Resquir','CNSS Officer V','1138','Ass.t FIC',array('X','R','R','R','R','R','X')),
                                array('Gilmar D. Tiro','CNSS Officer IV','7094','Shift Supervisor',array('X','D*','D*','D*','E*','M*','X')),
                                array('Allen Rey C. Covarrubias','CNSS Officer IV','0797','Shift Supervisor',array('D*','X','X','E*','M*','E*','M*')),
                                array('Albino L. Somido','CNSS Officer IV','1404','Shift Supervisor',array('D','E*','M*','X','X','E','M')),
                                array('Denverto S. Gonato','CNSS Officer III','1409','Shift Supervisor',array('E*','M*','X','X','D*','D*','D*')),
                                array('Ernam M. Tangalin','CNSS Officer III','4686','Shift Supervisor',array('M*','D','E*','M*','X','X','E*')),
                                array('Eric M. Valmores','CNSS Officer III','7126','',array('X','X','E','M','D','E','M')),
                                array('Florante B. Banaria','CNSS Officer III','7140','',array('E','M','D','E','M','X','X')),
                                array('Aldrin P. Ayuba','CNSS Officer III','7138','',array('M','D','D','D','X','X','E')),
                                array('Albert D. Opena','CNSS Officer III','5021','',array('D','D','X','X','E','M','D')),
                                array('Davey A. Jamera','CNSS Office II','7142','',array('M','E','M','X','X','D','E')),
                                array('Prescios Anne A. Dulay','CNSS Office II','5490','',array('M','E','M','X','X','D','E')),
                                array('Rapunzel P. Daniel','CNSS Office II','5489','',array('E','M','X','X','E','M','D')),
                                array('Lilet D. Balbuena','CNSS Office II','5498','',array('D','X','X','E','M','E','M')),
                                array('Harold D. Lopez','CNSS Office II','5495','',array('E','M','E','M','D','X','X')),
                                array('Patrick D. Sabia','CNSS Office I','5706','',array('X','E','M','E','M','D','X')),
                                array('Marc Jacob L. Macadato','CNSSO Assistant','6171','',array('D','D','X','X','D','D','D')),
                                array('Janiz Amasoli C. Suyko','ANSS Assistant','9595','',array('D','E','M','E','M','X','X')),
                                array('Kevin S. Wing Siong','ANSS Assistant','9591','',array('M','X','X','D','E','M','E')),
                                array('Cheryl L. Miquiabas','ANSS Assistant','9606','',array('X','D','E','M','E','M','X')),
                                array('Jerico V. Pereira','ANSS Assistant','9585','',array('X','X','E','M','D','E','M')),
                                array('Rachel B. Garcia','ANSS Assistant','9600','',array('X','X','D','D','D','E','M')),
                                array('Allan D. Valiente, JR.','ANSS Assistant','9593','',array('E','M','E','M','X','X','D')),
                                array('Floyddan A. Solomon','ANSS Assistant','9586','',array('D','D','X','X','D','D','D')),
                                array('Joseph C. Dela Cruz','ANSS Assistant','9673','',array('X','E','M','D','E','M','X')),
                                array('Jenycel L. Ranin','ANSS Assistant','9671','',array('D','X','X','E','M','E','M')),
                                array('Christian S. Lagman','ANSS Assistant','9668','',array('X','E','M','D','E','M','X')),
                                array('Karen Joy A. Anonuevo','ANSS Assistant','9674','',array('E','M','D','X','X','E','M')),
                                array('Charmaine Mae I. Sabado','ANSS Assistant','9672','',array('M','D','E','M','X','X','E')),
                                array('Camille Ann Rivero','ANSS Assistant','9670','',array('M','D','D','D','X','X','E')),
                                array('Bernardo M. Cabelic, JR.','ANSS Assistant','9669','',array('E','M','D','E','M','X','X')),
                                array('Jose Carlos M. Liria','ANSS Assistant','9407','',array('X','X','D','D','D','D','D'))
                            );
                            $days = array('su','m','t','w','th','f','sa');
                            ?>
                            
                            <?php if($view == 'list') { ?>
                                <table class="table table-bordered table-schedule">
                                    <tbody>
                                        <tr>
                                            <td rowspan="7" colspan="5" class="text-center" style="vertical-align:middle;font-size:200%;">The Schedule of Duty of Philippine Air Traffic Management Center ANS Personnel<br>effective August 1-31, 2018</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Su</th>
                                            <th class="text-center">Mo</th>
                                            <th class="text-center">Tu</th>
                                            <th class="text-center">We</th>
                                            <th class="text-center">Th</th>
                                            <th class="text-center">Fr</th>
                                            <th class="text-center">Sa</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">2</td>
                                            <td class="text-center">3</td>
                                            <td class="text-center">4</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="text-center">6</td>
                                            <td class="text-center">7</td>
                                            <td class="text-center">8</td>
                                            <td class="text-center">9</td>
                                            <td class="text-center">10</td>
                                            <td class="text-center">11</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">12</td>
                                            <td class="text-center">13</td>
                                            <td class="text-center">14</td>
                                            <td class="text-center">15</td>
                                            <td class="text-center">16</td>
                                            <td class="text-center">17</td>
                                            <td class="text-center">18</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">19</td>
                                            <td class="text-center">20</td>
                                            <td class="text-center">21</td>
                                            <td class="text-center">22</td>
                                            <td class="text-center">23</td>
                                            <td class="text-center">24</td>
                                            <td class="text-center">25</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">26</td>
                                            <td class="text-center">27</td>
                                            <td class="text-center">28</td>
                                            <td class="text-center">29</td>
                                            <td class="text-center">30</td>
                                            <td class="text-center">31</td>
                                            <td class="text-center"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        <tr>
                                            <th style="width:10px;">No</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th class="text-center">ID No.</th>
                                            <th>Remarks</th>
                                            <th colspan="7"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="12">CNS SYSTEMS OFFICERS</th>
                                        </tr>
                                        <?php
                                        $ctr = 1;
                                        foreach($records as $record) {
                                            echo '<tr>';
                                                echo '<td class="text-center">'.$ctr.'</td>';
                                                echo '<td>'.$record[0].'</td>';
                                                echo '<td>'.$record[1].'</td>';
                                                echo '<td class="text-center">'.$record[2].'</td>';
                                                echo '<td>'.$record[3].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][0] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][0].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][1] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][1].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][2] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][2].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][3] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][3].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][4] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][4].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][5] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][5].'</td>';
                                                
                                                echo '<td class="text-center';
                                                if($record[4][6] == 'X') { echo ' bg-black'; }
                                                echo '">'.$record[4][6].'</td>';
                                            
                                            echo '</tr>';
                                            $ctr++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-bordered table-schedule">
                                        <tr>
                                            <th>No.</th>
                                            <th style="width:50px;">ID#</th>
                                            <th style="width:150px;">Name</th>
                                            <th style="width:100px;">Position</th>
                                            <?php
                                            for($x=1;$x<=31;$x++) {
                                                echo '<th class="text-center">'.$x.'</th>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <?php
                                            $y = 3;
                                            for($x=1;$x<=31;$x++) {
                                                echo '<th class="text-center">'.$days[$y].'</th>';
                                                $y++;
                                                if($y > count($days)-1) {
                                                    $y = 0;
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td colspan="35">Traffic Management Specialist</td>
                                        </tr>
                                        <?php
                                        $ctr = 1;
                                        foreach($records as $record) {
                                            echo '<tr>';
                                                echo '<td>'.$ctr.'</td>';
                                                echo '<td>'.$record[2].'</td>';
                                                echo '<td>'.$record[0].'</td>';
                                                echo '<td>'.$record[1].'</td>';
                                                $y = 3;
                                                for($x=1;$x<=31;$x++) {
                                                    $cell_class = '';
                                                    if($record[4][$y] == 'X') {
                                                        $cell_class = ' bg-black';
                                                    }
                                                    echo '<td class="text-center'.$cell_class.'">'.$record[4][$y].'</td>';
                                                    $y++;
                                                    if($y > count($days)-1) {
                                                        $y = 0;
                                                    }
                                                }
                                            echo '</tr>';
                                            $ctr++;
                                        }
                                        ?>
                                    </table>
                                </div>
                            <?php } ?>
                    
                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection