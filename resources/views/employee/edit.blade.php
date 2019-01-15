@extends('layouts.master')

@section('title', 'Edit Employee')

@section('styles')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h1>Edit Employee</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ action('EmployeeController@update', ['id' => $user->id]) }}">
            @method('PATCH')
            @csrf
            <!-- EMPLOYEE INFORMATION -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Employee Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">

                        <!-- EMPLOYEE ID -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="employeeID">Employee ID <small class="label label-success">Required</small></label>
                                <input type="text" maxlength="7" class="form-control" placeholder="2170043" id="employee_id" name="employee_id" data-inputmask="&quot;mask&quot;: &quot;9999999&quot;" data-mask="" value="{{ $user->employee_id == 0 ? '' : $user->employee_id }}">
                            </div>
                        </div>

                        <!-- POSITION -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="positionID">Position <small class="label label-success">Required</small></label>
                                <select class="form-control" id="positionID" name="position_id">
                                <option value="0">-- None --</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ $position->id == $user->position_id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- DEPARTMENT -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="departmentID">Department <small class="label label-success">Required</small></label>
                                <select class="form-control" id="departmentID" name="department_id" >
                                    <option value="0">-- None --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $user->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach										
                                </select>
                            </div>
                        </div>

                        <!-- TEAM -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="teamID">Team <small class="label label-success">Required</small></label>
                                <select class="form-control" id="teamID" name="team_id" >
                                    <option value="0" class="opt-none">-- None --</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $team->id == $user->team_id ? 'selected' : '' }}>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- BASE SALARY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="baseSalary">Base Salary <small class="label label-danger">Required</small></label>
                                <input type="text" maxlength="20" class="form-control number-format" id="baseSalary" name="base_salary" value="{{ number_format($user->base_salary, 2,'.',',') }}">
                            </div>
                        </div>

                        <!-- TAX STATUS -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="taxStatus">Tax Status <small class="label label-success">Required</small></label>
                                <select class="form-control" id="taxStatus" name="tax_status" >
                                    <option value="s" {{ $user->tax_status == 's' ? 'selected' : '' }}>Single</option><option value="s1" {{ $user->tax_status == 's1' ? 'selected' : '' }}>Single with 1 dependent</option><option value="s2" {{ $user->tax_status == 's2' ? 'selected' : '' }}>Single with 2 dependent</option><option value="s3" {{ $user->tax_status == 's3' ? 'selected' : '' }}>Single with 3 dependent</option><option value="s4" {{ $user->tax_status == 's4' ? 'selected' : '' }}>Single with 4 dependent</option><option value="m" {{ $user->tax_status == 'm' ? 'selected' : '' }}>Married</option><option value="m1" {{ $user->tax_status == 'm1' ? 'selected' : '' }}>Married with 1 dependent</option><option value="m2" {{ $user->tax_status == 'm2' ? 'selected' : '' }}>Married with 2 dependent</option><option value="m3" {{ $user->tax_status == 'm3' ? 'selected' : '' }}>Married with 3 dependent</option><option value="m4" {{ $user->tax_status == 'm4' ? 'selected' : '' }}>Married with 4 dependent</option><option value="hf" {{ $user->tax_status == 'hf' ? 'selected' : '' }}>Head of the Family</option>
                                </select>
                            </div>
                        </div>

                        <!-- PAYMENT FREQUENCY-->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="paymentFrequency">Payment Frequency <small class="label label-success">Required</small></label>
                                <select class="form-control" id="paymentFrequency" name="payment_frequency" >
                                    <option value="monthly" {{ $user->payment_frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="daily" {{ $user->payment_frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                                </select>
                            </div>
                        </div>

                        <!-- HIRE DATE -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="hiredate">Hire Date <small class="label label-danger">Required</small></label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="hiredate" name="hire_date" placeholder="mm/dd/yyyy" class="form-control pull-right datepicker" value="{{ Carbon::parse($user->hire_date)->format('m/d/Y') }}">
                                </div>
                            </div>
                        </div>

                        <!-- DIRECT MANAGER -->
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="managerID">Direct Manager</label>
                                <select class="form-control select2 w100p" id="managerID" name="direct_manager_id">
                                    <option value="0">-- To Follow --</option>
                                    @foreach($employees as $employee)
                                        @if($employee->getPosition() == 'Manager')
                                            <option value="{{ $employee->id }}" {{ $employee->id == $user->direct_manager_id ? 'selected' : '' }}>[{{ $employee->employee_id }}] {{ $employee->name }} ({{ $employee->getTeam() }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                        <div class="row">

                            <!-- WORKSHIFT -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="workshift">Workshift <small class="label label-success">Required</small></label>
                                    <select class="form-control" id="workshift" name="workshift_id" >
                                    @foreach($workshifts as $workshift)
                                        <option value="{{ $workshift->id }}" {{ $workshift->id == $user->workshift_id ? 'selected' : '' }}>[{{ $workshift->code }}] {{ $workshift->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row workshift-selected">
                            <div class="col-xs-12 table-responsive">
                            <table id="employeeTable" class="table table-bordered table-striped data-list" role="grid">
                                <tbody>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Remarks</th>
                                    </tr>
                                    <tr id="w2" data-id="2"><td><a title="MRG-MF-6A3P-SSR" href="#">MRG-MF-6A3P-SSR</a></td><td><a title="Morning Monday-Friday 6AM-3PM Sat-Sun Restday" href="#">Morning Monday-Friday 6AM-3PM Sat-Sun Restday</a></td><td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 6:00 - 15:00</span><br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> 8.0</span></td><td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 6:00 - 15:00</span><br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> 8.0</span></td><td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 6:00 - 15:00</span><br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> 8.0</span></td><td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 6:00 - 15:00</span><br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> 8.0</span></td><td><span title="Time Schedule"><small class="icon"><i class="fa fa-clock-o text-gray"></i></small> 6:00 - 15:00</span><br><span title="Work Hours"><small class="icon"><i class="fa fa-bolt text-yellow"></i></small> 8.0</span></td><td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td><td><span class="text-green" title="Rest Day"><small class="icon"><i class="fa fa-coffee"></i></small> <small>REST DAY</small></span></td><td></td></tr>			</tbody></table>
                            </div>
                        </div>
                </div>
            </div><!-- /employee information -->

            <!-- PERSONAL INFORMATION -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Personal Information</h3>
                </div>
                <div class="box-body">
                    <div class="row">

                        <!-- FIRSTNAME -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="firstname">First Name <small class="label label-danger">Required</small></label>
                                <input type="text" maxlength="50" class="form-control" id="firstname" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>

                        <!-- MIDDLENAME -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text" maxlength="50" class="form-control" id="middlename" name="middle_name" value="{{ $user->middle_name }}">
                            </div>
                        </div>

                        <!-- LASTNAME -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="lastname">Last Name <small class="label label-danger">Required</small></label>
                                <input type="text" maxlength="50" class="form-control" id="lastname" name="last_name" value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <!-- BIRTHDATE -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="hiredate">Birth Date <small class="label label-danger">Required</small></label>
                                <div class="input-group date" data-provide="datepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="birthDate" name="birth_date" class="form-control pull-right datepicker" value="{{ Carbon::parse($user->birth_date)->format('m/d/Y') }}">
                                </div>
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="gender">Gender <small class="label label-success">Required</small></label>
                                <select class="form-control" id="gender" name="gender_id" >
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}" {{ $gender->id == $user->gender_id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- NATIONALITY -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="nationality">Nationality <small class="label label-danger">Required</small></label>
                                <input type="text" maxlength="50" class="form-control" id="nationality" name="nationality" value="{{ $user->nationality }}">
                            </div>
                        </div>

                        <!-- RELIGION -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <input type="text" maxlength="50" class="form-control" id="religion" name="religion" value="{{ $user->religion }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- /personal information -->

            <!-- CONTACT DETAILS -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Contact Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">

                            <h5>PRESENT ADDRESS</h5>

                            <div class="present-address">

                                <!-- UNIT NUMBER -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_unitNumber">Unit Number <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="present_unitNumber" name="present_unit_number"">
                                    </div>
                                </div>

                                <!-- BUILDING NAME -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_buildingName">Building Name</label>
                                        <input type="text" maxlength="50" class="form-control" id="present_buildingName" name="present_building_name"">
                                    </div>
                                </div>

                                <!-- STREET NAME -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_streetName">Street Name <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="present_streetName" name="present_street_name"">
                                    </div>
                                </div>

                                <!-- SUBDIVISION -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_subdivision">Subdivision</label>
                                        <input type="text" maxlength="50" class="form-control" id="present_subdivision" name="present_subdivision"">
                                    </div>
                                </div>

                                <!-- BARANGAY -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_barangay">Barangay <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="present_barangay" name="present_barangay_id" >
                                    </div>
                                </div>

                                <!-- CITY -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_city">City <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="present_city" name="present_city_id">
                                    </div>
                                </div>

                                <!-- PROVINCE/STATE -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_provinceState">Province/State <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="present_province" name="present_province_id">
                                    </div>
                                </div>

                                <!-- COUNTRY -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_country">Country <small class="label label-success">Required</small></label>
                                        <select id="present_country" name="present_country" class="form-control">
                                            <option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote D'ivoire">Cote D'ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines" selected="">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-leste">Timor-leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>												</select>
                                    </div>
                                </div>

                                <!-- ZIP CODE -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="present_zipcode">ZIP Code</label>
                                        <input type="number" maxlength="50" class="form-control" id="present_zipcode" name="present_zipcode_id">
                                    </div>
                                </div>

                            </div>

                            <h5>PERMANENT ADDRESS</h5>
                                <div class="form-group">
                                    <label class="icheck-label sameWithPresentAddress">
                                        <input type="checkbox" class="flat-green" checked>
                                        <span class="ml05 mt02 pull-right">Same with present address</span>
                                    </label>
                                    <input type="hidden" name="sameWithPresentAddress" id="sameWithPresentAddress" value="1">
                                </div>
                            <div class="permanent-address">

                                <!-- UNIT NUMBER -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_unitNumber">Unit Number <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_unitNumber" name="permanent_unit_number">
                                    </div>
                                </div>

                                <!-- BUILDING NAME -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_buildingName">Building Name</label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_buildingName" name="permanent_building_name">
                                    </div>
                                </div>

                                <!-- STREET NAME -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_streetName">Street Name <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_streetName" name="permanent_street_name">
                                    </div>
                                </div>

                                <!-- SUBDIVISION -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_subdivision">Subdivision</label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_subdivision" name="permanent_subdivision">
                                    </div>
                                </div>

                                <!-- BARANGAY -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_barangay">Barangay <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_barangay" name="permanent_barangay_id">
                                    </div>
                                </div>

                                <!-- CITY -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_city">City <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_city" name="permanent_city_id">
                                    </div>
                                </div>

                                <!-- PROVINCE/STATE -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_provinceState">Province/State <small class="label label-danger">Required</small></label>
                                        <input type="text" maxlength="50" class="form-control" id="permanent_provinceState" name="permanent_province_id">
                                    </div>
                                </div>

                                <!-- COUNTRY -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_country">Country <small class="label label-success">Required</small></label>
                                        <select name="permanent_country" id="permanent_country" class="form-control" >
                                            <option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote D'ivoire">Cote D'ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines" selected="">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-leste">Timor-leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>												</select>
                                    </div>
                                </div>

                                <!-- ZIP CODE -->
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="permanent_zipcode">ZIP Code</label>
                                        <input type="number" maxlength="50" class="form-control" id="permanent_zipcode" name="permanent_zipcode_id">
                                    </div>
                                </div>

                            </div>

                            <h5>OTHER CONTACT DETAILS</h5>

                            <!-- EMAIL -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" maxlength="50" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <!-- MOBILE -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile <small class="label label-danger">Required</small></label>
                                    <input type="text" maxlength="50" class="form-control" id="mobile" name="mobile_number" value="{{ $user->mobile_number }}">
                                </div>
                            </div>

                            <!-- LANDLINE -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="landline">Landline</label>
                                    <input type="text" maxlength="50" class="form-control" id="landline" name="landline" value="{{ $user->landline }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- GOVERNMENT DETAILS -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Government Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- TIN -->
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="tin">TIN</label>
                                    <input type="text" maxlength="20" class="form-control" id="tin" name="tin_number" data-inputmask="&quot;mask&quot;: &quot;999-999-999-999&quot;" data-mask="" value="{{ $user->tin_number }}">
                                </div>
                            </div>

                            <!-- SSS -->
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="sss">SSS</label>
                                    <input type="text" maxlength="50" class="form-control" id="sss" name="sss_number" value="{{ $user->sss_number }}">
                                </div>
                            </div>

                            <!-- PHILHEATH -->
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="philhealth">PhilHealth</label>
                                    <input type="text" maxlength="50" class="form-control" id="philhealth" name="philhealth_number" value="{{ $user->philhealth_number }}">
                                </div>
                            </div>

                            <!-- HDMF -->
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label for="hdmf">Pag-Ibig</label>
                                    <input type="text" maxlength="50" class="form-control" id="hdmf" name="pagibig_number" value="{{ $user->pagibig_number }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-options mb20 clearfix">
                <a href="/employees" class="btn btn-default pull-right">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right mr05">Add Employee</button>
            </div>

        </form>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
    $(function() {

        $('input.number-format').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40){
                event.preventDefault();
            }
            $(this).val(function(index, value) {
                value = value.replace(/,/g,'');
                return numberWithCommas(value);
            });
        });

        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy'
        });

        $('#workshift').change(function() {
            
            console.log($(this).find(':selected').val())
        });

    });
</script>
@endsection