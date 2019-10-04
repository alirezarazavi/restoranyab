@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>تقاضای ثبت رستوران</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td>نام رستوران</td>
						<td>نام مدیر</td>
						<td>ایمیل</td>
						<td>تاریخ ثبت</td>
						<td>امکانات</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($userPlaceRegistration as $userPlace)
						<tr>
							<td>
								{{$userPlace->placeName}}
							</td>
							<td>
								{{$userPlace->managerName}}
							</td>
							<td>
								{{$userPlace->email}}
							</td>
							<td>
								{{$userPlace->created_at}}
							</td>
							<td class="textCenter">
								<a href="#" class="buttonXS bSea">جزئیات</a>
								<a href="#" class="buttonXS bRed" rel="delete">حذف</a>
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
	</div>	
</div>

@stop
