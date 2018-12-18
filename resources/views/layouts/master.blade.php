@include('layouts.header')

<div class="wrapper">

  @include('layouts.main-header')

  @include('layouts.sidebar')

    @yield('content')

  @include('layouts.main-footer')

  @include('layouts.control-sidebar')

</div>

@include('layouts.footer')