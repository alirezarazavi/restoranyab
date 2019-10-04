@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>مدیریت کاربرها</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>نام کاربری</td>
						<td>ایمیل</td>
						<td>تاریخ ثبت نام</td>
						<td>آخرین ورود</td>
						<td>دسترسی</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						@if ($user->username !== Auth::user()->username)
							<tr @if ($user->role == 'admin') style="background:#FFF0D7;" @endif>
								<td>{{$user->username}}</td>
								<td>{{$user->email}}</td>
								<td>{{jDate::forge($user->created_at)->format('%d %B %y')}}</td>
								<td>{{jDate::forge($user->last_login)->format('%d %B %y')}}</td>
								<td>
									<a href="#" id="{{$user->id}}" class="role buttonXS @if ($user->role == 'admin') bRed @else bSea @endif">{{$user->role}}</a>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
		{{$users->links()}}
	</div>	
</div>

@stop
