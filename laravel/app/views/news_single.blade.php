@extends('layouts.master')
@section('content')

<div id="list">
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<h2>{{$news->title}}</h2>
			</div>
			{{$news->text}}

		</div>

		@include('layouts.sidebar')
	</div>
</div>

@stop
