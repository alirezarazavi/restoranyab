<div class="container-fluid showOnMap">
	<div class="container">
		<ul class="list-inline">
			<li>لیست رستوران‌های موجود در تهران</li>
			@if (Route::is('map'))
				<li><a href="{{URL::route('restaurant')}}">نمایش به صورت لیست</a></li>
			@else
				<li><a href="{{URL::route('map')}}">نمایش بر روی نقشه</a></li>
			@endif
		</ul>
	</div>
</div>