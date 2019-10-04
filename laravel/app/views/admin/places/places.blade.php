@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>لیست اماکن ({{count($places)}})</h6>
			<a href="{{URL::route('admin.places.create')}}" class="buttonH bBlue left" data-icon="">اضافه کردن</a>
		</div>
		<div class="table">
			<table>
				<thead>
				@if(!$places) <tr><td> اطلاعاتی برای نمایش وجود ندارد </td></tr>
				@else
					<tr>
						<td style="width: 300px;">نام</td>
						<td>آخرین تغییر</td>
						<td>وضعیت انتشار <a style="margin:0;padding:0;" class="icon-question tooltip" title="برای تغییر وضعیت هر مکان، روی «انتظار» یا «منتشر شده» کلیک کنید"></a></td>
						<td style="width: 300px;">جزئیات</td>
						<td style="width: 120px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($places as $place)
					<tr>
						<td>{{ $place->title }} 
							@if ($place->publish == 'y')
								<a href="{{URL::route('profile', $place->url)}}" target="_blank" class="place_link">نمایش</a>
							@endif
						</td>
						<td>
							@if ($place->updated_at > 0) 
								{{jDate::forge($place->updated_at)->format('datetime')}} 
							@else 
								{{jDate::forge($place->created_at)->format('datetime')}} 
							@endif
						</td>
						<td class="publish_status">
						
							@if ($place->publish == 'n')
								<p id="active" style="text-align:center;"><a href="#" id="{{$place->id}}" class="publish status_deactive">انتظار</a></p>
							@elseif ($place->publish == 'y')
								<p id="deactive" style="text-align:center;"><a href="#" id="{{$place->id}}" class="publish status_active">منتشر شده</a></p>
							@endif

						</td>
						<td>
							<a href="places/{{$place->id}}/menu" class="button" data-icon="&#xe6b5;">منو</a>
							<a href="places/{{$place->id}}/fields" class="button" data-icon="&#xe6ba;">فیلد</a>
							<a href="places/{{$place->id}}/pictures" class="button" data-icon="&#xe60e;">تصاویر</a>
							<a href="places/{{$place->id}}/details" class="button" data-icon="&#xe623;">جزئیات</a>
						</td>
						<td>
							{{link_to_route('admin.places.edit','ویرایش',$place->id, array('class'=>'buttonXS bSea right', 'style' => 'height:17px;line-height:15px;'))}}
							{{Form::open(array('route' => array('admin.places.destroy', $place->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete'))}}
								{{Form::submit('حذف', array('class' => 'buttonXS bRed right'))}}
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
				@endif
			</table>
		</div>
		{{$places->links()}}
	</div>
</div>

@stop
