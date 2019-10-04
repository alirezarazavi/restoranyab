<?php

class MenuController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Sort Menu
		if (Request::ajax()) {
			$menuId 	= Input::get('menuId');
			$menuSort 	= Input::get('menuSort');
			$menu 		= Menu::find($menuId);
			$menu 		->sort = Input::get('menuSort');
			$menu 		->save();
		}

		$title 	= 'منوساز';
		$menu 	= DB::table('menu')->orderBy('sort','desc')->get();
		$pages	= Page::all();
		return View::make('admin.menu.index')
				->with('title', $title)
				->with('menu', $menu)
				->with('pages', $pages);
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
		$menuItems = array(
			'title' 	=>		Input::get('menuTitle'),
			'link'		=>		Input::get('menuLink'),
			'position'	=>		Input::get('menuPosition')
		);
		// Quick Validation
		foreach ($menuItems as $item) :
			if($item == null) : return Redirect::back()->with('message-error','خطا! همه گزینه ها الزامی است.')->withInput(); endif;
		endforeach;
		// Store to Menu
		$menu = Menu::create(array(
			'title'		=>		$menuItems['title'],
			'link'		=>		$menuItems['link'],
			'position'	=>		$menuItems['position']
		));
		$menu->save();
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
		$title 		= 'منوساز';
		$menu 	= DB::table('menu')->orderBy('sort','desc')->get();
		$pages		= Page::all();
		$menuItem 	= Menu::find($id);
		return View::make('admin.menu.edit')
					->with('title', $title)
					->with('menu', $menu)
					->with('menuItem',$menuItem)
					->with('pages',$pages);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$menu = Menu::find($id);
		$menu->update(array(
			'title' 	=> Input::get('menuTitle'),
			'link'		=> Input::get('menuLink'),
			'position' 	=> Input::get('menuPosition')
		));
		$menu->save();
		return Redirect::route('admin.menu.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$menu = Menu::find($id);
		$menu->delete();
		return Redirect::back();
	}

}