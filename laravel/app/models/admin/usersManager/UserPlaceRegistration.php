<?php
class UserPlaceRegistration extends Eloquent {

	public static function getUserPlaceRegistration() 
	{
		return DB::table('user_place_registration')->orderBy('id','desc')->get();
	}
}