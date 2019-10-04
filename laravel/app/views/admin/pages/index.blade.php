@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>صفحات</h6>
			<a href="{{URL::route('admin.pages.create')}}" class="buttonH bBlue left">ایجاد صفحه</a>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>عنوان</td>
						<td style="width: 200px;">لینک</td>
						<td style="width: 200px;">تاریخ</td>
						<td style="width: 200px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@if (count($pages) == 0)
						<tr><td colspan="4"><center>تاکنون صفحه ای ساخته نشده است.</center></td></tr>
					@endif
					@foreach ($pages as $p)
						<tr>
							<td>
								{{$p->title}}
							</td>
							<td>
								{{$p->link}}
							</td>
							<td class="textCenter">
								{{jDate::forge($p->created_at)->format('datetime')}}
							</td>
							<td>
								<a href="pages/{{$p->id}}/content" class="button" data-icon="&#xe625;">محتوا</a>
								<a href="pages/{{$p->id}}/edit" class="button" data-icon="&#xe607;">ویرایش</a>
								{{Form::open(array('route' => array('admin.pages.destroy', $p->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete'))}}
									{{Form::submit('حذف', array('class' => 'buttonLink buttonLinkRed'))}}
								{{Form::close()}}
							</td>
						</tr>
					@endforeach
					
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
		</div>
	</div>
</div>

@stop
