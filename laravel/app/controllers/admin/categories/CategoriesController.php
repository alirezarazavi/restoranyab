<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Sort Categories
		if (Request::ajax()) {
			$catId 		= Input::get('catId');
			$catSort 	= Input::get('catSort');
			$category 	= Category::find($catId);
			$category 	->sort = Input::get('catSort');
			$category 	->save();
		}

		$title 		= 	"دسته ها";
		$categories = 	Category::getCategory();
		$parents	=	Category::getParent();
		return 	View::make('admin/categories/categories')
					->	with('parents',$parents)
					->	with('title', $title)
					->	with('categories', $categories);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$category 		= 	Input::get('category');
		$categoryList 	=	Input::get('categoryList');
		if ($category 	== 	null) : 
			return Redirect::route('admin.categories.index')->with('message-error','همه گزینه ها اجباری است.')->withInput();
		endif;
		Category::setCategory($category,$categoryList);
		return Redirect::route('admin.categories.index')->with('message-success','دسته ایجاد شد.');
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
		$title 		= 	"دسته ها";
		$categories = 	Category::getCategory();
		$parents	=	Category::getParent();
		$category 	=	Category::find($id);
		return 	View::make('admin/categories/categories')
					->	with('title',$title)
					->	with('parents',$parents)
					->	with('categories',$categories)
					->	with('category',$category);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category 		= 	Input::get('category');
		$categoryList 	=	Input::get('categoryList');
		if ($category 	== 	null) : 
			return Redirect::route('admin.categories.edit')->with('message-error','همه گزینه ها اجباری است.')->withInput();
		endif;
		$category 	= Category::find($id);
		$category 	->title  = Input::get('category');
		$category 	->parent = Input::get('categoryList');
		$category 	->save();
		return Redirect::route('admin.categories.index')->with('message-success','دسته با موفقیت ویرایش شد.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		// delete icon
		if($category->icon){
			unlink(public_path().'/uploads/categories/'.$category->icon);
		}
		// delete category
		$category ->delete();
		return Redirect::route('admin.categories.index');
	}

	public function icon($id)
	{
		// check if uploaded file is image
		$rules 		= array ('icon'=>'required|image');
		$validator 	= Validator::make(Input::all(), $rules);
		// (If error happens, enable 'extension=php_fileinfo.dll' at php.ini)
		if($validator->fails()) {
			return Redirect::route('admin.categories.index')->with('message-error','خطا! فقط مجاز به بارگذاری فایل های تصویری هستید.');
		} else {
			// delete old icon
			$category = Category::find($id);
			if($category->icon == !null) {
				unlink(public_path().'/uploads/categories/'.$category->icon);
			}
			// upload
			$destinationPath = $destinationPath = public_path().'/uploads/categories/';
			$file = Input::file('icon');
			$fileName = $id.'-'.time().'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
			$file ->move($destinationPath,$fileName);
			// store location at db (categories - icon)
			$catIcon = Category::find($id);
			$catIcon ->icon = $fileName;
			$catIcon ->save();
			return Redirect::route('admin.categories.index')->with('message-success','تصویر با موفقیت بارگذاری شد.');
		}
	}



}