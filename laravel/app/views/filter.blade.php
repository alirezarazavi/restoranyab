@extends('layouts.master')
@section('content')

<div id="list">
	<!-- TOPBAR -->
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<!-- CONTENT -->
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<ul class="list-inline">
					<li>نتایج جستجو </li>
					<li>
						<a href="{{URL::previous()}}">بازگشت
						{{--<img src="/assets/images/place_arrow.png">--}}
							{{HTML::image('/assets/images/place_arrow.png')}}
						</a>
					</li>
				</ul>
			</div>
			<div id="places">
				@if (!$filterResults)
					<p>جستجو نتیجه ای در بر نداشت.</p>
				@endif
				<!-- Places Results -->
				@foreach ($filterResults as $places)
					@foreach ($places as $place)
						@if($place->publish == 'y')
							<ul class="list-inline place">
								@if ($place->cover) 
									<li class="place_image_cover pull-right">
{{--										<img src="/uploads/places/{{$place->cover}}">--}}
										{{HTML::image('/uploads/places/'.$place->cover.'')}}
									</li>
								@else 
									@foreach ($placePicAll as $placePics)
										@if ($placePics->place_id == $place->id)	
											<li class="place_image_cover pull-right">
{{--												<img src="/uploads/places/{{$placePics->picture}}">--}}
												{{HTML::image('/uploads/places/'.$placePics->picture.'')}}
											</li>
											@break
										@else
											<li class="place_image_cover pull-right"><img src=""></li>
											@break
										@endif
									@endforeach
								@endif
								<li class="place_title">
									<a href="restaurant/{{$place->url}}">{{$place->title}}</a>
								</li>
								@foreach ($definitions as $definition)
									@if($definition->show_list == 'y')
										<li>{{$definition->title}}: <span>
											@foreach ($placeDefinition as $pd)
												@if($pd->place_id == $place->id)
													@foreach ($values as $value)
														@if ($pd->value_id == $value->id AND $value->definition_id == $definition->id)
															{{$value->title}}
														@endif
													@endforeach
												@endif
											@endforeach
										</span></li>
									@endif
								@endforeach
								<li class="place_address">نشانی:‌ <span>{{$place->address}}</span></li>
								<!-- <li class="place_price">سطح قیمت <span>بالا</span></li> -->
								<a class="place_link" href="/restaurant/{{$place->url}}">
									{{--<img src="/assets/images/place_arrow.png"/>--}}
									{{HTML::image('/assets/images/place_arrow.png')}}
								</a>
							</ul>
						@endif
					@endforeach
				@endforeach
			</div>
		</div>
		@include('layouts.sidebar')
	</div>
</div>
	@include('layouts.footerstat')
	
@stop