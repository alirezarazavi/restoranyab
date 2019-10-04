@extends('layouts.master')
@section('content')

<div id="list">
	<div id="topbar">
		@include('layouts.orderby')
	</div>
	<div class="container" id="main">
		<div class="col-xs-10">
			<div class="page_info">
				<h2>ارتباط</h2>
			</div>
			<div class="col-xs-9">
				{{Form::open()}}
					{{Form::hidden('contact','contact')}}
					<div class="form-group">
						<label>موضوع *
							<input type="text" name="subject" size="50" class="form-control">
						</label>
					</div>

					<div class="form-group">
						<label>ایمیل *
							<input type="text" name="email" size="50" class="form-control">
						</label>
					</div>

					<div class="form-group">
						<label>متن *
							<textarea name="text" class="form-control" cols="48" rows="7"></textarea>
						</label>
					</div>

					<div class="form-group">
						<input type="submit" name="submit" value="ارسال" class="btn btn-primary">
					</div>

				{{Form::close()}}
			</div>
		</div>

		@include('layouts.sidebar')
	</div>
</div>

@stop
