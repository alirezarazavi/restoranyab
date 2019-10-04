<div class="container">
	<div class="row">
		<div class="bottom_menu">
			<ul class="list-inline">
				@foreach ($menuMaker as $menu)
					@if ($menu->position == 'b')
						<li>
							{{--<a href="@if($menu->link !== '/')/@endif{{$menu->link}}">{{$menu->title}}</a>--}}
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
		<div class="copyright">
			<p>کلیه‌ی حقوق نزد وب سایت رستوران یاب محفوظ بوده و استفاده از مطالب با ذکر منبع بلامانع است &#169; 1392</p>
		</div>
	</div>
</div>