@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6><a href="{{URL::route('admin.definitions.index')}}">{{$definition->title}}</a> / مقادیر</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>مقادیر</td>
						<td style="width: 200px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@if(count($values) == 0)
						<tr><td colspan="2"><center>تاکنون مقادیری وارد نشده است.</center></td></tr>
					@endif
					@foreach ($values as $value)
					<tr>
						<td>
							{{$value->title}}
						</td>
						<td>
							<a href="#icon{{$value->id}}" class="button" data-icon="&#xe60e;">تصویر</a>
							
							<div id="icon{{$value->id}}" class="modalDialog">
								<div>
									<a href="#" title="Close" class="close">X</a>
									<h2>تصویر «{{$value->title}}»</h2>
									<br/>
									<div>
										@if($value->image == NULL) 
											<p>تصویری برای {{$value->title}} بارگذاری نشده است.</p>
										@else
											<p class="icon"><img src="/uploads/definitionValues/{{$value->image}}"/></p>
											<p>در صورت بارگذاری مجدد، تصویر جدید جایگزین قبلی خواهد شد.</p>
										@endif
									</div>
									<div>
										<p>یک تصویر بارگذاری کنید.</p>
										{{Form::open(array('url'=>'admin/definitions/values/'.$value->id.'','files'=>true,'method'=>'POST'))}}
										{{Form::file('icon')}}
										{{Form::submit('آپلود',array('class'=>'buttonS bDefault','style'=>'margin-top:6px;padding-top:4px;'))}}
										{{Form::close()}}
									</div>
								</div>
							</div>

							<a href="{{$value->id}}/edit" class="button" data-icon="&#xe607;">ویرایش</a>
							{{Form::open(array('route' => array('admin.definitions.values.destroy', $value->id), 'method' => 'DELETE', 'style' => 'display:inline;', 'rel' => 'delete'))}}
								{{Form::submit('حذف', array('class' => 'buttonLink buttonLinkRed'))}}
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
					<tfoot>
						{{Form::open(array('route' => array('admin.definitions.values.store'), 'method' => 'post'))}}
						<input type="hidden" name="definition_id" value="{{$definition_id}}" />
						<tr>
							<td colspan="1" style="padding: 0px 7px; ">
								<input type="text" dir="rtl" name="value" value="" id="form_value" class="validate_text" placeholder="اضافه کردن" />
							</td>
							<td>
								<input type="submit" name="submit" value="ذخیره" class="buttonH bLightBlue" style="float: none;" />
							</td>
						</tr>
						{{Form::close()}}
					</tfoot>
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop
