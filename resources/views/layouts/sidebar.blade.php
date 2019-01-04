
<aside class="main-sidebar">
<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
    <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">

        <!-- SIDEBAR HEADER -->
        <li class="header">MAIN NAVIGATION</li>

        <!-- DASHBOARD --> 
        <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>

        <!-- DAILY TIME RECORDS -->
        <li class="{{ Route::is('dtr') ? 'active' : '' }}">
            <a href="{{ route('dtr') }}"><i class="fa fa-clock-o"></i> <span>Daily Time Records</span></a>
        </li>

        <!-- TEAM SCHEDULE -->
        <li class="{{ Route::is('team-schedule') ? 'active' : '' }}">
            <a href="{{ route('team-schedule') }}"><i class="fa fa-calendar"></i> <span>Team Schedule</span></a>
        </li>
    
        <!-- COMPANY -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-building"></i>
                <span>Company</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Calendar</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Departments</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Teams</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Roles</a></li>
            </ul>
        </li>

        <!-- SYSTEM LOG -->
        {{-- <li class="{{ Route::is('system-log') ? 'active' : '' }}">
            <a href="{{ route('system-log') }}"><i class="fa fa-book"></i> <span>System Log</span></a>
        </li> --}}

    </ul>
</section>
</aside>