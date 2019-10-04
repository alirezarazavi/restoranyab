@extends('layouts.master')

@section('content')

<div id="list">
	<!-- TOPBAR -->
	<div id="topbar">
		@include('layouts.orderby')
		@include('layouts.showonmap')
	</div>
	<!-- CONTENT -->
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<ul class="list-inline">
					<li class="place_counts">{{$places->getTotal()}} رستوران موجود است</li>
					@if (Route::is('restaurant'))
						<li>{{$places->getFrom()}} تا {{$places->getTo()}} از {{$places->getTotal()}}
						<!-- <a href="?page={{$places->getTo()}}"><img src="/assets/images/left_arrow.png"></a> -->
						</li>
					@else
						<li></li>
					@endif

				</ul>
			</div>
			<div id="places">
				@if (Route::is('map'))
					<div id="map">
					</div>
						@include('layouts.map')
				@else
					@foreach ($places as $place)

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
							<a class="place_link" href="/restaurant/{{$place->url}}"><img src="{{asset('/assets/images/place_arrow.png')}}"/></a>
						</ul>

					@endforeach
				@endif
			</div>
			{{$places->links()}}
		</div>

		@include('layouts.sidebar')
	</div>
</div>

	@include('layouts.footerstat')

@stop
