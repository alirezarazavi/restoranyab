@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget grid12">
		<div class="whead">
			<h6>افزودن مکان</h6>
		</div>
		@if(!$categories) 
			<center>ابتدا از قسمت تعاریف، تعاریف اولیه، مقادیر و دسته ها را وارد کنید.</center> 
		@else
		{{Form::open(array('route' => array('admin.places.store'), 'method' => 'POST', 'files' => true))}}
			<input type="hidden" value="1" name="placeType">
			<div class="formRow">
				<div class="grid6">
					<div class="grid2">
						<label for="placeName">نام</label>
					</div>
					<div class="grid10">
						<input type="text" name="placeName" id="placeName" placeholder="مثال: رستوران آبشار خلیج فارس" value="{{ Input::old('placeName') }}">
					</div>
				</div>
				<div class="grid6">
					<div class="grid2">
						<label for="placeUrl">لینک یکتا <a class="icon-question tooltip" title="لینک یکتا نباید قبلا به وسیله مکان دیگری استفاده شده باشد."></a></label>
					</div>
					<div class="grid10">
						<input type="text" name="placeUrl" id="placeUrl" placeholder="مثال: رستوران-آبشار-خلیج-فارس" value="{{ Input::old('placeUrl') }}">
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="grid2">
					<label for="placeCats">دسته ها</label>
				</div>
						<?php $parentval = ''; ?>
						@foreach ($parents as $parent)
							@if ($parent->parent == 0)
								<?php $parentval = $parent->id; ?>
								<div class="grid5">
									<legend>{{$parent->title}}</legend>
									@foreach ($categories as $category)
										@if ($category->parent == $parentval)
											<fieldset>
												<label>
													<input type="checkbox" name="placeCategory[]" value="{{$category->id}}" class="check" />
													{{$category->title}}
												</label>
											</fieldset>	
										@endif
									@endforeach	
								</div>
							@endif
						@endforeach
				<div class="clear"></div>
			</div>
					
			<div class="formRow">
				<div class="grid2">
					<label>شماره تلفن <a title="شماره تلفن‌ها را با اعداد انگلیسی وارد کنید." class="tooltip icon-question"></a></label>
				</div>
				<div class="grid3">
					<input type="text" name="placePhone" placeholder="تلفن" value="" />
				</div>
				<div class="grid3">
					<input type="text" name="placeMobile" placeholder="موبایل" value="" />
				</div>
				<div class="grid3">
					<input type="text" name="placeFax" placeholder="فکس" value="" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label for="placeSite">سایت <a title="فقط آدرس و پسوند سایت را وارد کنید. نیازی به وارد کردن http و www نیست. مثال: site.ir" class="tooltip icon-question"></a></label>
				</div>
				<div class="grid10">
					<input type="text" id="placeSite" name="placeSite" placeholder="example.ir" dir="ltr" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label for="placeAddress">آدرس</label>
				</div>
				<div class="grid10">
					<input type="text" name="placeAddress" id="placeAddress" value="" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label>موقعیت جغرافیایی</label>
				</div>
				<div class="grid5">
					<input type="text" name="placeLat" placeholder="عرض" value="" />
				</div>
				<div class="grid5">
					<input type="text" name="placeLong" placeholder="طول" value="" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="grid12">
					<input type="submit" name="create" value="ذخیره" class="buttonH bGreen left" />
					{{link_to_route('admin.places.index','انصراف',null,array('class'=>'button left','style'=>'margin-top:7px;'))}}
					
				</div>
				<div class="clear"></div>
			</div>
			<!-- <input type="hidden" name="pass" value="create" /> -->
		{{Form::close()}}
		@endif
	</div>

	<!-- <div class="widget grid3">
		<div class="whead">
			<h6>راهنما</h6>
		</div>
		<div class="body">
			<p>۱. نام رستوران باید نامی یکتا باشد که از قبل ثبت نشده باشد.</p>
		</div>

	</div> -->
</div>

@stop