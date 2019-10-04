@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>تنظیمات</h6>
		</div>
		<div class="table">
			{{Form::open(array('route' => array('admin.settings.store'), 'method' => 'POST'))}}
				<table>
					<thead>
						<tr>
							<td width="600px">عنوان</td>
							<td>مقدار</td>
						</tr>
					</thead>
					<tbody>
						<td>متن صفحه اول:</td>
						<td>
							<select name="homeIntro">
									<option value="0">انتخاب کنید</option>
								@foreach ($pages as $page)
									<option value="{{$page->id}}" @if ($settings[0]['value'] == $page->id) selected="selected" @endif>{{$page->title}}</option>
								@endforeach
									<option value="n" @if ($settings[0]['value'] == 'n') selected="selected" @endif>اخبار</option>
							</select>
						</td>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">
								{{Form::submit('ذخیره',array('class' => 'buttonH bGreen left'))}}
							</td>
						</tr>
					</tfoot>
				</table>
			{{Form::close()}}
		</div>
	</div>
</div>

@stop
