<?php
class SettingsController extends BaseController {

	public function index()
	{
		$title 		= "تنظیمات";
		$pages 		= Page::all();
		$settings 	= Setting::all();
		return View::make('admin.settings.index')
				->with('title',$title)
				->with('pages',$pages)
				->with('settings',$settings);
	}

	public function store()
	{

		$exist = Setting::where('name','=','home_intro')->get();
		if ($exist) 
		{

			Setting::where('name','=','home_intro')->update(array('value' => Input::get('homeIntro')));

		} 
		else 
		{

			Setting::create(array('name' => 'home_intro', 'value' => Input::get('homeIntro')));

		}

		return Redirect::route('admin.settings.index')->with('message-info','تغییرات ذخیره شد.');
	}

}