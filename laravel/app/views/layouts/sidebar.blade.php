<div class="col-xs-2" id="sidebar">
	<!-- Search -->
	{{Form::open(array('route' => array('search'), 'method' => 'get'))}}
		{{Form::text('keyword', Input::get('keyword'), array('placeholder' => 'جستجو', 'class' => 'quick_search_input'))}}
		{{Form::submit('', array('class' => 'quick_search_submit'))}}
	{{Form::close()}}
	<!-- Filter -->
	{{Form::open(array('route' => array('filter'), 'method' => 'get'))}}
		<div class="filter_search_quote">
			<p>جستجوگر سریع</p><p>با انتخاب گزینه‌های موردنظر خود و فشردن دکمه‌ی جستجو، سریع‌تر به نتیجه خواهید رسید!</p>
		</div>
		<ul>
			@foreach($definitions as $definition)
				@if ($definition->show_filter == 'y')
					<li class="filter_search_options_title">{{$definition->title}}</li>
					@foreach($values as $value)
						@if ($value->definition_id == $definition->id)
							<li class="filter_search_options">
								<label>
									{{Form::checkbox('filter_options[]', $value->id)}}
									{{$value->title}}
								</label>
							</li>
						@endif
					@endforeach
				@endif
			@endforeach
		</ul>
		{{Form::submit('جستجو کن!', array('class' => 'filter_search_submit'))}}
	{{Form::close()}}
</div>