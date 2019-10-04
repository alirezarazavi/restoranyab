@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>ویرایش</h6>
		</div>
		{{Form::open(array('route' => array('admin.pages.update', $page->id), 'method' => 'PUT'))}}
			<div class="formRow">
				<div class="grid2">
					<label for="pageTitle">عنوان</label>
				</div>
				<div class="grid10">
					<input type="text" name="pageTitle" id="pageTitle" value="{{ $page->title }}">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label for="pageTitle">لینک</label>
				</div>
				<div class="grid10">
					<input type="text" name="pageLink" id="pageLink" value="{{ $page->link }}">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid12">
					<input type="submit" name="create" value="ذخیره" class="buttonH bLightBlue left" />
					{{link_to_route('admin.pages.index','انصراف',null,array('class' => 'button left', 'style' => 'margin-top:7px;'))}}
				</div>
				<div class="clear"></div>
			</div>
		{{Form::close()}}
	</div>
</div>

@stop