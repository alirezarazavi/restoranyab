@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>ویرایش</h6>
		</div>
		{{Form::open(array('route' => array('admin.pages.{pageId}.content.update',$content->page_id,$content->id), 'method' => 'PUT'))}}
			<div class="formRow">
				<div class="grid2">
					<label for="contentTitle">عنوان</label>
				</div>
				<div class="grid10">
					<input type="text" name="contentTitle" id="contentTitle" value="{{$content->title}}">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<textarea name="contentText" id="contentText">
						{{$content->text}}
					</textarea>
					<script type="text/javascript">CKEDITOR.replace( 'contentText' );</script>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<input type="submit" name="createContent" value="ذخیره" class="buttonH bLightBlue left" />
					{{link_to_route('admin.pages.{pageId}.content.index','انصراف',$content->page_id,array('class' => 'button left', 'style' => 'margin-top:8px;'))}}
				</div>
				<div class="clear"></div>
			</div>
		{{Form::close()}}
	</div>
</div>

@stop