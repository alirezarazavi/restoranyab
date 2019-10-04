@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead editForm">
			<h6>ویرایش  «{{$values->title}}»</h6>
		</div>
		<div class="table editForm">
			<table>
				<thead>
					<tr>
						<td>فیلد</td>
						<td>امکانات</td>
					</tr>
				</thead>
				<tbody>
					{{Form::open(array('route' => array('admin.definitions.values.update', $values->id), 'method' => 'PUT'))}}
					<tr>
						<td colspan="1" style="padding: 0px 7px;">
							<input type="text" dir="rtl" name="value" value="{{$values->title}}" id="form_values" class="validate_text" placeholder="ویرایش" />
						</td>
						<td style="text-align: center; width: 150px;">
							<input type="submit" name="submit" value="ذخیره" class="buttonH bLightBlue" style="" />
							{{link_to_action('ValuesController@show','انصراف',$values->definition_id, array('class' => 'button', 'style' => 'margin-top:7px;'))}}
						</td>
					</tr>
					{{Form::close()}}
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop