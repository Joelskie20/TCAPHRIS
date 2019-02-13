
<aside class="main-sidebar">
<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
    <div class="pull-left image">
        <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{ Auth::user()->firstNameFirst() }}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">

        <!-- SIDEBAR HEADER -->
        <li class="header">MAIN NAVIGATION</li>

        @can('dashboard')
        <!-- DASHBOARD --> 
        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        @endcan

        @can('employee records')
        <!-- EMPLOYEES -->
        <li class="{{ Request::is('employee*') ? 'active' : '' }}">
            <a href="{{ route('employees') }}"><i class="fa fa-users"></i> <span>Employee Records</span></a>
        </li>
        @endcan

        @can('daily time records')
        <!-- DAILY TIME RECORDS -->
        <li class="{{ Request::is('daily-time-records*') ? 'active' : '' }}">
            <a href="{{ route('dtr') }}"><i class="fa fa-clock-o"></i> <span>Daily Time Records</span></a>
        </li>
        @endcan

        @can('workshifts')
        <!-- WORKSHIFT -->
        <li class="{{ Request::is('workshift*') ? 'active' : '' }}">
            <a href="{{ route('workshift') }}"><i class="fa fa-sitemap"></i> <span>Workshift</span></a>
        </li>
        @endcan

        @can('leaves')
        <!-- LEAVES -->
        <li class="treeview {{ Route::is('approved-leaves') || Route::is('denied-leaves') || Route::is('leaves-for-approval') || Route::is('approving-leaves') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Leaves</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @can('leaves for approval')
                <li><a href="{{ route('leaves-for-approval') }}"><i class="fa fa-calendar-plus-o"></i>Leaves for Approval 
                    @if(App\Leave::where('user_id', Auth::id())->where('status', 'forApproval')->get()->count() > 0)
                        <span class="label label-warning ml05">{{ App\Leave::where('user_id', Auth::id())->where('status', 'forApproval')->get()->count() }}</span>
                    @else
                        {{ '' }}
                    @endif
                </a></li>
                @endcan

                @can('approved leaves')
                <li><a href="{{ route('approved-leaves') }}"><i class="fa fa-calendar-check-o"></i>Approved</a></li>
                @endcan

                @can('denied leaves')
                <li><a href="{{ route('denied-leaves') }}"><i class="fa fa-calendar-times-o"></i>Denied</a></li>
                @endcan

                @can('can approve leaves')
                <li><a href="{{ route('approving-leaves') }}"><i class="fa fa-check"></i>For Your Approval
                    @if(App\Leave::where('direct_manager_id', Auth::id())->where('status', 'forApproval')->get()->count() > 0)
                        <span class="label label-warning ml05">{{ App\Leave::where('user_id', Auth::id())->where('status', 'forApproval')->get()->count() }}</span>
                    @else
                        {{ '' }}
                    @endif
                </a></li>
                @endcan
                
            </ul>
        </li>
        @endcan

        <!-- OVERTIME -->
        <li class="treeview {{ Route::is('approved-overtimes') || Route::is('denied-overtimes') || Route::is('overtimes-for-approval') || Route::is('approving-overtimes') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Overtime</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('overtimes-for-approval') }}"><i class="fa fa-calendar-plus-o"></i>For Approval 
                    @if(App\Overtime::where('user_id', Auth::id())->where('status', 'forApproval')->get()->count() > 0)
                        <span class="label label-warning ml05">{{ App\Overtime::where('user_id', Auth::id())->where('status', 'forApproval')->get()->count() }}</span>
                    @else
                        {{ '' }}
                    @endif
                </a></li>
                <li><a href="{{ route('approved-overtimes') }}"><i class="fa fa-calendar-check-o"></i>Approved</a></li>
                <li><a href="{{ route('denied-overtimes') }}"><i class="fa fa-calendar-times-o"></i>Denied</a></li>
                <li><a href="{{ route('approving-overtimes') }}"><i class="fa fa-check"></i>For Your Approval 
                    @if(App\Overtime::where('direct_manager_id', Auth::id())->where('status', 'forApproval')->get()->count() > 0)
                        <span class="label label-warning ml05">{{ App\Overtime::where('direct_manager_id', Auth::id())->where('status', 'forApproval')->get()->count() }}</span>
                    @else
                        {{ '' }}
                    @endif
                </a></li>
                
            </ul>
        </li>

        <!-- TEAM SCHEDULE -->
        {{-- <li class="{{ Route::is('team-schedule') ? 'active' : '' }}">
            <a href="{{ route('team-schedule') }}"><i class="fa fa-calendar"></i> <span>Team Schedule</span></a>
        </li> --}}

        @can('system settings')
        <!-- COMPANY -->
        <li class="treeview {{ (Route::is('divisions') || Route::is('teams') || Route::is('positions') || Route::is('roles') || Route::is('accounts') || Route::is('holiday') || Route::is('job-codes')) ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-gears"></i>
                <span>System Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">

                <li><a href="{{ route('divisions') }}"><i class="fa fa-briefcase"></i>Divisions</a></li>
                
                @can('teams')
                <li><a href="{{ route('teams') }}"><i class="fa fa-users"></i>Teams</a></li>
                @endcan

                <li><a href="{{ route('accounts') }}"><i class="fa fa-user"></i>Accounts</a></li>
                <li><a href="{{ route('job-codes') }}"><i class="fa fa-user"></i>Job Codes</a></li>

                @can('positions')
                <li><a href="{{ route('positions') }}"><i class="fa fa-black-tie"></i>Positions</a></li>
                @endcan

                @hasanyrole('admin|superadmin')
                <li><a href="{{ route('roles') }}"><i class="fa fa-user-circle-o"></i>Roles</a></li>
                @endhasanyrole
                
                @can('holidays')
                <li><a href="{{ route('holiday') }}"><i class="glyphicon glyphicon-calendar"></i>Company Calendar</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('system log')
        <!-- SYSTEM LOG -->
        <li class="{{ Route::is('system-log') ? 'active' : '' }}">
                <a href="{{ route('system-log') }}"><i class="fa fa-book"></i> <span>System Log</span></a>
            </li>
        @endcan

    </ul>
</section>
</aside>