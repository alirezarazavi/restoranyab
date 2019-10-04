<!DOCTYPE html>
<html lang="fa">
<head>
	<title>رستوران یاب | {{ $title }}</title>
	{{ HTML::script('assets/scripts/jquery-1.11.0.min.js') }}
	{{ HTML::script('assets/scripts/bootstrap.min.js') }}
	{{ HTML::script('assets/scripts/jquery.BlackAndWhite.min.js') }}
	{{-- {{ HTML::script('assets/scripts/cbpTooltipMenu.min.js') }} --}}
	{{ HTML::script('assets/scripts/script.js') }}
	{{ HTML::style('assets/styles/style.less', array('rel' => 'stylesheet/less')) }}
	{{ HTML::script('assets/scripts/less-1.7.0.min.js') }}
	{{ HTML::style('assets/styles/bootstrap.min.css') }}
	<!-- Checkbox plugin -->
	{{ HTML::style('assets/styles/red.css') }}
	{{ HTML::script('assets/scripts/icheck.min.js') }}
	<!-- Rating plugin -->
	{{ HTML::script('assets/scripts/jquery.raty.min.js') }}
	<!--[if IE]><script type="text/javascript" src="assets/scripts/excanvas.js"></script><![endif]-->
	{{ HTML::script('assets/scripts/jquery.knob.js') }}

	<!-- Google Map -->
	{{ HTML::script('assets/scripts/google.map.api.js') }}
	{{ HTML::script('assets/scripts/markerclusterer.js') }}
	<link rel="icon" href="{{asset('/assets/images/logo.png')}}">
</head>
<body>
<header>
	<!-- NAVIGATION -->
	@include('layouts.nav')
	<!-- HEADER -->
	@include('layouts.header')
	<!-- Messages -->
	@include('layouts.messages')
</header>

<section>
	<div class="container-fluid">
		<div class="row">
			<!-- Content -->
			@yield('content')
	 	</div>
	 </div>
</section>

<footer>
	<!-- FOOTER -->
	@include('layouts.footer')
</footer>
</body>
</html>
