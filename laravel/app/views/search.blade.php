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
					<li>نتایج جستجو "{{$keyword}}"</li>
					<li><a href="{{URL::previous()}}">بازگشت
						{{HTML::image('/assets/images/place_arrow.png')}}
					</a></li>
				</ul>
			</div>
			<div id="places">
				@if (!$placeResults && !$categoriesResults)
					<p>جستجو نتیجه ای در بر نداشت.</p>
				@endif
				<!-- Places Results -->
				<p>نتایج اماکن</p>
				@foreach ($placeResults as $place)
					@if($place->publish == 'y')
						<ul class="list-inline place">
							@if ($place->cover)
								<li class="place_image_cover pull-right">
									{{HTML::image('/uploads/places/'.$place->cover.'')}}
								</li>
							@else
								@foreach ($placePicAll as $placePics)
									@if ($placePics->place_id == $place->id)
										<li class="place_image_cover pull-right">
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
								<a href="restaurant/{{$place->url}}">{{preg_replace('/'.$keyword.'/', '<span class="keyword">'.$keyword.'</span>', $place->title)}}</a>
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
								{{HTML::image('/assets/images/place_arrow.png')}}
							</a>
						</ul>
					@endif
				@endforeach
				<!-- Categories Results -->
				<p>نتایج دسته ها</p>
				@foreach ($categoriesResults as $places)
					@foreach ($places as $place)
						@if($place->publish == 'y')
							<ul class="list-inline place">
								@if ($place->cover)
									<li class="place_image_cover pull-right">
										{{HTML::image('/uploads/places/'.$place->cover.'')}}
									</li>
								@else
									@foreach ($placePicAll as $placePics)
										@if ($placePics->place_id == $place->id)
											<li class="place_image_cover pull-right">
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
									<a href="restaurant/{{$place->url}}">{{preg_replace('/'.$keyword.'/', '<span class="keyword">'.$keyword.'</span>', $place->title)}}</a>
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
