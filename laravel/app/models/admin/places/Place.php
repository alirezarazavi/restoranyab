<?php

class Place extends Eloquent {
	
	protected $fillable = array('logo','cover', 'publish');
	/* STORE TO DB */
	/* Place */
	public static function setPlace($place) 
	{
		$date 		= new \DateTime;
		$lastInsert = DB::table('places')->insertGetId(
			array(
				'title'			=> 	$place['name'],
				'url'			=> 	$place['url'],
				'address' 		=> 	$place['address'],
				'tel'			=>	$place['phone'],
				'fax'			=>	$place['fax'],
				'mobile'		=>	$place['mobile'],
				'site'			=>	$place['site'],
				'lat'			=>	$place['lat'],
				'long'			=>	$place['long'],
				'created_by'	=>	Auth::user()->username,
				'created_at'	=> 	$date
			)
		);

		if ($place['category']) {
			// INSERT into place - categories
			foreach ($place['category'] as $cat) {
				DB::table('places')	->where('id','=',$lastInsert)
									->update(array('categories' => DB::raw('CONCAT_WS(",",categories,'.$cat.')')));								
			}
			// INSERT into place_categories
			foreach ($place['category'] as $cat) {
				DB::table('place_categories')->insert(array('place_id' => $lastInsert, 'category_id' => $cat));
			}
		}

		// Insert url
		DB::table('url')->insert(array('place_id' => $lastInsert, 'url' => $place['url']));

		
	}

	public static function getPlaces()
	{
		return $places = DB::table('places')->orderBy('id','desc')->paginate(10);
		
	}

	public static function updatePlace($id,$place)
	{
		$date 		= new \DateTime;
		DB::table('places')
			->where('id','=',$id)
			->update(
				array(
					'title'			=> 	$place['name'],
					// 'url'			=> 	$place['url'], 
					'address' 		=> 	$place['address'],
					'tel'			=>	$place['phone'],
					'fax'			=>	$place['fax'],
					'mobile'		=>	$place['mobile'],
					'site'			=>	$place['site'],
					'lat'			=>	$place['lat'],
					'long'			=>	$place['long'],
					'updated_at'	=> 	$date
				)
			);

		// INSERT into placecategories
		// delete previous categories
		DB::table('places')->where('id','=',$id)->update(array('categories'=>''));
		DB::table('place_categories')->where('place_id','=',$id)->delete();
		if ($place['category']) {
			// update categories
			foreach ($place['category'] as $cat) {
				DB::table('places')	->where('id','=',$id)
									->update(array('categories' => DB::raw('CONCAT_WS(",",categories,'.$cat.')')));
			}
			// INSERT into place_categories
			foreach ($place['category'] as $cat) {
				DB::table('place_categories')->insert(array('place_id' => $id, 'category_id' => $cat));
			}
		}
		
		
		$thisPlace = DB::table('places')->where('id','=',$id)->first();
		if ($place['url'] !== $thisPlace->url) {
			DB::table('url')->insert(array('place_id' => $id, 'url' => $place['url']));
			DB::table('places')->where('id','=',$id)->update(array('url' => $place['url']));
		}
		// Insert url
		// $multipleUrl = DB::table('places')->where('url','=',$place['url'])->first();
		// if ($multipleUrl->id == $id) {
		// 	$thisPlace = DB::table('places')->where('id','=',$id)->first();
		// 	if ($place['url'] !== $thisPlace->url) {
		// 		DB::table('url')->insert(array('place_id' => $id, 'url' => $place['url']));
		// 		DB::table('places')->where('id','=',$id)->update(array('url' => $place['url']));
		// 	}
		// } else {
		// 	return false;
		// }

	}
	
	/* Place Definitions */
	public static function getPlaceDefinition($id)
	{
		return DB::table('place_definitions')->where('place_id','=',$id)->get();
	}

	public static function setPlaceDefinition($values,$placeId) 
	{
		if($values > 0) {
			DB::table('place_definitions')->where('place_id','=',$placeId)->delete();
			foreach ($values as $value) {
				DB::table('place_definitions')->insert(array(
					'place_id'		=>		$placeId,
					'value_id'		=>		$value
				));
			}
		}
	}

	/* Place Fields */
	public static function setPlaceFields($placeId, $fieldId, $fieldDesc)
	{
		// delete previous fields
		DB::table('place_fields')->where('place_id','=',$placeId)->delete();
		// store to place_fields
		for($i=0; $i < count($fieldDesc); $i++) :
			if($fieldDesc[$i] !== '') {
				$lastInsert = DB::table('place_fields')->insertGetId(array(
					'description'	=>	$fieldDesc[$i],
					'field_id'		=>	$fieldId[$i],
					'place_id'		=>	$placeId
				));
			}
		endfor;

	}
		
	public static function getPlaceFields($placeId)
	{
		return DB::table('place_fields')->where('place_id','=',$placeId)->get();
	}


	/* Place Menu */
	// Menu Category
	public static function setPlaceMenuCategory($menuCategory,$placeId)
	{
		DB::table('place_menu_categories')->insert(array('title'=>$menuCategory,'place_id'=>$placeId));
	}

	public static function getPlaceMenuCategory($placeId)
	{
		return DB::table('place_menu_categories')->where('place_id','=',$placeId)->get();
	}

	public static function updateMenuCategory($menuId,$menuTitle)
	{
		DB::table('place_menu_categories')->where('id','=',$menuId)->update(array('title' => $menuTitle));
	}

	public static function deleteMenuCategory($categoryId)
	{
		// delete menu categories
		DB::table('place_menu_categories')->where('id','=',$categoryId)->delete();
		// delete menu items of this category
		DB::table('place_menu_items')->where('menu_cat_id','=',$categoryId)->delete();
	}

	// Menu Item
	public static function setPlaceMenuItem($menuItems)
	{
		DB::table('place_menu_items')->insert(
			array(
				'title'			=>		$menuItems['itemTitle'],
				'price'			=>		$menuItems['itemPrice'],
				'description'	=>		$menuItems['itemDesc'],
				'menu_cat_id'	=>		$menuItems['itemCategory']
			)
		);
	}

	public static function getPlaceMenuItem()
	{
		return DB::table('place_menu_items')->get();
	}

	public static function updateMenuItem($itemId,$menuItems)
	{
		DB::table('place_menu_items')->where('id','=',$itemId)->update(
			array(
				'title'			=>		$menuItems['itemTitle'],
				'price'			=>		$menuItems['itemPrice'],
				'description'	=>		$menuItems['itemDesc'],
				'menu_cat_id'	=>		$menuItems['itemCategory']
			));
	}

	public static function deleteMenuItem($itemId)
	{
		DB::table('place_menu_items')->where('id','=',$itemId)->delete();
	}

	/*
	* Place Pictures
	* 
	*/
	public static function setPlacePicture($title, $picture, $placeId)
	{
		DB::table('place_pictures')->insert(
			array(
				'title'		=>	$title,
				'picture'	=>	$picture,
				'place_id'	=>	$placeId
			)
		);
	}

	public static function getPlacePicture($placeId)
	{
		return DB::table('place_pictures')->where('place_id','=',$placeId)->get();
	}

	// public static function getPlacePictureAll()
	// {
	// 	return DB::table('place_pictures')->get();
	// }

	public static function deletePicture($pictureId)
	{
		foreach($pictureId as $pid):
			// Delete file
			$pictures = DB::table('place_pictures')->where('id','=',$pid)->get();
			foreach($pictures as $picture):
				unlink(public_path().'/uploads/places/'.$picture->picture);
			endforeach;
			// Remove from DB
			DB::table('place_pictures')->where('id','=',$pid)->delete();
		endforeach;
	}

	public static function setLogoPicture($logo, $placeId) 
	{
		Place::where('id','=',$placeId)->update(array(
			'logo' => $logo[0]
		));
	}

	public static function setCoverPicture($cover, $placeId)
	{
		Place::where('id','=',$placeId)->update(array(
			'cover' => $cover[0]
		));
	}



}