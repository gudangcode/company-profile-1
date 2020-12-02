<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>{{$bs->website_title}}</title>
	<link rel="icon" href="{{asset('assets/front/img/favicon.jpg')}}">
	@includeif('admin.partials.styles')
	@yield('styles')
</head>
<body data-background-color="dark">
	<div class="wrapper">

    {{-- top navbar area start --}}
    @includeif('admin.partials.top-navbar')
    {{-- top navbar area end --}}


    {{-- side navbar area start --}}
    @includeif('admin.partials.side-navbar')
    {{-- side navbar area end --}}


		<div class="main-panel">
			<div class="content">
        <div class="page-inner">
          @yield('content')
        </div>
			</div>
      @includeif('admin.partials.footer')
		</div>

	</div>

	@includeif('admin.partials.scripts')
	@yield('styles')
</body>
</html>
