@extends('layouts.master')
@section('content')

<div id="home">
	<div class="container-fluid" id="search">
		<div class="row">
			<h2>راهنمای رایگان رستوران‌ها در ایران</h2>
			<div class="searchBox">
				{{Form::open(array('route' => array('search'), 'method' => 'get'))}}
					{{Form::text('keyword',null, array('placeholder' => 'کلمه مورد نظر خود را جستجو نمایید. مثلا: کباب، رستوران شاندیز، فست فود چارلی ...', 'tabindex' => '1'))}}
					{{Form::submit('')}}
				{{Form::close()}}
			</div>
		</div>
	</div>

	<div class="container" id="main">
		<div class="row">
			<div class="col-xs-5 categories pull-right">
				<p>رستوران مورد نظرت رو روی نقشه‌ی تهران پیدا کن:</p>
				<ul>
					<?php $parentCat = ''; ?>
					@foreach ($categories as $category)
						@if ($category->parent == 0)
							<?php $parentCat = $category->id; ?>
							<li class="category">
								<a href="#" id="{{$category->id}}">{{$category->title}}
									@if ($category->title == 'سنتی')
										<img src="assets/images/sonnati.png" class="icon pull-right" />
									@else
										<img src="assets/images/fastfood.png" class="icon pull-right" />
									@endif
									@foreach ($totalParentCats as $totalParent)
										@if ($totalParent['id'] == $category->id)
											<span class="badge pull-left">{{$totalParent['total']}}</span>
										@endif
									@endforeach
								</a>
								<ul class="subCategories">
									@foreach ($parentCategory as $parent)
										@if ($parent->parent == $parentCat)
											<li>
												<a href="#" id="{{$parent->id}}">{{$parent->title}}
													<span class="dot"></span>
													@if ($category->title == 'سنتی')
														<img src="assets/images/sonnati.png" class="icon pull-right" />
													@else
														<img src="assets/images/fastfood.png" class="icon pull-right" />
													@endif
													@foreach ($totalSubCats as $subCat)
														@if ($subCat['id'] == $parent->id)
															<span class="badge pull-left">
																{{$subCat['total']}}
															</span>
														@endif
													@endforeach
												</a>
											</li>
										@endif
									@endforeach
									<img src="assets/images/arrow_down.png" class="arrow_down" />
								</ul>
						@endif
							</li>
					@endforeach
				</ul>
			</div>
			<div class="col-xs-7 map pull-left">
				<div id="map">
					@include('layouts.map')
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid" id="intro">
		<div class="row">
			<div class="col-xs-10">
				<h3>{{$introContent->title}}</h3>
				<?php
					function get_excerpt($text, $numb = 650) {
					    if (mb_strlen($text) > $numb) {
					        $text = strip_tags($text);
					  		$text = substr($text, 0, $numb);
					        $text = mb_substr($text, 0, mb_strrpos($text, " "));
					        $etc = " ...";
					        $text = $text . $etc;
					    }
					    return $text;
					}
				?>
				{{get_excerpt($introContent->text)}}
				<a href="news/{{$introLink}}" class="more pull-left">ادامه ...</a>
			</div>
			<div class="col-xs-2">
				<img src="assets/images/gray-logo.png" />
			</div>
		</div>
	</div>

	<div class="container-fluid" id="partners">
		<div class="row">
			<ul class="list-inline">
				<li class="arrow_lr"><img src="assets/images/right_arrow.png" /></li>
				<li class="partner"><img src="assets/images/partner_1.png" /></li>
				<li class="partner"><img src="assets/images/partner_2.png" /></li>
				<li class="partner"><img src="assets/images/partner_3.png" /></li>
				<li class="partner"><img src="assets/images/partner_4.png" /></li>
				<li class="partner"><img src="assets/images/partner_5.png" /></li>
				<li class="partner"><img src="assets/images/partner_6.png" /></li>
				<li class="partner"><img src="assets/images/partner_7.png" /></li>
				<li class="partner"><img src="assets/images/partner_8.png" /></li>
				<li class="arrow_lr"><img src="assets/images/left_arrow.png" /></li>
			</ul>
		</div>
	</div>
</div>

@stop
