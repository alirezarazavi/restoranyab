@extends('admin.layouts.master')
@section('content')

<div class="wrapper">
	<div class="widget">
		<div class="whead">
			<h6>ویرایش «{{$place->title}}»</h6>
		</div>
		{{Form::open(array('route' => array('admin.places.update',$place->id), 'method' => 'PUT'))}}
			<input type="hidden" value="1" name="placeType">
			<div class="formRow">
				<div class="grid6">
					<div class="grid2">
						<label for="placeName">نام</label>
					</div>
					<div class="grid10">
						<input type="text" name="placeName" id="placeName" value="{{ $place->title }}" placeholder="مثال: رستوران آبشار خلیج فارس">
					</div>
				</div>
				<div class="grid6">
					<div class="grid2">
						<label for="placeUrl">لینک یکتا <a class="icon-question tooltip" title="لینک یکتا نباید قبلا به وسیله مکان دیگری استفاده شده باشد."></a></label>
					</div>
					<div class="grid10">
						<input type="text" name="placeUrl" id="placeUrl" placeholder="مثال: رستوران-آبشار-خلیج-فارس" value="{{ $place->url }}">
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
										<label><input type="checkbox" class="check" @foreach ($placecategories as $pc) @if ($pc->category_id == $category->id) checked="checked" @endif @endforeach name="placeCategory[]" value="{{$category->id}}">{{$category->title}}</label>
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
					<input type="text" name="placePhone" placeholder="تلفن " value="{{$place->tel}}" />
				</div>
				<div class="grid3">
					<input type="text" name="placeMobile" placeholder="موبایل " value="{{$place->mobile}}" />
				</div>
				<div class="grid3">
					<input type="text" name="placeFax" placeholder="فکس " value="{{$place->fax}}" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label for="placeSite">سایت <a title="فقط آدرس و پسوند سایت را وارد کنید. نیازی به وارد کردن http و www نیست. مثال: site.ir" class="tooltip icon-question"></a></label>
				</div>
				<div class="grid10">
					<input type="text" id="placeSite" name="placeSite" placeholder="example.ir" dir="ltr" value="{{$place->site}}" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="grid2">
					<label for="placeAddress">آدرس</label>
				</div>
				<div class="grid10">
					<input type="text" name="placeAddress" id="placeAddress" value="{{$place->address}}" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="grid2">
					<label>موقعیت جغرافیایی</label>
				</div>
				<div class="grid5">
					<input type="text" name="placeLat" placeholder="عرض " value="{{$place->lat}}" />
				</div>
				<div class="grid5">
					<input type="text" name="placeLong" placeholder="طول " value="{{$place->long}}" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<div class="grid12">
					<input type="submit" name="edit" value="ذخیره تغییرات" class="buttonH bGreen left" />
					{{ link_to_route('admin.places.index','انصراف',null,array('class'=>'button left', 'style'=>'margin-top:7px;')) }}
				</div>
				<div class="clear"></div>
			</div>
			<!-- <input type="hidden" name="pass" value="create" /> -->
		{{Form::close()}}
	</div>
</div>

@stop