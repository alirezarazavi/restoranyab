<?php

class PageContentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $title 	= 'محتوای صفحه';
		// return View::make('admin.pages.content.create')
		// 		->with('title',$title);
		return $this->show(Request::segment(3));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title 		=	'ایجاد صفحه';
		$pageId 	= Request::segment(3);
		return View::make('admin.pageContent.create')
				->with('title',$title)
				->with('pageId',$pageId);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$content = PageContent::create(array(
			'title'		=> Input::get('contentTitle'),
			'text'		=> Input::get('contentText'),
			'page_id'	=> Input::get('pageId')
		));
		$content->save();
		return Redirect::route('admin.pages.{pageId}.content.index',Input::get('pageId'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$title = 'محتوای صفحه';
		$pageContent = PageContent::where('page_id','=',$id)->get();
		$page = Page::find($id);
		return View::make('admin.pageContent.index')
				->with('title',$title)
				->with('pageContent',$pageContent)
				->with('page',$page);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id,$content)
	{
		$title 	= 'ویرایش صفحه';
		$content= PageContent::find($content);
		return View::make('admin.pageContent.edit')
				->with('title',$title)
				->with('content',$content);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,$content)
	{
		$content = PageContent::find($content);
		$content->title = Input::get('contentTitle');
		$content->text  = Input::get('contentText');
		$content->save();
		return Redirect::route('admin.pages.{pageId}.content.index',$id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,$content)
	{
		$pageContent = PageContent::find($content);
		$pageContent ->delete();
		return Redirect::back();
	}

}