@include('layouts.header')

<div class="wrapper">

  @include('layouts.main-header')

  @include('layouts.sidebar')

    @yield('content')

  {{-- @include('layouts.main-footer') --}}

</div>

@include('layouts.footer')