@extends('layouts.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-xs-6 col-xs-offset-3">
	
			{{ 	Form::open(array('url' => '#', 'method' => 'post', 'role' => 'form')) 	
			}}
			<div class="form-group">
			{{	Form::label('username','نام کاربری')
			}}
			{{ 	Form::text('username',Input::old('username') ,array('class'=>'form-control', 'dir'=>'ltr'))
			}}
			</div>
			<div class="form-group">
			{{	Form::label('email','ایمیل')
			}}
			{{ 	Form::text('email',Input::old('email'),array('class'=>'form-control', 'dir'=>'ltr'))	
			}}
			</div>
			<div class="form-group">
			{{	Form::label('password','رمز عبور')
			}}
			{{ 	Form::password('password',array('class'=>'form-control', 'dir'=>'ltr'))	
			}}
			</div>
			<div class="form-group">
			{{	Form::label('password_confirm','تکرار رمز عبور')
			}}
			{{ 	Form::password('password_confirm',array('class'=>'form-control', 'dir'=>'ltr'))	
			}}
			</div>
			<div class="form-group">
			{{	Form::submit('ثبت نام',array('name'=>'signup','class'=>'btn btn-primary'));
			}}
			</div>
			{{ 	Form::close() 
			}}
		</div>
	</div>
</div>

@stop