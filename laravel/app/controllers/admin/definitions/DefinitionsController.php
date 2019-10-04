<?php

class DefinitionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'تعاریف اولیه';
		$definitions = Definition::getDefinition();
		return 	View::make('admin/definitions/index')
					->with('title',$title)
					->with('definitions',$definitions);
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
		$definition = Input::get('definition');
		Definition::setDefinition($definition);
		return Redirect::route('admin.definitions.index');
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
		$title       = 'ویرایش';
		$definitions = Definition::find($id);
		return View::make('admin/definitions/edit')->with('title',$title)->with('definitions',$definitions);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules     = array('definition' => 'required');
		$validator = Validator::make(Input::all(), $rules);
		if($validator->passes()) {
			$definitions = Definition::find($id);
			$definitions->title = Input::get('definition');
			$definitions->save();
			return Redirect::route('admin.definitions.index');
		} else {
			return Redirect::route('admin.definitions.index');
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
		// Delete definition
		$definition = Definition::find($id);
		$definition->delete();
		// Delete definition values
		$definitionValue = DefinitionValue::where('definition_id','=',$id)->get();
		foreach($definitionValue as $value):
			// delete value icon
			unlink(public_path().'/uploads/definitionValues/'.$value->image);
			// delete value
			$value->delete();
		endforeach;
		return Redirect::route('admin.definitions.index');
	}

	/**
	* Update the show_filter status
	*
	*/
	public function status($id,$status)
	{		
		if($status == 'active_filter') {
			$definition = Definition::find($id);
			$definition->show_filter = 'y';
			$definition->save();
			return Redirect::back();
		} elseif ($status == 'deactive_filter') {
			$definition = Definition::find($id);
			$definition->show_filter = 'n';
			$definition->save();
			return Redirect::back();
		}

		if($status == 'active_list') {
			$definition = Definition::find($id);
			$definition->show_list = 'y';
			$definition->save();
			return Redirect::back();
		} elseif ($status == 'deactive_list') {
			$definition = Definition::find($id);
			$definition->show_list = 'n';
			$definition->save();
			return Redirect::back();
		}
	}


}