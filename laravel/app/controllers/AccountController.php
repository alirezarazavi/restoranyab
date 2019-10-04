<?php
class AccountController extends BaseController {

	public function __construct()
	{
		$menuMaker 	= DB::table('menu')
						->orderBy('sort','desc')
						->get();
		$pages 		= DB::table('pages')
						->get();
		View::share(array(
			'menuMaker'		=>	$menuMaker,
			'pages'			=>	$pages
		));
	}


	/*
	/ Sign In
	*/
	public function getSignin()
	{
		$title = "ورود";
		return View::make('account.signin')->with('title',$title);
	}

	public function postSignin() 
	{
		$rules = array(
			'email' 	=> 	'required|email',
			'password'	=> 	'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return 	Redirect::to('signin')
					->withErrors($validator)
					->withInput();
		} else {
			$auth = Auth::attempt(array(
					'email'		=>	Input::get('email'),
					'password'	=>	Input::get('password')
			));

			if($auth) {
				// Store Last Login 
					// DB::table('users')
					// 	->where('username', '=', Auth::user()->username)
					// 	->update(array('last_login' => $date));
				$date = new \DateTime;
				$user = Auth::user();
				$user->last_login = $date;
				$user->save();
				return Redirect::intended();
			} else {
				return Redirect::route('signin')->with('error','ایمیل یا رمز عبور صحیح نیست.')->withInput();
			}
		}
	}

	/*
	/ Sign Out
	*/
	public function getSignout()
	{
		Auth::logout();
		return Redirect::route('home');
	}

	/*
	/ Sign Up
	*/
	public function getSignup()
	{
		$title = "ثبت نام";
		return View::make('account.signup')->with('title',$title);
	}

	public function postSignup()
	{
		if(Input::get('signup')) {

			$rules = array(
				'username'			=>	'required|min:4|unique:users',
				'email'				=>	'required|email|unique:users',
				'password'			=>	'required|min:6|max:30',
				'password_confirm'	=>	'required|same:password'
			);

			$validator = Validator::make(Input::all(), $rules);

			if($validator->fails()) {
				return Redirect::to('signup')
								->withErrors($validator)
								->withInput();
			} else {

				$username 	= Input::get('username');
				$email 		= Input::get('email');
				$password 	= Hash::make(Input::get('password'));
				$role 		= 'user';
				
				$user = User::create(array(
						'username' 	=>	$username,
						'email'		=>	$email,
						'password'	=>	$password,
						'role'		=>	$role,
					));
				if($user) {
					return Redirect::route('home')
							->with('message','ثبت نام با موفقیت انجام شد!');
				}
			}
		}
	}

}