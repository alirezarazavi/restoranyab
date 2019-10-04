@extends('layouts.master')
@section('content')

<div id="list">
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<div class="container news" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<h2>اخبار</h2>
			</div>
			@foreach ($news as $news)
				<div class="newsWrapper">
					<span>{{jDate::forge($news->created_at)->format('%d %B %y')}}</span>
					<h3><a href="news/{{$news->link}}">{{$news->title}}</a></h3>
					{{Functions::excerpt($news->text)}}
					<hr />
				</div>
			@endforeach
		</div>

		@include('layouts.sidebar')
	</div>
</div>

@stop
