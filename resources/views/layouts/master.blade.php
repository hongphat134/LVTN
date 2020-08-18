@include('layouts.header')
@if(Auth::check())
	@if(Auth::user()->loaitk == 1) @include('ntd_layouts.menu')
	@else(Auth::user()->loaitk == 0) @include('ntv_layouts.menu')
	@endif
@else @include('layouts.menu')
@endif

@yield('content')

@include('layouts.footer')