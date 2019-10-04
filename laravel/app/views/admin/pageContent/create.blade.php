@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>ایجاد محتوای برای </h6>
		</div>
		{{Form::open(array('route' => array('admin.pages.{pageId}.content.store',$pageId), 'method' => 'POST'))}}
			{{Form::hidden('pageId',$pageId)}}
			<div class="formRow">
				<div class="grid2">
					<label for="contentTitle">عنوان</label>
				</div>
				<div class="grid10">
					<input type="text" name="contentTitle" id="contentTitle" value="{{ Input::old('contentTitle') }}">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<textarea name="contentText" id="contentText">
						{{ Input::old('contentText') }}
					</textarea>
					<script type="text/javascript">CKEDITOR.replace( 'contentText' );</script>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<input type="submit" name="createContent" value="ذخیره" class="buttonH bLightBlue left" />
				</div>
				<div class="clear"></div>
			</div>
		{{Form::close()}}
	</div>
</div>

@stop