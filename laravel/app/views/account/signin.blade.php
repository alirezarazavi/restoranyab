@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-xs-4 col-xs-offset-4">

			{{ 	Form::open(array('role'=>'form')) 	
			}}
			<div class="form-group">
			{{	Form::label('email','ایمیل')
			}}
			{{ 	Form::text('email',Input::old('name'),array('class'=>'form-control','dir'=>'ltr', 'tabindex' => '1'))	
			}}
			</div>
			<div class="form-group">
			{{	Form::label('password','رمز عبور')
			}}
			{{ 	Form::password('password',array('class'=>'form-control','dir'=>'ltr', 'tabindex' => '2'))	
			}}
			</div>
			<div class="form-group">
			{{	Form::submit('ورود',array('class'=>'btn btn-primary'))
			}}
			</div>
			{{ 	Form::close() 	
			}}
		
		</div>
	</div>
</div>
@stop