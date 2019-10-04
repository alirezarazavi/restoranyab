@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead editForm">
			<h6>ویرایش «{{$definitions->title}}»</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>فیلد</td>
						<td>امکانات</td>
					</tr>
				</thead>
				<tbody>
					{{Form::open(array('route' => array('admin.definitions.update', $definitions->id), 'method' => 'PUT'))}}
					<tr>
						<td colspan="1" style="padding: 0px 7px;">
							<input type="text" dir="rtl" name="definition" value="{{$definitions->title}}" id="form_definitions" class="validate_text" placeholder="ویرایش" />
						</td>
						<td style="text-align: center; width: 150px;">
							<input type="submit" name="submit" value="ویرایش" class="buttonH bLightBlue" style="" />
							{{link_to_route('admin.definitions.index','انصراف',null, array('class' => 'button', 'style' => 'margin-top:7px;'))}}
						</td>
					</tr>
					{{Form::close()}}
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop