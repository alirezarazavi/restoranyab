<?php
class Category extends Eloquent {

	public static function setCategory($category,$categoryList)
	{
		DB::table('categories')	->	insert(array(
			'title' 			=> 	$category,
			'parent'			=>	$categoryList,
			'topcategory_id'	=>	1
		));
	}

	public static function getCategory()
	{
		return DB::table('categories')->orderBy('parent','desc')->get();
	}

	public static function getParent()
	{
		return DB::table('categories')->orderBy('parent','desc')->get();
	}

	public static function getPlaceCategories($placeId)
	{
		return DB::table('place_categories')->where('place_id','=',$placeId)->get();
	}


}