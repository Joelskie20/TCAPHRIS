<!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>HR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>HRIS</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      {{-- <a href="#" class="pull-left btn btn-default btn-sm" style="margin:10px;"><i class="fa fa-clock-o"></i> TIME IN</a> --}}
      @if($disabled == false)
      <form method="POST" action="{{ action('DashboardController@store') }}">
        @csrf
        <button class="pull-left btn btn-default btn-sm" style="margin:10px;"><i class="fa fa-clock-o"></i> TIME IN</button>
      </form>
      @else
      <form method="POST" action="{{ action('DashboardController@update', ['id' => Auth::user()->id ]) }}">
        @method('PUT')
        @csrf
        <button class="pull-left btn btn-default btn-sm" style="margin:10px;"><i class="fa fa-clock-o"></i> TIME OUT</button>
      </form>
      @endif
      <div class="pull-left" style="margin:15px; color:#fff;">
        <i style="margin-right: 5px;" class="fa fa-calendar"></i>{{  Carbon::parse(Carbon::now())->format('F d, Y') }}
        <i class="fa fa-clock-o" style="margin-left: 15px; margin-right: 5px;"></i><p class="display-time"></p></div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications Menu -->
          {{-- <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> --}}

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->firstNameFirst() }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->firstNameFirst() }} - {{ Auth::user()->getPosition() }}
                  <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
              <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="/employee/{{ Auth::user()->id }}" class="btn btn-default btn-flat">Profile</a>
                  </div>

                  <div class="col-xs-4">
                    <a href="/settings" class="btn btn-default btn-flat">Settings</a>
                  </div>

                  <div class="col-xs-4">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  </div>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
                
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>