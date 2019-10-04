@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<!-- Create Menu -->
	<div class="widget grid6">
		<div class="whead">
			<h6>ایجاد منو</h6>
		</div>
		<div class="table">
			{{Form::open(array('route' => array('admin.menu.store'), 'method' => 'POST'))}}
				
				<div class="formRow">
					<div class="grid3">
						<label>موقعیت قرارگیری</label>
					</div>
					<div class="grid9">
						<div class="grid3">
							<label><input type="radio" class="radio" name="menuPosition" value="t">بالا</label>
						</div>
						<div class="grid3">
							<label><input type="radio" class="radio" name="menuPosition" value="b">پایین</label>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<div class="grid3">
						<label for="menuLink">لینک <a class="icon-question tooltip" title="لینک هر آیتم را از گزینه‌هایی که در منوی روبرو قرار دارد انتخاب کنید. شما می‌توانید از بین صفحات و لینک‌هایی که قبلا ساخته‌اید انتخاب کنید."></a></label>
					</div>
					
					<div class="grid8">
						<select name="menuLink">
								<option value="0" selected="selected">انتخاب کنید</option>
							<optgroup label="«ثابت»">
								<option value="/">صفحه نخست</option>
								<option value="restaurant">لیست رستوران‌ها</option>
								<option value="restaurant/map">لیست رستوران‌ها در نقشه</option>
								<option value="place_registration">صفحه ثبت رستوران</option>
								<option value="contact">صفحه ارتباط</option>
								<option value="news">صفحه اخبار</option>
							</optgroup>
							<optgroup label="«لینک‌های شما»">
								
							</optgroup>
							<optgroup label="«صفحات شما»">
								@foreach ($pages as $page)
									<option value="{{$page->link}}">{{$page->title}}</option>
								@endforeach
							</optgroup>
						</select>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<div class="grid3">
						<label for="menuTitle">عنوان</label>
					</div>
					<div class="grid9">
						<input type="text" id="menuTitle" name="menuTitle" placeholder="عنوان" value="{{Input::old('menuTitle')}}" />
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					{{Form::submit('ذخیره',array('class' => 'buttonH bGreen left'))}}
					<div class="clear"></div>
				</div>

			{{Form::close()}}
		</div>
	</div>

	<!-- List Menu -->
	<div class="widget grid6">
		<div class="whead">
			<h6>منوی بالا</h6>
		</div>
		<div class="table">
			@if(count($menu) == 0) 
				<center>آیتمی برای نمایش وجود ندارد.</center>
			@else
				<table>
					<thead>
						<tr>
							<td>عنوان</td>
							<td>لینک</td>
							<td style="width: 50px;">
								<span class="sort">ترتیب</span><span class="loading" style="display:none;"><img width="10px" src="/assets/dashboard/img/icons/loading.gif"/></span>
							</td>
							<td style="width: 120px;">امکانات</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($menu as $menuItem)
							@if ($menuItem->position == 't')
								<tr>
									<td>{{$menuItem->title}}</td>
									<td>{{$menuItem->link}}</td>
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
							@endif
						@endforeach

					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
				
			@endif
		</div>
	</div>

	<div class="widget grid6">
		<div class="whead">
			<h6>منوی پایین</h6>
		</div>
		<div class="table">
			@if(count($menu) == 0) 
				<center>آیتمی برای نمایش وجود ندارد.</center>
			@else
				<table>
					<thead>
						<tr>
							<td>عنوان</td>
							<td>لینک</td>
							<td style="width: 50px;">
								<span class="sort">ترتیب</span><span class="loading" style="display:none;"><img width="10px" src="/assets/dashboard/img/icons/loading.gif"/></span>
							</td>
							<td style="width: 120px;">امکانات</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($menu as $menuItem)
							@if ($menuItem->position == 'b')
								<tr>
									<td>{{$menuItem->title}}</td>
									<td>{{$menuItem->link}}</td>
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
							@endif
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
