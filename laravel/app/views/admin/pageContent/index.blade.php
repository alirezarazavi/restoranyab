@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>محتوای صفحه {{$page->title}}</h6>
			{{link_to_route('admin.pages.{pageId}.content.create','ایجاد محتوا', $page->id, array('class' => 'buttonH bGreyish left'))}}
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>عنوان</td>
						<td style="width: 200px;">تاریخ</td>
						<td style="width: 200px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@if (count($pageContent) <= 0)
						<tr><td colspan="4"><p><center>تاکنون محتوایی برای این صفحه ساخته نشده است.</center></p></td></tr>
					@endif
					@foreach ($pageContent as $content)
						<tr>
							<td>
								{{$content->title}}
							</td>
							<td>
								{{jDate::forge($content->created_at)->format('datetime');}}
							</td>
							<td>
								<a href="content/{{$content->id}}/edit" class="button" data-icon="&#xe607;">ویرایش</a>
								{{Form::open(array('route' => array('admin.pages.{pageId}.content.destroy',$content->page_id, $content->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete'))}}
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
