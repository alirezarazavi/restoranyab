@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>تعاریف اولیه</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>عنوان</td>
						<td style="width: 120px;">نمایش در لیست اماکن</td>
						<td style="width: 120px;">نمایش در جستجوی سریع</td>
						<td style="width: 200px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@if(count($definitions) == 0)
						<tr><td colspan="3"><center>رکوردی پیدا نشد.</center></td></tr>
					@endif
					@foreach ($definitions as $definition)
					<tr>
						<td>{{ $definition->title }}</td>

						<td class="textCenter">
							@if ($definition->show_list == 'y')
								<a href="definitions/{{$definition->id}}/deactive_list" class="showfilterToggle" id="{{$definition->id}}"><span class="status_active">فعال</span></a>
							@else 
								<a href="definitions/{{$definition->id}}/active_list" class="showfilterToggle" id="{{$definition->id}}"><span class="status_deactive">غیرفعال</span></a>
							@endif
						</td>

						<td class="textCenter">
							@if ($definition->show_filter == 'y')
								<a href="definitions/{{$definition->id}}/deactive_filter" class="showfilterToggle" id="{{$definition->id}}"><span class="status_active">فعال</span></a>
							@else 
								<a href="definitions/{{$definition->id}}/active_filter" class="showfilterToggle" id="{{$definition->id}}"><span class="status_deactive">غیرفعال</span></a>
							@endif
						</td>
						<td>
							<a href="definitions/values/{{$definition->id}}" class="button" data-icon="&#xe62e;">مقادیر</a>
							<a href="definitions/{{$definition->id}}/edit" class="button" data-icon="&#xe607;">ویرایش</a>
							{{ Form::open(array('route' => array('admin.definitions.destroy', $definition->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete')) }}
								{{Form::submit('حذف', array('class' => 'buttonLink buttonLinkRed'))}}
							{{ Form::close() }}
							<!-- <a href="{{URL::to('admin/definitions/delete', $definition->id)}}" class="button" rel="delete" data-icon="">حذف</a> -->
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<form action="#" method="POST">
						<tr>
							<td colspan="2" style="padding: 0px 7px;">
								<input type="text" dir="rtl" name="definition" value="" id="form_definitions" class="validate_text" placeholder="اضافه کردن" />
							</td>
							<td>
								<input type="submit" name="submit" value="ذخیره" class="buttonH bLightBlue" style="float: none;" />
							</td>
						</tr>
					</form>
				</tfoot>
			</table>
		</div>
	</div>
</div>

@stop
