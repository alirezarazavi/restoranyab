@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>اخبار</h6>
			<a href="{{URL::route('admin.news.create')}}" class="buttonH bBlue left">ایجاد خبر</a>
		</div>
		<div class="table">
			@if(count($news) == 0) 
				<center>تاکنون خبری ایجاد نشده است.</center>
			@else

				<table>
					<thead>
						<tr>
							<td>عنوان</td>
							<td style="width: 200px;">تاریخ</td>
							<td style="width: 200px;">امکانات</td>
						</tr>
					</thead>
					<tbody>
						
						@foreach ($news as $n)
							<tr>
								<td>
									{{$n->title}}
								</td>
								<td class="textCenter">
									{{jDate::forge($n->created_at)->format('datetime')}}
								</td>
								<td>
									<a href="news/{{$n->id}}/edit" class="button" data-icon="&#xe607;">ویرایش</a>
									{{Form::open(array('route' => array('admin.news.destroy', $n->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete'))}}
										{{Form::submit('حذف', array('class' => 'buttonLink buttonLinkRed'))}}
									{{Form::close()}}
								</td>
							</tr>
						@endforeach
						
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
				
			@endif
		</div>
	</div>
</div>

@stop
