<?php

class NewsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title 	= 'اخبار';
		$news 	= News::orderBy('id','desc')->get();
		return View::make('admin.news.index')
				->with('title',$title)
				->with('news',$news);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = 'افزودن خبر';
		return View::make('admin.news.create')->with('title',$title);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messages = array(
			'title.required' 	=> 	'عنوان خبر را وارد کنید',
			'title.unique' 		=>	'عنوان خبر تکراری است'
		);
		$inputs = array(
			'title'	=>	Input::get('newsTitle')
		);
		$rules = array(
			'title' =>	'required|unique:news'
		);
		$validator = Validator::make($inputs, $rules, $messages);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();

		} else {

			$news = News::create(array(
				'title'	=>	Input::get('newsTitle'),
				'text'	=>	Input::get('newsText'),
				'link'	=>	str_replace(' ', '-', Input::get('newsTitle'))
			));
			$news->save();
			return Redirect::route('admin.news.index');
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
		$title 	= 'ویرایش خبر';
		$news 	= News::find($id);
		return View::make('admin.news.edit')
				->with('title',$title)
				->with('news',$news);
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
			'title.required' 	=> 	'عنوان خبر را وارد کنید',
			'title.unique' 		=>	'عنوان خبر تکراری است'
		);
		$inputs = array(
			'title'	=>	Input::get('newsTitle')
		);
		$rules = array(
			'title' =>	'required|unique:news,title,'.$id,
		);
		$validator = Validator::make($inputs, $rules, $messages);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		} else {
			$news = News::find($id);
			$news->title = Input::get('newsTitle');
			$news->text  = Input::get('newsText');
			$news->link  = str_replace(' ', '-', Input::get('newsTitle'));
			$news->save();
			return Redirect::route('admin.news.index');
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
		$news 	= News::find($id);
		$news->delete();
		return Redirect::back();
	}

}