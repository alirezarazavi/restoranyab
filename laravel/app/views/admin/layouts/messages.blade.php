@if(Session::has('message-info'))
	<div class="message info"><h3>{{ Session::get('message-info') }}</h3><p>برای بسته شدن این پیغام کلیک کنید.</p></div>

@elseif(Session::has('message-error'))
	<div class="message error"><h3>{{ Session::get('message-error') }}</h3><p>برای بسته شدن این پیغام کلیک کنید.</p></div>

@elseif(Session::has('message-success'))
	<div class="message success"><h3>{{ Session::get('message-success') }}</h3><p>برای بسته شدن این پیغام کلیک کنید.</p></div>

@elseif($errors->has())
	<div class="message error {{ Session::get('alert-class', 'message-error') }}">
		@foreach ($errors->all() as $error) 
			<h3>{{ $error }}</h3>
		@endforeach
		<p>برای بسته شدن این پیغام کلیک کنید.</p>
	</div>
@endif