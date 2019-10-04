<?php

class PageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title 	= 'صفحات';
		$pages 	= Page::all();
		return View::make('admin.pages.index')
				->with('title',$title)
				->with('pages',$pages);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title 	=	'ایجاد صفحه';
		return View::make('admin.pages.create')
				->with('title',$title);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$page = Page::create(array(
			'title'	=> Input::get('pageTitle'),
			'link'	=> Input::get('pageLink')
		));
		$page->save();
		return Redirect::route('admin.pages.index');
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
		$title 	= 'ویرایش صفحه';
		$page 	= Page::find($id);
		return View::make('admin.pages.edit')
				->with('title',$title)
				->with('page',$page);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = Page::find($id);
		$page->title = Input::get('pageTitle');
		$page->link  = Input::get('pageLink');
		$page->save();
		return Redirect::route('admin.pages.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Delete page contents
		$content = PageContent::where('page_id','=',$id)->get();
		foreach ($content as $c):
			$c->delete();
		endforeach;
		// Delete Page
		$page = Page::find($id);
		$page->delete();

		return Redirect::back();
	}

}