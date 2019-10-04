@extends('admin.layouts.master')
@section('content')

<!-- Upload -->
<div class="wrapper grid4" style="margin-right:15px;">
	<div class="widget">
		<div class="whead">
			<h6>بارگذاری تصویر</h6>
		</div>

		<div class="table" style="padding:10px;">
			
			<!-- Upload Form -->
			{{Form::open(array('url'=>'#','method'=>'POST','files'=>true))}}
				{{Form::text('pictureTitle',null,array('placeholder'=>'عنوان تصویر','style'=>'margin-bottom:5px;'))}}
				{{Form::file('placePicture')}}
				{{Form::hidden('placeId',$place->id)}}
				<br/>
				{{Form::submit('بارگذاری',array('class'=>'buttonH bGreen','style'=>'margin:5px 0;'))}}
			{{Form::close()}}
			
		</div>
	</div>
</div>
<!-- Pictures -->
<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>تصاویر «{{$place->title}}»</h6>
		</div>
		{{Form::open(array('url'=>'#','method'=>'POST'))}}
		<div class="table">
		@if(!$pictures) 
			<p><center>تاکنون تصویری برای «{{$place->title}}» بارگذاری نشده است.</center></p>
		@else
			<table>
				<thead>
					<tr>
						<td>تصویر</td>
						<td>عنوان</td>
						<td width="20px;">حذف</td>
						<td width="20px;">کاور</td>
						<td width="20px;">لوگو</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($pictures as $picture)
						<tr>
							<td>
								<!-- <img width="100px;" class="tooltip" alt="{{$place->title}}" title="{{$picture->title}}" src="/uploads/places/{{$picture->picture}}"/> -->
								{{HTML::image('/uploads/places/'.$picture->picture.'', $place->title, array('width' => '100px', 'class' => 'tooltip', 'title' => $picture->title))}}
							</td>
							<td>
								{{$picture->title}}
							</td>
							
							<td>
								<input type="checkbox" class="check" name="deletePictures[]" value="{{$picture->id}}">
							</td>
							<td>
								<input type="checkbox" class="check" name="coverPicture[]" @if ($place->cover == $picture->picture) checked="checked" @endif value="{{$picture->picture}}">
							</td>
							<td>
								<input type="checkbox" class="check" name="logoPicture[]" @if ($place->logo == $picture->picture) checked="checked" @endif value="{{$picture->picture}}">
							</td>
							
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">
							{{Form::hidden('placeId',$place->id)}}
							{{Form::submit('حذف',array('name'=>'deleteSubmit','class'=>'buttonH bRed left','rel'=>'delete'))}}
						</td>
						<td colspan="2">							
							{{Form::submit('ذخیره',array('name'=>'cover_logoSubmit','class'=>'buttonH bBlue left'))}}
						</td>
					</tr>
				</tfoot>
			</table>
			{{Form::close()}}
		@endif
		</div>
	</div>
</div>

@stop
