@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>افزودن خبر</h6>
		</div>
		{{Form::open(array('route' => array('admin.news.store'), 'method' => 'POST'))}}
			<div class="formRow">
				<div class="grid2">
					<label for="newsTitle">عنوان</label>
				</div>
				<div class="grid10">
					<input type="text" name="newsTitle" id="newsTitle" value="{{ Input::old('newsTitle') }}">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<textarea name="newsText" id="newsText">{{ Input::old('newsText') }}</textarea>
					<script type="text/javascript">CKEDITOR.replace( 'newsText' );</script>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<input type="submit" name="create" value="ذخیره" class="buttonH bLightBlue left" />
				</div>
				<div class="clear"></div>
			</div>
		{{Form::close()}}
	</div>
</div>

@stop