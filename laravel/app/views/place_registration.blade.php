@extends('layouts.master')
@section('content')

<div id="list">
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<h2>ثبت رستوران</h2>
			</div>
			<div class="col-xs-12">
				{{Form::open()}}
					{{Form::hidden('place_registration','place_registration')}}
					<div class="col-xs-2">
						<div class="form-group">
							<input type="submit" name="submit" value="ارسال" class="btn btn-primary">
						</div>
					</div>

					<div class="col-xs-5">
						<div class="form-group">
							<label>نام مدیر*
								<input type="text" name="managerName" value="{{Input::old('managerName')}}" size="50" class="form-control">
							</label>
						</div>

						<div class="form-group">
							<label>تلفن مدیر*
								<input type="text" name="managerPhone" value="{{Input::old('managerPhone')}}" size="50" class="form-control">
							</label>
						</div>

						<div class="form-group">
							<label>ایمیل
								<input type="text" name="email" value="{{Input::old('email')}}" dir="ltr" size="50" class="form-control">
							</label>
						</div>

						<div class="form-group">
							<label>توضیحات
								<textarea name="description" class="form-control" cols="48" rows="7">{{Input::old('description')}}</textarea>
							</label>
						</div>
					</div>

					<div class="col-xs-5">
						<div class="form-group">
							<label>نام رستوران*
								<input type="text" name="placeName" value="{{Input::old('placeName')}}" size="50" class="form-control">
							</label>
						</div>

						<div class="form-group">
							<label>نوع رستوران*
								<input type="text" name="placeType" value="{{Input::old('placeType')}}" size="50" class="form-control">
							</label>
						</div>

						<div class="form-group">
							<label>تلفن رستوران*
								<input type="text" name="placePhone" value="{{Input::old('placePhone')}}" size="50" class="form-control">
							</label>
						</div>

						<div class="form-group">
							<label>آدرس*
								<input type="text" name="placeAddress" value="{{Input::old('placeAddress')}}" size="50" class="form-control">
							</label>
						</div>
					</div>

				{{Form::close()}}
			</div>
		</div>

		@include('layouts.sidebar')
	</div>
</div>

@stop
