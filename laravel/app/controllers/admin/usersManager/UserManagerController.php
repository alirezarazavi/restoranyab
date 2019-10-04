<?php 
class UserManagerController extends BaseController {

	public function index()
	{
		// change user role
		if (Request::ajax() == 'role') {
			$role 	= Input::get('role');
			$uid 	= Input::get('uid');
			if ($role == 'admin') {
				User::where('id','=',$uid)->update(array('role' => 'user'));
			}
			if ($role == 'user') {
				User::where('id','=',$uid)->update(array('role' => 'admin'));	
			}
		}

		// initialize page
		$title = 'کاربرها';
		$users = User::orderBy('role','asc')->paginate(10);
		return View::make('admin.usersManager.index')
					->with('users',$users)
					->with('title',$title);
	}

}