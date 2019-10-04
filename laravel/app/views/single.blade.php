@extends('layouts.master')
@section('content')

<div id="single">
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<ul class="list-inline">
					<li><h2>{{$place->title}}</h2></li>
					@if (route::is('profile.map'))
						<li><a href="{{URL::previous()}}">بازگشت
						{{HTML::image('/assets/images/place_arrow.png')}}</a></li>
					@else
						<li><a href="{{URL::route('restaurant')}}">بازگشت
						{{HTML::image('/assets/images/place_arrow.png')}}</a></li>
					@endif
				</ul>
			</div>
			<div id="place">
				@if (Route::is('profile.map'))
					<div class="place_full_map">
						<div id="map">
							<script type="text/javascript">
								function initMap() {
									var lat = {{ $place->lat }};
									var long = {{ $place->long }};
									var map = new google.maps.Map(document.getElementById('map'), {
										zoom: 15,
										// center: new google.maps.LatLng(lat, long),
										center: {lat: lat, lng: long},
										mapTypeId: google.maps.MapTypeId.ROADMAP,
										mapTypeControl: false,
										streetViewControl: false,
									});
									var infowindow = new google.maps.InfoWindow();
									var marker, i;
									marker = new google.maps.Marker({
										// position: new google.maps.LatLng(lat, long),
										position: {lat: lat, lng: long},
										map: map
									});
								}
							</script>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqR3GeWC7x8XYCNNRdZEHO1trW_-Pmf0M&callback=initMap"
							    async defer></script>
						</div>
					</div>
				@else
					<div class="place_pictures">
						<div class="cover pull-left">
							{{HTML::image('/uploads/places/'.$place->cover.'')}}
						</div>
						<div class="pictures">
							@foreach($pictures as $picture)
								@if($picture->place_id == $place->id)
									@if($picture->picture != $place->cover && $picture->picture != $place->logo)
										{{HTML::image('/uploads/places/'.$picture->picture.'')}}
									@endif
								@endif
							@endforeach
						</div>
					</div>
					<div class="place_fields">
						<h4>مشخصات این رستوران:</h4>
						<ul class="list-inline">
							@foreach($fields as $field)
								@foreach($placeFields as $placeField)
									@if($placeField->field_id == $field->id && $placeField->place_id == $place->id)
										<li>
											{{HTML::image('/uploads/fields/'.$field->icon.'', $field->title)}}:
											<span>{{$placeField->description}}</span>
										</li>
									@endif
								@endforeach
							@endforeach
							<li>
								<img src=""/>آخرین به‌روزرسانی:
								<span>{{jDate::forge($place->updated_at)->format('%d %B %y')}}</span>
							</li>
						</ul>
					</div>
					<div class="place_menu">
						<h4>منوی رستوران:</h4>
						@foreach($menuCats as $menu)
							@if($menu->place_id == $place->id)
								<ul>
									<h6>{{$menu->title}}</h6>
									@foreach($menuItems as $item)
										@if($item->menu_cat_id == $menu->id)
											<li>{{$item->title}}<span class="pull-left">{{$item->price}}</span></li>
										@endif
									@endforeach
								</ul>
							@endif
						@endforeach
					</div>
				@endif
			</div>
		</div>
		<div class="col-xs-2" id="sidebar">
			<div class="place_logo">
				{{HTML::image('/uploads/places/'.$place->logo.'')}}
			</div>
			@if ($place->site)
				<div class="place_site">
					<a href="http://www.{{$place->site}}" target="_blank">وب سایت رستوران</a>
				</div>
			@endif
			<div class="place_fav">

				@if (!Auth::check())
					<a href="#" class="prevent">افزودن به علاقه‌مندی‌ها</a>
				@else
					@if ($statFav)
						<a href="#" id="fav" class="remove_fav">حذف از علاقه‌مندی‌ها
						</a>
					@else
						<a href="#" id="fav" class="add_fav">افزودن به علاقه‌مندی‌ها
						</a>
					@endif
				@endif

			</div>
			<hr>

			<div class="place_rate @if(!Auth::check()) read @endif">
				<div class="total">
					<label>امتیاز کاربران به این رستوران:</label>
					<input type="text" value="@if($totalAvg) {{$totalAvg->sum / 20}} @else 0 @endif" class="total_score" disabled="disabled">
				</div>

				<label class="food" for="food">{{HTML::image('/assets/images/trans.png')}}کیفیت غذا <span>@if($avg) {{round($avg->foodAvg)}} @endif</span></label>
				<div class="rate" dir="ltr" id="food" data-score='@if($avg) {{$avg->foodAvg}} @endif'></div>

				<label  class="service" for="service">{{HTML::image('/assets/images/trans.png')}}کیفیت سرویس‌دهی <span>@if($avg) {{round($avg->serviceAvg)}} @endif</span></label>
				<div class="rate" dir="ltr" id="service" data-score="@if($avg) {{$avg->serviceAvg}} @endif"></div>

				<label class="space" for="space">{{HTML::image('/assets/images/trans.png')}}فضای داخلی <span>@if($avg) {{round($avg->spaceAvg)}} @endif</span></label>
				<div class="rate" dir="ltr" id="space" data-score="@if($avg) {{$avg->spaceAvg}} @endif"></div>

				<label class="location" for="location">{{HTML::image('/assets/images/trans.png')}}محل <span>@if($avg) {{round($avg->locationAvg)}} @endif</span></label>
				<div class="rate" dir="ltr" id="location" data-score="@if($avg) {{$avg->locationAvg}} @endif"></div>

			</div>

			@if (route::is('profile'))
				<div class="place_map">
					<div id="map">
						<script type="text/javascript">
							function initMap() {
								var lat = {{ $place->lat }};
								var long = {{ $place->long }};
								var map = new google.maps.Map(document.getElementById('map'), {
									zoom: 15,
									center: {lat: lat, lng: long},
									mapTypeId: google.maps.MapTypeId.ROADMAP,
									mapTypeControl: false,
									streetViewControl: false
								});
								var infowindow = new google.maps.InfoWindow();
								var marker, i;
								marker = new google.maps.Marker({
									position: {lat: lat, lng: long},
									map: map
								});
							}
						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqR3GeWC7x8XYCNNRdZEHO1trW_-Pmf0M&callback=initMap"
								async defer></script>
					</div>
					<div class="show_on_map">
						<a href="{{$place->url}}/map">

						<span class="glyphicon glyphicon-plus"></span> مشاهده نقشه کامل</a>
					</div>
				</div>
			@endif
			<div class="place_address">
				<p>نشانی: <span>{{$place->address}}</span></p>
				<p>تلفن: <span>{{$place->tel}}</span></p>
			</div>
		</div>

	</div>
</div>

@include('layouts.footerstat')
@stop
