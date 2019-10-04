@extends('admin.layouts.master')
@section('content')
<!-- Add Form -->
<div class="wrapper left">
	<div class="widget">
		
		<div class="whead">
			<h6>@if (Route::is('admin.categories.edit')) ویرایش @else اضافه کردن @endif</h6>
		</div>
		<div class="table">
			<!-- Edit -->
			@if (Route::is('admin.categories.edit'))
				{{Form::open(array('route' => array('admin.categories.update',$category->id), 'method' => 'PUT'))}}
			@else
			<!-- Create -->
				{{Form::open(array('route' => array('admin.categories.store'), 'method' => 'POST'))}}
			@endif
			<table>
				<thead>
					<tr>
						<td style="width:200px;">نام</td>
						<td style="width:150px;">نوع</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="padding: 0px 7px;">
							<!-- Edit -->
							@if (Route::is('admin.categories.edit')) 
								<input type="text" dir="rtl" name="category" value="{{$category->title}}" placeholder="دسته" id="category" class="validate_text" />
							@else
							<!-- Create -->
								<input type="text" dir="rtl" name="category" value="{{Input::old('category')}}" placeholder="دسته" id="category" class="validate_text" />
							@endif
						</td>
						<td style="padding: 10px 20px;">
							<select name="categoryList">
								<option name="categoryList" value="0" selected="selected">دسته اصلی</option>
									<!-- Edit -->
									@if(Route::is('admin.categories.edit'))
										@foreach ($parents as $parent)
											@if ($parent->id == $category->parent)
												<option name="categoryList" value="{{$category->parent}}" selected="selected">
													{{$parent->title}}
												</option>
											@endif
										@endforeach
									@endif
									<!-- Create -->
									@foreach ($categories as $category)
										@if($category->parent == 0)
											<option name="categoryList" value="{{$category->id}}">{{$category->title}}</option>
										@endif
									@endforeach
							</select>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">        
							<input type="submit" name="createCategory" value="ذخیره" class="buttonH bLightBlue" style="float: left;" />
							@if (Route::is('admin.categories.edit'))
								{{link_to_route('admin.categories.index','انصراف',null,array('class'=>'button left','style'=>'margin-top:7px;'))}}
							@endif
						</td>
					</tr>
				</tfoot>
			</table>
			{{Form::close()}}
		</div>
	</div>
</div>
<!-- List Form -->
<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>دسته ها</h6>
		</div>
		<div class="table">
			<table>
				<thead>
					<tr>
						<td style="width: 150px;">نام</td>
						<td style="width: 100px;">نوع</td>
						<td style="width: 50px;"><span class="sort">ترتیب</span><span class="loading" style="display:none;"><img width="10px" src="/assets/dashboard/img/icons/loading.gif"/></span></td>
						<td style="width: 50px;">آیکون</td>
						<td style="width: 120px;">امکانات</td>
					</tr>
				</thead>
				<tbody>
					@if (!$categories)
						<tr><td colspan="5"><center>دسته ای برای نمایش وجود ندارد.</center></td></tr>
					@endif
					@foreach ($categories as $category)
						<tr>
							<td>{{$category->title}}</td>
							<td>
								@if($category->parent == 0) دسته اصلی @endif
								@foreach ($parents as $parent)
									@if ($parent->id == $category->parent)
										{{$parent->title}}
									@endif
								@endforeach
							</td>
							<td>
								<input type="text" name="categorySort" class="categorySort" value="{{$category->sort}}" style="width: 50px; text-align:center; display:block; margin: 0 auto;" />
								<input type="hidden" name="categoryId[]" class="categoryId" value="{{$category->id}}">
							</td>
							<td>
								<a href="#icon{{$category->id}}" class="button" data-icon="&#xe616;">آیکون</a>
								<div id="icon{{$category->id}}" class="modalDialog">
									<div>
										<a href="#" title="Close" class="close">X</a>
										<h2>آیکون «{{$category->title}}»</h2>
										<br/>
										<div>
											@if($category->icon == NULL) 
												<p>آیکونی برای {{$category->title}} بارگذاری نشده است.</p>
											@else
												<p class="icon">
													{{HTML::image('/uploads/categories/'.$category->icon.'')}}
												</p>
												<p>در صورت بارگذاری مجدد، آیکون جدید جایگزین قبلی خواهد شد.</p>
											@endif
										</div>
										<div>
											<p>یک آیکون بارگذاری کنید.</p>
											{{Form::open(array('url'=>'admin/categories/icon/'.$category->id.'','files'=>true,'method'=>'POST'))}}
											{{Form::file('icon')}}
											{{Form::submit('آپلود',array('class'=>'buttonS bDefault','style'=>'margin-top:6px;padding-top:4px;'))}}
											{{Form::close()}}
										</div>
									</div>
								</div>
							</td>
							<td>
								{{link_to_route('admin.categories.edit','ویرایش',$category->id,array('class'=>'button','data-icon'=>'&#xe607;'))}}
								{{Form::open(array('route' => array('admin.categories.destroy', $category->id), 'method' => 'DELETE', 'style' => 'display:inline', 'rel' => 'delete'))}}
									{{Form::submit('حذف', array('class' => 'buttonLink buttonLinkRed'))}}
								{{Form::close()}}
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
							
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

@stop
