@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>ایجاد صفحه</h6>
		</div>
		{{Form::open(array('route' => array('admin.pages.store'), 'method' => 'POST'))}}
			<div class="formRow">
				<div class="grid2">
					<label for="pageTitle">عنوان</label>
				</div>
				<div class="grid10">
					<input type="text" name="pageTitle" id="pageTitle" value="{{ Input::old('pageTitle') }}">
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label for="pageTitle">لینک</label>
				</div>
				<div class="grid10">
					<input type="text" name="pageLink" id="pageLink" value="{{ Input::old('pageLink') }}">
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