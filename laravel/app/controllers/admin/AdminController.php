<?php

class AdminController extends BaseController {

	// ADMIN/INDEX page
	public function index() 
	{
		$title 		= "مدیریت";
		$places 	= Place::all();
		$users 		= DB::table('users')->orderBy('id','desc')->take(5)->get();
		$publish 	= DB::table('places')->where('publish','=','y')->count();
		$draft  	= DB::table('places')->where('publish','=','n')->count();
		$placeStat 	= array('publish' => $publish, 'draft' => $draft);
		return View::make('admin/index')
					->with('title', $title)
					->with('places', $places)
					->with('users', $users)
					->with('placeStat', $placeStat);
	}
	

}