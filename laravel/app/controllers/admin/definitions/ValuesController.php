<?php

class ValuesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'مقادیر';
		return View::make('admin.values.index')->with('title',$title);
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
		$value = Input::get('value');
		$definition_id = Input::get('definition_id');
		DefinitionValue::setValue($value,$definition_id);
		return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$values = DefinitionValue::getValue($id);
		$definition = Definition::find($id);
		$title = "مقادیر ". $definition->title;
		return View::make('admin.values.index')
				->with('title',$title)
				->with('values',$values)
				->with('definition_id',$id)
				->with('definition',$definition);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$title = "ویرایش";
		$values = DefinitionValue::find($id);
		return View::make('admin.values.edit')
				->with('title',$title)
				->with('values',$values);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules     	= array('value' => 'required');
		$validator 	= Validator::make(Input::all(), $rules);
		if($validator->passes()) {
			$values = DefinitionValue::find($id);
			$values ->title = Input::get('value');
			$values ->save();
			return Redirect::action('ValuesController@show',array($values->definition_id));
		} else {
			return Redirect::back();
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
		$value = DefinitionValue::find($id);
		// delete value icon
		if($value->image) {
			unlink(public_path().'/uploads/definitionValues/'.$value->image);
		}
		// delete value
		$value->delete();
		return Redirect::back();
	}

	/*
	* Values Icon
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
			$values = DefinitionValue::find($id);
			if($values->image == !null) {
				unlink(public_path().'/uploads/definitionValues/'.$values->image);
			}
			// upload
			$destinationPath = $destinationPath = public_path().'/uploads/definitionValues/';
			$file = Input::file('icon');
			$fileName = $id.'-'.time().'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
			$file ->move($destinationPath,$fileName);
			// store location at db (definition_values - image)
			$catIcon = DefinitionValue::find($id);
			$catIcon ->image = $fileName;
			$catIcon ->save();
			return Redirect::back()->with('message-success','تصویر با موفقیت بارگذاری شد.');
		}
	}

}