<div class="container-fluid orderBy">
	<div class="container">
		<ul class="list-inline">
			<li>نمایش رستوران‌ها براساس:</li>
			<li @if (route::is('restaurant')) class="active" @endif>
				<a href="{{URL::route('restaurant')}}"><span class="glyphicon glyphicon-list"></span>لیست</a>
			</li>
			<li @if (route::is('map')) class="active" @endif>
				<a href="{{URL::route('map')}}"><span class="glyphicon glyphicon-map-marker"></span>نقشه</a>
			</li>
		</ul>
	</div>
</div>