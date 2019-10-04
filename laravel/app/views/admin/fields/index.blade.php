@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>فیلدها</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>عنوان</td>
						<td style="width: 200px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@if(count($fields) == 0)
						<tr><td colspan="3"><center>تاکنون فیلدی اضافه نشده است.</center></td></tr>
					@endif
					@foreach ($fields as $field)
					<tr>
						<td>{{$field->title}}</td>
						<td>
							<a href="#icon{{$field->id}}" class="button" data-icon="&#xe616;">آیکون</a>

							<div id="icon{{$field->id}}" class="modalDialog">
								<div>
									<a href="#" title="Close" class="close">X</a>
									<h2>آیکون «{{$field->title}}»</h2>
									<br/>
									<div>
										@if($field->icon == NULL) 
											<p>تصویری برای {{$field->title}} بارگذاری نشده است.</p>
										@else
											<p class="icon">
												{{--<img src="/uploads/fields/{{$field->icon}}"/>--}}
												{{HTML::image('/uploads/fields/'.$field->icon.'')}}
											</p>
											<p>در صورت بارگذاری مجدد، تصویر جدید جایگزین قبلی خواهد شد.</p>
										@endif
									</div>
									<div>
										<p>یک تصویر بارگذاری کنید.</p>
										{{Form::open(array('url'=>'admin/fields/icon/'.$field->id.'','files'=>true,'method'=>'POST'))}}
										{{Form::file('icon')}}
										{{Form::submit('آپلود',array('class'=>'buttonS bDefault','style'=>'margin-top:6px;padding-top:4px;'))}}
										{{Form::close()}}
									</div>
								</div>
							</div>

							{{link_to_route('admin.fields.edit','ویرایش',$field->id, array('class' => 'button', 'data-icon' => '&#xe607;'))}}
							{{Form::open(array('route' => array('admin.fields.destroy', $field->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete'))}}
								{{Form::submit('حذف', array('class' => 'buttonLink buttonLinkRed'))}}
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					{{Form::open(array('route' => array('admin.fields.store')))}}
						<tr>
							<td colspan="1" style="padding: 0px 7px;">
								<input type="text" dir="rtl" name="field" value="" id="form_field" class="validate_text" placeholder="اضافه کردن" />
							</td>
							<td>
								<input type="submit" name="submit" value="ذخیره" class="buttonH bLightBlue" style="float: none;" />
							</td>
						</tr>
					{{Form::close()}}
				</tfoot>
			</table>
		</div>
	</div>
</div>

@stop
