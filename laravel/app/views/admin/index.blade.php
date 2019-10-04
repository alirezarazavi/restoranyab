@extends('admin.layouts.master')
@section('content')

	<div class="wrapper adminIndex">

		<div class="widget grid12">
			<div class="whead">
				<h6>خلاصه وضعیت</h6>
			</div>
			<div class="body">
				<div class="grid6">
					<h7>اماکن ({{count($places)}})</h7>
					<p>
						{{$placeStat['publish']}} مکان منتشر شده و {{$placeStat['draft']}} مکان در وضعیت انتظار قرار دارد.
						{{link_to_route('admin.places.index','مشاهده')}} / {{link_to_route('admin.places.create','ثبت مکان')}}
					</p>
				</div>
				<div class="grid6">
					<h7>کاربرها ({{count($users)}})</h7>
					<ul>
						<li>آخرین کاربر ثبت شده:</li>
						@foreach ($users as $user)
							<li><a href="#">{{ $user->username }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		<!-- <div class="widget grid7">
			<div class="whead">
				<h6>راهنما</h6>
			</div>
			<div class="body">
				
			</div>
		</div> -->
	</div>
	
	
@stop
