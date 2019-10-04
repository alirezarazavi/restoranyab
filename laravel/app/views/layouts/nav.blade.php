<nav class="navbar navbar-static-top" role="navigation">
	<div class="container">
		<ul class="nav navbar-nav col-xs-12">
			@if (Auth::check()) 
				<li class="navbar-left {{ Request::is('signout') ? 'active' : ''; }}"><a href="{{ URL::route('signout'); }}" >خروج</a></li>
				@if (Auth::user()->role == 'admin')
					<li class="navbar-left"><a href="{{ URL::route('admin'); }}" target="_blank" >خوش آمدید {{Auth::user()->username}}</a></li>
				@else
					<li class="navbar-left"><a href="#" target="blank" >خوش آمدید {{Auth::user()->username}}</a></li>
				@endif
			@else
				<li class="navbar-left {{ Request::is('signin') ? 'active' : ''; }}"><a href="{{ URL::route('signin'); }}" >ورود</a></li>
				<li class="navbar-left {{ Request::is('signup') ? 'active' : ''; }}"><a href="{{ URL::route('signup'); }}" >ثبت نام</a></li>
			@endif
			@foreach ($menuMaker as $menu) 
				@if ($menu->position == 't')
					<li class="navbar-right {{Request::is($menu->link) ? 'active' : ''; }}">
					{{--<!-- @if($menu->link !== '/')/@endif -->--}}
						@if($menu->link == '/')
							{{link_to_route('home', 'خانه')}}
						@else
							{{link_to($menu->link, $menu->title)}}
						@endif
					</li>
				@endif
			@endforeach
		</ul>
	</div>
</nav>