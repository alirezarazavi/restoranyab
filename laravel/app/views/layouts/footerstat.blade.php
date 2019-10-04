<div class="container-fluid" id="footerstat">
	<div class="container">
		<div class="col-xs-4 newest">
			<!-- <img class="newest_img" src="/assets/images/trans.png"> -->
			{{HTML::image('/assets/images/trans.png', null, array('class' => 'newest_img'))}}
			<h4>جدیدترین رستوران‌ها</h4>
			<ul style="list-inline">
				@foreach ($placeStat as $p)
					<li><a href="restaurant/{{$p->url}}"><span>{{$p->title}}</span></a></li>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-4 popular">
			<!-- <img class="popular_img" src="/assets/images/trans.png"> -->
			{{HTML::image('/assets/images/trans.png', null, array('class' => 'popular_img'))}}
			<h4>محبوب‌ترین رستوران‌ها</h4>
			<ul style="list-inline">
				@foreach ($popular as $pop)
					@foreach ($placeStat as $place)
						@if ($place->id == $pop->place_id)
							<li>
								<a href="restaurant/{{$place->url}}">
									<span class="title">{{$place->title}}</span>
									<span class="dot"></span>
									<span class="count">{{$pop->total}}</span>
								</a>
							</li>
						@endif
					@endforeach
				@endforeach
			</ul>
		</div>
		<div class="col-xs-4 mostVisit">
			<!-- <img class="mostVisit_img" src="/assets/images/trans.png"> -->
			{{HTML::image('/assets/images/trans.png', null, array('class' => 'mostVisit_img'))}}
			<h4>پربازدیدترین رستوران‌ها</h4>
			<ul style="list-inline">
				@foreach ($visit as $visit)
					@foreach ($placeStat as $place)
						@if ($place->id == $visit->place_id)
							<li>
								<a href="restaurant/{{$place->url}}">
									<span class="title">{{$place->title}}</span>
									<span class="dot"></span>
									<span class="count">{{$visit->visit}} بازدید</span>
								</a>
							</li>
						@endif
					@endforeach
				@endforeach
			</ul>
		</div>
	</div>
</div>
