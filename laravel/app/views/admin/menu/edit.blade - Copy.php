@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<!-- Create Menu -->
	<div class="widget grid6">
		<div class="whead">
			<h6>ایجاد منو</h6>
		</div>
		<div class="table">
			{{Form::open(array('route' => array('admin.menu.update', $menuItem->id), 'method' => 'PUT'))}}

				<div class="formRow">
					<div class="grid12">
						<label>
							<input type="text" name="menuTitle" placeholder="عنوان" value="{{$menuItem->title}}" />
						</label>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<div class="grid12">
						<label>
							<input type="text" name="menuLink" placeholder="http://wwww.link.com" style="direction:ltr;" value="{{$menuItem->link}}" />
						</label>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label>
						<select name="menuPosition">
							<option name="menuPosition" value="0" selected="selected">موقعیت قرارگیری</option>
							<option name="menuPosition" value="top">بالا</option>
							<option name="menuPosition" value="bottom">پایین</option>
						</select>
					</label>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					{{Form::submit('ذخیره',array('class' => 'buttonH bBlue left'))}}
					{{link_to_route('admin.menu.index','انصراف',null, array('class' => 'button left', 'style' => 'margin-top:7px;'))}}
					<div class="clear"></div>
				</div>

			{{Form::close()}}
		</div>
	</div>

	<!-- List Menu -->
	<div class="widget grid6">
		<div class="whead">
			<h6>آیتم های منو</h6>
		</div>
		<div class="table">
			@if(count($menu) == 0) 
				<center>آیتمی برای نمایش وجود ندارد.</center>
			@else

				<table>
					<thead>
						<tr>
							<td>عنوان</td>
							<td style="width: 100px;">موقعیت</td>
							<td style="width: 50px;">
								<span class="sort">ترتیب</span><span class="loading" style="display:none;"><img width="10px" src="/assets/dashboard/img/icons/loading.gif"/></span>
							</td>
							<td style="width: 120px;">امکانات</td>
						</tr>
					</thead>
					<tbody>

						@foreach ($menu as $menuItem)
							<tr>
								<td>{{$menuItem->title}}</td>
								<td style="text-align:center;">
									@if ($menuItem->position == 'top') بالا @elseif ($menuItem->position == 'bottom') پایین @endif
								</td>
								<td>
									<input type="text" name="menuSort" class="menuSort" value="{{$menuItem->sort}}" style="text-align:center;" /> 
									<input type="hidden" name="menuId" class="menuId" class="menuId" value="{{$menuItem->id}}" />
								</td>
								<td>
									{{link_to_route('admin.menu.edit','ویرایش',$menuItem->id, array('class' => 'buttonXS bSea right', 'style' => 'height:17px;line-height:15px;'))}}
									{{Form::open(array('route' => array('admin.menu.destroy', $menuItem->id), 'method' => 'DELETE'))}}
										<input type="submit" name="menuDelete" value="حذف" rel="delete" class="buttonXS bRed right" />
									{{Form::close()}}
								</td>
							</tr>
						@endforeach

					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
				
			@endif
		</div>
	</div>
</div>

@stop
