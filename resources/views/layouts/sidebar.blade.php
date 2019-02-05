
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
        <li class="{{ (Route::is('employees') || Route::is('employee-create') || Route::is('employee-profile')) ? 'active' : '' }}">
            <a href="{{ route('employees') }}"><i class="fa fa-users"></i> <span>Employee Records</span></a>
        </li>
        @endcan

        @can('daily time records')
        <!-- DAILY TIME RECORDS -->
        <li class="{{ (Route::is('dtr') || Route::is('dtr-profile')) ? 'active' : '' }}">
            <a href="{{ route('dtr') }}"><i class="fa fa-clock-o"></i> <span>Daily Time Records</span></a>
        </li>
        @endcan

        @can('workshifts')
        <!-- WORKSHIFT -->
        <li class="{{ Route::is('workshift') ? 'active' : '' }}">
            <a href="{{ route('workshift') }}"><i class="fa fa-sitemap"></i> <span>Workshift</span></a>
        </li>
        @endcan

        <!-- Overtime -->
        <li class="{{ Route::is('overtime') ? 'active' : '' }}">
            <a href="{{ route('overtime') }}"><i class="fa fa-hourglass"></i> <span>Overtime</span></a>
        </li>

        @can('holidays')
        <!-- COMPANY CALENDAR -->
        <li class="{{ Route::is('holiday') ? 'active' : '' }}">
            <a href="{{ route('holiday') }}"><i class="glyphicon glyphicon-calendar"></i> <span>Company Calendar</span></a>
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
                        <span class="label label-warning ml05">{{ App\Leave::where('status', 'forApproval')->get()->count() }}</span>
                    @else
                        {{ '' }}
                    @endif
                </a></li>
                @endcan

                @can('approved leaves')
                <li><a href="{{ route('approved-leaves') }}"><i class="fa fa-calendar-check-o"></i>Approved Leaves</a></li>
                @endcan

                @can('denied leaves')
                <li><a href="{{ route('denied-leaves') }}"><i class="fa fa-calendar-times-o"></i>Denied Leaves</a></li>
                @endcan

                @can('can approve leaves')
                <li><a href="{{ route('approving-leaves') }}"><i class="fa fa-check"></i>For Your Approval
                @if(App\Leave::where('direct_manager_id', Auth::id())->where('status', 'forApproval')->get()->count() > 0)
                        <span class="label label-warning ml05">{{ App\Leave::where('status', 'forApproval')->get()->count() }}</span>
                    @else
                        {{ '' }}
                    @endif
                </a></li>
                @endcan
                
            </ul>
        </li>
        @endcan

        <!-- TEAM SCHEDULE -->
        {{-- <li class="{{ Route::is('team-schedule') ? 'active' : '' }}">
            <a href="{{ route('team-schedule') }}"><i class="fa fa-calendar"></i> <span>Team Schedule</span></a>
        </li> --}}

        @can('system settings')
        <!-- COMPANY -->
        <li class="treeview {{ (Route::is('departments') || Route::is('teams') || Route::is('positions') || Route::is('roles')) ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-gears"></i>
                <span>System Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- <li><a href="#"><i class="fa fa-calendar"></i>Calendar</a></li> --}}
                @can('departments')
                <li><a href="{{ route('departments') }}"><i class="fa fa-briefcase"></i>Departments</a></li>
                @endcan
                
                @can('teams')
                <li><a href="{{ route('teams') }}"><i class="fa fa-users"></i>Teams</a></li>
                @endcan

                @can('positions')
                <li><a href="{{ route('positions') }}"><i class="fa fa-black-tie"></i>Positions</a></li>
                @endcan

                @hasanyrole('admin|superadmin')
                <li><a href="{{ route('roles') }}"><i class="fa fa-user-circle-o"></i>Roles</a></li>
                @endhasanyrole
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