@extends('admin.layouts.master')
@section('content')

<!-- Menu Item -->
<div class="wrapper grid7 left">
	<div class="widget">
		<div class="whead">
			<h6>منو «{{$place->title}}»</h6>
		</div>
		<div class="table">
			@if (!$menuCategories) 
				<center>ابتدا یک دسته برای منوها اضافه کنید.</center>
			@else
				<table>
					<thead>
						<tr>
							<td style="width: 100px;">دسته</td>
							<td style="width: 100px;">عنوان</td>
							<td style="width: 100px;">قیمت</td>
							<td style="width: 100px;">شرح</td>
							<td style="width: 120px;">امکانات</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($menuCategories as $menuCategory)
							@foreach ($menuItems as $menuItem)
								<tr>
									@if ($menuItem->menu_cat_id == $menuCategory->id)
										<td>{{$menuCategory->title}}</td>
										<td>{{$menuItem->title}}</td>
										<td>{{$menuItem->price}}</td>
										<td>{{$menuItem->description}}</td>
										<td>
										{{Form::open(array('url'=>'#','method'=>'POST'))}}
											<input type="hidden" name="menuItemId" value="{{$menuItem->id}}">
											<input type="submit" class="buttonXS bRed left" name="deleteMenuItem" rel="delete" value="حذف" />
										{{Form::close()}}

										{{Form::open(array('url'=>'#','method'=>'POST'))}}
											<input type="hidden" name="menuItemId" value="{{$menuItem->id}}">
											<input type="submit" class="buttonXS bSea left" name="editItem" value="ویرایش" />
										{{Form::close()}}
										</td>
									@endif
								</tr>
							@endforeach
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5" style="padding: 10px;">
								<!-- Edit Menu Item -->
								@if(Input::get('menuItemId') && Input::get('editItem')) 
									{{Form::open(array('url'=>'#','method'=>'POST'))}}
										@foreach ($menuItems as $menuItem)
											@if ($menuItem->id == Input::get('menuItemId'))
												<input type="text" name="itemTitle" placeholder="نام" value="{{$menuItem->title}}" />
												<input type="text" name="itemDesc" placeholder="شرح" value="{{$menuItem->description}}" />
												<input type="text" name="itemPrice" placeholder="قیمت" value="{{$menuItem->price}}" />
												<select name="itemCategories">
													@foreach ($menuCategories as $menuCategory)
														<option name="itemCategories" value="{{$menuCategory->id}}">{{$menuCategory->title}}</option>
													@endforeach
												</select>
												<input type="hidden" name="menuItemId" value="{{$menuItem->id}}">
												<input type="submit" name="editMenuItem" value="ذخیره" class="buttonH bLightBlue left" />
												{{link_to('admin/places/'.Request::segment('3').'/menu', 'انصراف', array('class'=>'buttonLink left', 'style'=>'margin-top:6px;'))}}
											@endif
										@endforeach
									{{Form::close()}}
								@else
								<!-- Create Menu Item -->
									{{Form::open(array('url'=>'#','method'=>'POST'))}}
										<input type="text" name="itemTitle" placeholder="نام" />
										<input type="text" name="itemDesc" placeholder="شرح" />
										<input type="text" name="itemPrice" placeholder="قیمت" />
										<select name="itemCategories">
											@foreach ($menuCategories as $menuCategory)
												<option name="itemCategories" value="{{$menuCategory->id}}">{{$menuCategory->title}}</option>
											@endforeach
										</select>
										<input type="submit" name="createMenuItem" value="ذخیره" class="buttonH bLightBlue left" />
									{{Form::close()}}
								@endif
							</td>
						</tr>
					</tfoot>
				</table>
			@endif
		</div>
	</div>
</div>

<!-- Menu Category -->
<div class="wrapper grid4 right">
	<div class="widget">
		<div class="whead">
			<h6>دسته بندی منو</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td style="width:130px;">نام دسته</td>
						<td>امکانات</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($menuCategories as $menuCategory)

						<tr>
							<td>{{$menuCategory->title}}</td>
							<td>
							{{Form::open(array('url'=>'#','method'=>'POST'))}}
								<input type="hidden" name="menuCategoryId" value="{{$menuCategory->id}}">
								<input type="submit" class="buttonXS bRed left" name="deleteMenuCategory" rel="delete" value="حذف" />
							{{Form::close()}}
								{{link_to_action('PlaceController@menu','ویرایش', array('id'=>$menuCategory->place_id, 'menuId'=>$menuCategory->id), array('class'=>'buttonLink left blSea'))}}
							</td>
						</tr>

					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2" style="padding: 5px;">
							{{Form::open(array('url'=>'#','method'=>'POST'))}}

								<!-- Edit Menu Category -->
								@if(Request::segment('5')) 
									@foreach ($menuCategories as $menuCategory)
										@if ($menuCategory->id == Request::segment('5')) 
											<input type="hidden" name="placeId" value="{{$menuCategory->place_id}}">
											<input type="hidden" name="menuCategoryId" value="{{$menuCategory->id}}">
											<input type="text" style="width:200px; margin-top:5px;" name="editMenuCategory" placeholder="ویرایش" value="{{$menuCategory->title}}" />
										@endif
									@endforeach
								@else

								<!-- Create Menu Category -->
									<input type="text" style="width:200px; margin-top:5px;" name="createMenuCategory" placeholder="دسته جدید" />
								@endif
								<input type="submit" name="menuCategory" value="ذخیره" class="buttonH bLightBlue left" />

								<!-- Discard Button -->
								@if ($menuCategories)
									@if(Request::segment('5'))
										<a href="{{URL::to('admin/places/'.$menuCategory->place_id.'/menu')}}" class="buttonLink left" style="margin-top:6px;">انصراف</a>
									@endif
								@endif

							{{Form::close()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>



@stop
