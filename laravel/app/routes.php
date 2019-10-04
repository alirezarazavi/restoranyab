<?php
/*
/ Unauthenticated group
*/
Route::group(array('before' => 'guest'), function() {
	/* 
	/ CSRF protection 
	*/
	Route::group(array('before_' => 'csrf'), function() {
		/*
		/ Sign In
		*/
		Route::get('signin', array(
			'as' => 'signin', 
			'uses' => 'AccountController@getSignin'
		));
		Route::post('signin', array(
			'as' => 'signin', 
			'uses' => 'AccountController@postSignin'
		));
		/*
		/ Sign Up 
		*/
		Route::get('signup', array(
			'as'=> 'signup', 
			'uses' => 'AccountController@getSignup'
		));
		Route::post('signup', array(
			'as'=> 'signup', 
			'uses' => 'AccountController@postSignup'
		));
	});
});

/*
/ Authenticated group
*/
Route::group(array('before' => 'auth'), function(){
	/*
	/ Sign Out
	*/
		Route::get('signout', array('as' => 'signout', 'uses' => 'AccountController@getSignout'));

	/*
	/ Admin group
	*/
	Route::group(array('before' => 'admin'), function() {

		/* Admin Dashboard */
			Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@index'));
			
		/* News */
			Route::resource('admin/news', 'NewsController');

		/* Pages */
			Route::resource('admin/pages', 'PageController');
			// Pages Content
			Route::resource('admin/pages/{pageId}/content', 'PageContentController');

		/* Places */
			Route::resource('admin/places', 'PlaceController');
			// Details
			Route::any('admin/places/{id}/details', array('as' => 'admin.places.details', 'uses' => 'PlaceController@details'));
			// Fields
			Route::any('admin/places/{id}/fields', array('as' => 'admin.places.fields', 'uses' => 'PlaceController@fields'));
			// Menu
			Route::any('admin/places/{id}/menu/{menuId}', array('as' => 'admin.places.menu.edit', 'uses' => 'PlaceController@menu'));
			Route::any('admin/places/{id}/menu', array('as' => 'admin.places.menu', 'uses' => 'PlaceController@menu'));
			// Pictures
			Route::any('admin/places/{id}/pictures', array('as' => 'admin.places.pictures', 'uses' => 'PlaceController@pictures'));

		/* Users */
			Route::get('admin/users', array('as' => 'admin.users.index', 'uses' => 'UserManagerController@index'));
			Route::get('admin/users_place_registration', array('as' => 'admin.users.place_registration', 'uses' => 'UserPlaceRegistrationController@index'));
		
		/* Definitions */
			/* Definitions Values */
			Route::resource('admin/definitions/values', 'ValuesController');
				// Values Icon
				Route::post('admin/definitions/values/{id}', 'ValuesController@icon');
			/* Definitions */
			Route::resource('admin/definitions', 'DefinitionsController');
				// Definition Status
				Route::get('admin/definitions/{id}/{status}', 'DefinitionsController@status');
			/* Categories */
			Route::resource('admin/categories', 'CategoriesController');
				// Categories Icon
				Route::post('admin/categories/icon/{id}', 'CategoriesController@icon');
			/* Fields */
			Route::resource('admin/fields', 'FieldsController');
				// Fields Icon
				Route::post('admin/fields/icon/{id}', 'FieldsController@icon');
		
		/* Settings */
			Route::get('admin/settings', array('as' => 'admin.settings.index', 'uses' => 'SettingsController@index'));
			Route::post('admin/settings', array('as' => 'admin.settings.store', 'uses' => 'SettingsController@store'));
			/* Menu */
			Route::resource('admin/menu', 'MenuController');
	});

});


// Home
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
// Restaurant List
Route::get('restaurant', array('as' => 'restaurant', 'uses' => 'HomeController@restaurant'));
Route::get('restaurant/map', array('as' => 'map', 'uses' => 'HomeController@restaurant'));
// Restaurant Profile
Route::get('restaurant/{url}', array('as' => 'profile', 'uses' => 'HomeController@profile'));
Route::get('restaurant/{url}/map', array('as' => 'profile.map', 'uses' => 'HomeController@profile'));
// Search
Route::get('search', array('as' => 'search', 'uses' => 'HomeController@search'));
// Filter
Route::get('filter', array('as' => 'filter', 'uses' => 'HomeController@filter'));
// News
Route::get('news', array('as' => 'news', 'uses' => 'HomeController@news'));
Route::get('news/{newsUrl}', array('as' => 'newsSingle', 'uses' => 'HomeController@newsSingle'));
// Contact
Route::any('contact', array('as' => 'contact', 'uses' => 'HomeController@contact'));
// Place Registration
Route::any('place_registration', array('as' => 'place_registration', 'uses' => 'HomeController@place_registration'));
// Pages
Route::get('/{pageUrl}', array('as' => 'page', 'uses' => 'HomeController@page'));


