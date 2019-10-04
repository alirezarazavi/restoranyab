<?php

class FieldsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title 	= 	'فیلدها';
		$fields =	Field::all();
		return View::make('admin.fields.index')
				->with('fields',$fields)
				->with('title',$title);
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
		$field = Field::create(array(
			'title'		=> 	Input::get('field')
		));
		$field->save();
		return Redirect::route('admin.fields.index');
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
		$title 		= 'فیلدها';
		$editField	= Field::find($id);
		$fields 	= Field::all();
		return View::make('admin.fields.edit')
					->with('editField',$editField)
					->with('fields',$fields)
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
		$field = Field::where('id','=',$id)->update(array(
			'title'	=>	Input::get('updateField')
		));

		return Redirect::route('admin.fields.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$field = Field::find($id);
		$field->delete();
		return Redirect::route('admin.fields.index');
	}

	/**
	* Fields Icon
	*
	*/
	public function icon($id)
	{
		// check if uploaded file is image
		$rules 		= array ('icon'=>'required|image');
		$validator 	= Validator::make(Input::all(), $rules);
		// (If error happens, enable 'extension=php_fileinfo.dll' at php.ini)
		if($validator->fails()) {
			return Redirect::back()->with('message-error','خطا! فقط مجاز به بارگذاری فایل های تصویری هستید.');
		} else {
			// delete old icon
			$fields = Field::find($id);
			if($fields->icon == !null) {
				unlink(public_path().'/uploads/fields/'.$fields->icon);
			}
			// upload
			$destinationPath = $destinationPath = public_path().'/uploads/fields/';
			$file = Input::file('icon');
			$fileName = $id.'-'.time().'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
			$file ->move($destinationPath,$fileName);
			// store location at db (definition_values - image)
			$catIcon = Field::find($id);
			$catIcon ->icon = $fileName;
			$catIcon ->save();
			return Redirect::back()->with('message-success','آیکون با موفقیت بارگذاری شد.');
		}
	}

}