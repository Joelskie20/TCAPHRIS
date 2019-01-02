<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
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
    <li class="header">MAIN NAVIGATION</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ Route::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="{{ Route::is('dtr') ? 'active' : '' }}"><a href="{{ route('dtr') }}"><i class="fa fa-calendar"></i> <span>Daily Time Records</span></a></li>
    {{-- <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="#">Link in level 2</a></li>
        <li><a href="#">Link in level 2</a></li>
        </ul>
    </li> --}}
    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>