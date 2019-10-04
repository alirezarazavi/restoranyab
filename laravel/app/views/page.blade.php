@extends('layouts.master')
@section('content')

<div id="list">
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<h2>{{$content->title}}</h2>
			</div>
			{{$content->text}}
		</div>

		@include('layouts.sidebar')
	</div>
</div>

@stop
