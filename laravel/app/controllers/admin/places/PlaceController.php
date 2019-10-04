<?php

class PlaceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Publish Status
		if (Request::ajax()) {
			$status = Input::get('status');
			$placeId = Input::get('placeId');
			if($status == "active") {
				$place = Place::find($placeId)->update(array('publish' => 'y'));
			} elseif ($status == "deactive") {
				$place = Place::find($placeId);
				$place->update(array('publish' => 'n'));
			}
		}

		$title 	= "اماکن";
		$places = Place::getPlaces();
		return View::make('admin/places/places')
				->with('title',$title)
				->with('places',$places);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title 		= 	"اضافه کردن مکان";
		$categories	= 	Category::getCategory();
		$parents	=	Category::getParent();
		return View::make('admin/places/create')
					->with('title',$title)
					->with('parents',$parents)
					->with('categories',$categories);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messages = array(
			'name.required'	=> 'نام مکان را وارد کنید.',
			'url.required'	=> 'لینک مکان را وارد کنید.',
			'url.unique' 	=> 'لینک مکان باید لینکی یکتا باشد.',
		);
		$place = array
			(
				'type'		=> 		Input::get('placeType'),
				'name'		=> 		Input::get('placeName'),
				'url'		=> 		Input::get('placeUrl'),
				'category'	=> 		Input::get('placeCategory'),
				'phone'		=>		Input::get('placePhone'),
				'fax'		=>		Input::get('placeFax'),
				'mobile'	=>		Input::get('placeMobile'),
				'site'		=>		Input::get('placeSite'),
				'address'	=>		Input::get('placeAddress'),
				'lat'		=>		Input::get('placeLat'),
				'long'		=>		Input::get('placeLong'),
			);
		$rule = array(
			'name'	=>	'required',
			'url'	=>	'required|unique:url'
		);
		$validator = Validator::make($place, $rule, $messages);
		if ($validator->passes()) {
			// Send to Place Model
			$Place = Place::setPlace($place);
			// Redirect and show Success Message
			return Redirect::route('admin.places.index')->with('message-success','اطلاعات با موفقیت ثبت شد.');
		} else {
			// return Redirect::route('admin.places.create')->with('message-error','خطا! <br /> - نام و لینک مکان را وارد کنید. <br /> - لینک مکان باید لینکی یکتا باشد.')->withInput();
			return Redirect::route('admin.places.create')->withErrors($validator)->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$title 		= 	'ویرایش';
		$place 		=	Place::find($id);
		$categories	= 	Category::getCategory();
		$parents	=	Category::getParent();
		$placecategories = Category::getPlaceCategories($id);
		return 	View::make('admin.places.edit')
					->with('place',$place)
					->with('categories',$categories)
					->with('placecategories',$placecategories)
					->with('parents',$parents)
					->with('title',$title);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$messages = array(
			'name.required'	=> 'نام مکان را وارد کنید.',
			'url.required'	=> 'لینک مکان را وارد کنید.',
			'url.unique' 	=> 'لینک مکان باید لینکی یکتا باشد.',
		);
		$place = array
			(
				'type'		=> 		Input::get('placeType'),
				'name'		=> 		Input::get('placeName'),
				'url'		=> 		Input::get('placeUrl'),
				'category'	=> 		Input::get('placeCategory'),
				'phone'		=>		Input::get('placePhone'),
				'fax'		=>		Input::get('placeFax'),
				'mobile'	=>		Input::get('placeMobile'),
				'site'		=>		Input::get('placeSite'),
				'address'	=>		Input::get('placeAddress'),
				'lat'		=>		Input::get('placeLat'),
				'long'		=>		Input::get('placeLong'),
			);
		$rule = array(
			'name'	=>	'required',
			'url'	=>	'required|unique:places,url,'.$id,
		);
		$validator = Validator::make($place, $rule, $messages);
		// Validation
		if ($validator->passes()) {
			// Send to Place Model
			$update = Place::updatePlace($id,$place);
			// Redirect and show Success Message
			return Redirect::route('admin.places.index')->with('message-success','اطلاعات با موفقیت ویرایش شد.');
		} else {
			// return Redirect::route('admin.places.create')->with('message-error','خطا! <br /> - نام و لینک مکان را وارد کنید. <br /> - لینک مکان باید لینکی یکتا باشد.')->withInput();
			return Redirect::back()->withErrors($validator)->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Delete url
		DB::table('url')->where('place_id','=',$id)->delete();
		// Delete place
		$place = Place::find($id);
		$place->delete();
		return Redirect::back();
	}

	/**
	* Place datails
	*
	*/
	public function details($id) 
	{
		// store to place_definitions
		if (Input::get('placeDefinitions')) {
			Place::setPlaceDefinition(Input::get('placeValue'),$id);
			return Redirect::back()->with('message-info','تغییرات ذخیره شده.');
		}
		// Show all definitions
		$title 			 = 'جزئیات';
		$place 			 = Place::find($id);
		$definitions	 = Definition::all();
		$values			 = DefinitionValue::all();
		$placeDefinitions= Place::getPlaceDefinition($id);
		return View::make('admin.places.details')
					->with('title',$title)
					->with('definitions',$definitions)
					->with('values',$values)
					->with('placeDefinitions',$placeDefinitions)
					->with('place',$place);
	}

	/**
	*	Place Fields
	*
	*/
	public function fields($id)
	{
		// store to place_fields
		if (Input::get('placeFields')) {
			$fieldId = Input::get('fieldId');
			$fieldDesc = Input::get('fieldDesc');
			Place::setPlaceFields($id,$fieldId,$fieldDesc);
			return Redirect::back()->with('message-info','تغییرات ذخیره شد.');
		}
		// Show fields
		$title 			= 'فیلد‌ها';
		$place 			= Place::find($id);
		$placeFields 	= Place::getPlaceFields($id);
		$fields 		= Field::all();
		return View::make('admin.places.fields')
					->with('title',$title)
					->with('place',$place)
					->with('placeFields',$placeFields)
					->with('fields',$fields);
	}

	/**
	* Place Menu
	*
	*/
	public function menu($id)
	{
		// create menu category
		if (Input::get('createMenuCategory')) {
			Place::setPlaceMenuCategory(Input::get('createMenuCategory'),$id);
			return Redirect::back();
		}
		// edit menu category
		if (Input::get('editMenuCategory')) {
			Place::updateMenuCategory(Input::get('menuCategoryId'), Input::get('editMenuCategory'));
			return Redirect::action('PlaceController@menu',array(Input::get('placeId')));
		}
		// delete menu category
		if(Input::get('deleteMenuCategory')) {
			Place::deleteMenuCategory(Input::get('menuCategoryId'));
			return Redirect::back();
		} 

		// create menu items
		if (Input::get('createMenuItem')) {
			$menuItems = array 
			(
				'itemTitle' 	=>	Input::get('itemTitle'),
				'itemDesc'		=>	Input::get('itemDesc'),
				'itemPrice'		=>	Input::get('itemPrice'),
				'itemCategory' 	=>	Input::get('itemCategories')
			);
			Place::setPlaceMenuItem($menuItems);
			return Redirect::back();
		}

		// edit menu items
		if(Input::get('editMenuItem')) {
			$menuItems = array 
			(
				'itemTitle' 	=>	Input::get('itemTitle'),
				'itemDesc'		=>	Input::get('itemDesc'),
				'itemPrice'		=>	Input::get('itemPrice'),
				'itemCategory' 	=>	Input::get('itemCategories')
			);
			Place::updateMenuItem(Input::get('menuItemId'),$menuItems);
			return Redirect::back();
		}
		// delete menu items
		if(Input::get('deleteMenuItem')) {
			Place::deleteMenuItem(Input::get('menuItemId'));
			return Redirect::back();
		}

		// Menu
		$title 			= 'منو';
		$menuCategories = Place::getPlaceMenuCategory($id);
		$menuItems 		= Place::getPlaceMenuItem();
		$place 			= Place::find($id);
		return View::make('admin.places.menu')
						->with('title',$title)
						->with('menuCategories',$menuCategories)
						->with('menuItems',$menuItems)
						->with('place',$place);


	}

	/*
	* Place Pictures
	*
	*/
	public function pictures($id)
	{
		// Upload picture
		if (Input::file('placePicture') && Input::get('placeId')) {
			// Validation
			$rules = array('placePicture' => 'required|image');
			$validation = Validator::make(Input::all(),$rules);
			if($validation->passes()) {
				$destinationPath = public_path().'/uploads/places/';
				$file = Input::file('placePicture');
				$title = Input::get('pictureTitle');
				// Get Picture Name with Extension
				$picName = $id.'-'.time().'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
				// Move File to Folder
				$file = $file ->move($destinationPath,$picName);
				// Store Name in DB
				Place::setPlacePicture($title, $picName, $id);
				return Redirect::back();
			} else {
				return Redirect::back()->with('message-error','خطا! فقط مجاز به بارگذاری فایل تصویری هستید.');
			}	
		}

		// Delete picture
		if (Input::get('deleteSubmit')) {
			$picture = Input::get('deletePictures');
			if ($picture) {
				Place::deletePicture($picture);
			}
			return Redirect::back();
		}
		// Cover and Logo
		if (Input::get('cover_logoSubmit')) {
			$placeId= Input::get('placeId');
			// delete previous value
			Place::find($placeId)->update(array('logo' => '', 'cover' => ''));
			// Logo
			$logo 	= Input::get('logoPicture');
			Place::setLogoPicture($logo,$placeId);
			// Cover
			$cover = Input::get('coverPicture');
			Place::setCoverPicture($cover,$placeId);
			return Redirect::back();
		}

		$title 		=	'تصاویر';
		$place 		= 	Place::find($id);
		$pictures	=	Place::getPlacePicture($id);
		return View::make('admin.places.pictures')
					->with('title',$title)
					->with('place',$place)
					->with('pictures',$pictures);
	}


}