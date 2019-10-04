@extends('admin.layouts.master')
@section('content')
<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>فیلدهای «{{$place->title}}»</h6>
		</div>
		
		{{Form::open(array('url'=>'#','method'=>'POST'))}}
		{{Form::hidden('placeFields','placeFields')}}
		<div class="formWrapper">
			@foreach ($fields as $field)
				<div class="formRow">
					<label>
						<div class="grid2">
							{{Form::hidden('fieldId[]', $field->id)}}
							{{$field->title}}:
						</div>
						<div class="grid10">
							<input type="text" name="fieldDesc[]"
								@foreach ($placeFields as $placeField) 
									@if($placeField->field_id == $field->id)
										 value="{{$placeField->description}}"
									@endif
								@endforeach
							/>
						</div>
					</label>
					<div class="clear"></div>
				</div>
			@endforeach
		</div>
		
		<div class="formRow">
			<div class="grid12">
				{{link_to_route('admin.places.index','بازگشت',null,array('class'=>'buttonLink left','style'=>'margin-top:5px;'))}}
				{{Form::submit('ذخیره', array('class'=>'buttonH bLightBlue left'))}}
			</div>
			<div class="clear"></div>
		</div>
		{{Form::close()}}
		
	</div>
</div>

@stop
