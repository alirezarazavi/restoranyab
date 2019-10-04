@if(Session::has('alert-info'))
	<div class="alert alert-dismissable alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h3>{{ Session::get('alert-info') }}</h3>
	</div>

@elseif(Session::has('alert-error'))
	<div class="alert alert-dismissable alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h3>{{ Session::get('alert-error') }}</h3>
	</div>

@elseif(Session::has('alert-success'))
	<div class="alert alert-dismissable alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h3>{{ Session::get('alert-success') }}</h3>
	</div>

@elseif($errors->has())

	<p class="alert alert-dismissable {{ Session::get('alert-class', 'alert-danger') }}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		@foreach ($errors->all() as $error) {{ $error }} <br /> @endforeach
	</p>

@endif