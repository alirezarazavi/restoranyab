@extends('admin.layouts.master')
@section('content')
<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>جزئیات «{{$place->title}}»</h6>
		</div>
		<div class="table">
			<table>
				@if(count($values) == 0) 
					<center><p>مقادیری برای نمایش یافت نشد.</p><p>در قسمت تعاریف اولیه، مقادیر را وارد کنید</p></center>
				@else
					{{Form::open(array('url'=>'#','method'=>'POST'))}}
					{{Form::hidden('placeDefinitions','placeDefinitions')}}

						<div class="formRow">
							@foreach ($definitions as $definition)
								<div class="grid4">
									<h2 style="font-size:14px;">
										{{$definition->title}}
									</h2>
									@foreach ($values as $value)
										@if($value->definition_id == $definition->id)
											<label><input type="checkbox" name="placeValue[]"
												@foreach($placeDefinitions as $pd)
													@if ($pd->value_id == $value->id) 
														{{'checked'}}
													@endif
												@endforeach
											value="{{$value->id}}"/> {{$value->title}}</label>
											<br />
										@else
										@endif
									@endforeach
								</div>
							@endforeach
						<div class="clear"></div>
					</div>		
					
					{{link_to_route('admin.places.index','بازگشت',null,array('class'=>'buttonLink left','style'=>'margin-top:5px; margin-left:10px;'))}}
					{{Form::submit('ذخیره', array('class'=>'buttonH bLightBlue left'))}}
							
					{{Form::close()}}
				@endif
			</table>
		</div>
	</div>
</div>

@stop
