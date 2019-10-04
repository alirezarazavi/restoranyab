<?php
class UserPlaceRegistrationController extends BaseController {

	public function index()
	{
		$title = 'کاربرها';
		$userPlaceRegistration = UserPlaceRegistration::getUserPlaceRegistration();
		return View::make('admin.usersPlaceRegistration.index')
					->with('userPlaceRegistration', $userPlaceRegistration)
					->with('title',$title);
	}

}