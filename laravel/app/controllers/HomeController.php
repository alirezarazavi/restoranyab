<?php

class HomeController extends BaseController {

	public function __construct()
	{
		/* Footer Stat */
		$placeStat 	= DB::table('places')
						->orderBy('id','desc')
						->where('publish','=','y')
						->take(5)
						->get();
		$visit 		= DB::table('stat_visit')
						->orderBy('visit','desc')
						->take(5)
						->get();
		$popular 	= DB::table('stat_fav')
						->select('place_id', DB::raw('count(*) as total'))
						->groupBy('place_id')
						->orderBy('place_id','desc')
						->take(5)
						->get();
		$menuMaker 	= DB::table('menu')
						->orderBy('sort','asc')
						->get();
		$pages 		= DB::table('pages')
						->get();
		View::share(array(
			'placeStat' 	=> 	$placeStat, 
			'visit' 		=> 	$visit,
			'popular'		=>	$popular,
			'menuMaker'		=>	$menuMaker,
			'pages'			=>	$pages
		));
	}
	/*
	/ Home page
	*/
	public function index() 
	{

		if (Request::ajax() == 'catId') {
			$catId = Input::get('catId');
			$mapPlaces = DB::table('places')->where('categories','LIKE','%'.$catId.'%')->get();

		}

		// Count Sub Categories
		$placeCategories = DB::table('place_categories')
								->select('category_id', DB::raw('count(*) as total'))
								->groupBy('category_id')
								->get();
		$categories = DB::table('categories')->get();
		$totalSubCats = array();
		foreach ($categories as $cat) {
			foreach ($placeCategories as $pCat) {
				if ($cat->id == $pCat->category_id) {
					$totalSubCats[] = array('id' => $cat->id, 'total' => $pCat->total);
				}
			}
		}
		// Count Parent Categories
		$categories = DB::table('categories')->where('parent','=',0)->get();
		$totalParentCats = array();
		foreach ($categories as $cat) {
			$parent = DB::table('categories')->where('parent','=',$cat->id)->get();
			// foreach ($parent as $p) {
			// 	$place = DB::table('place_categories')->where('category_id','=',$cat->id)->get();
			// }
			$totalParentCats[] = array('id' => $cat->id, 'total' => count($parent));
		}

		// Home Intro
		$setting = Setting::where('name','=','home_intro')->first();
		if (is_numeric($setting->value)) {
			// Pages
			$introContent 	= PageContent::where('page_id','=',$setting->value)->first();
			$introLink 		= Page::where('id','=',$setting->value)->pluck('link');
		} else {
			// News
			$introContent 	= News::orderBy('id','desc')->first();
			$introLink 		= $introContent->link;
		}

		$title 			= "نخست";
		$categories 	= Category::all();
		$parentCategory = Category::all();
		$mapPlaces 		= Place::all();
		return View::make('index')
					->with('title',$title)
					->with('categories', $categories)
					->with('parentCategory', $parentCategory)
					->with('mapPlaces', $mapPlaces)
					->with('totalSubCats', $totalSubCats)
					->with('totalParentCats', $totalParentCats)
					->with('introLink',$introLink)
					->with('introContent',$introContent);
		
	}
	/*
	/ List page
	*/
	public function restaurant() 
	{
		$title 			=	"لیست رستوران‌ها";
		$mapPlaces 		= 	Place::all();
		$places 		=	Place::where('publish','=','y')->orderBy('id','desc')->paginate(10);
		$definitions 	=	Definition::all();
		$values 		=	DefinitionValue::all();
		$placeDefinition= 	DB::table('place_definitions')->get();
		$placePicAll 	= 	DB::table('place_pictures')->get();
		return 	View::make('list')
					->with('title', $title)
					->with('places', $places)
					->with('definitions', $definitions)
					->with('values', $values)
					->with('placeDefinition', $placeDefinition)
					->with('placePicAll', $placePicAll)
					->with('mapPlaces',$mapPlaces);
	}
	/*
	/ Single page
	*/
	public function profile($url)
	{
		$place 		= Place::where('url','=',$url)->first();
		$pictures 	= DB::table('place_pictures')->get();
		$fields		= Field::all();
		$placeFields= DB::table('place_fields')->get();
		$menuCats 	= DB::table('place_menu_categories')->get();
		$menuItems 	= DB::table('place_menu_items')->get();
		$title 		= $place->title;

		if (Request::ajax()) {
			// Rate
			if (Input::has('score')) {
				// check if user is sign in
				if (Auth::check()) {
					$type 	= Input::get('type');
					$score 	= Input::get('score');
					$userId = Auth::user()->id;
					$placeId= Session::get('pid');
					// check if exist
					$rate = DB::table('stat_rate')->where('place_id','=',$placeId)->where('user_id','=',$userId)->get();
					if ($rate) {
						// if exist, update
						DB::table('stat_rate')
										->where('place_id','=',$placeId)
										->where('user_id','=',$userId)
										->update(array(
											$type 	=> $score,
										));
					} else {
						// if dosn't exist, insert
						DB::table('stat_rate')->insert(array(
							'place_id'	=> 	$placeId,
							'user_id'	=>	$userId,
							$type	 	=>	$score,
						));
					}
				// return error if user is not sign in
				} else {
					return false;
				}
			}
			// Fav
			if (Input::has('fav')) {
				if (Auth::check()) {
					$uid 	= Auth::user()->id;
					$pid 	= Session::get('pid');
					$fav 	= DB::table('stat_fav')->where('user_id','=',$uid)->where('place_id','=',$pid)->get();
					if ($fav) {
						// Remove Fav
						DB::table('stat_fav')
							->where('place_id','=',$pid)
							->where('user_id','=',$uid)
							->delete();
					} else {
						// Add Fav
						DB::table('stat_fav')->insert(array(
							'place_id'	=>	$pid,
							'user_id'	=> 	$uid
						));
					}
				}
			}
		}
		$avg = DB::table('stat_rate')
							->select('place_id', DB::raw('AVG (food) as foodAvg, AVG (service) as serviceAvg, AVG (space) as spaceAvg, AVG (location) as locationAvg'))
							->where('place_id','=',$place->id)
							->groupBy('place_id')
							->first();
		$totalAvg = DB::table('stat_rate')
							->select('place_id', DB::raw('SUM(food) + SUM(service) + SUM(space) + SUM(location) as sum'))
							->where('place_id','=',$place->id)
							->groupBy('place_id')
							->first();

		// Add to fav
		$statFav 	= null;
		if (Auth::check()) {
			$statFav 	= DB::table('stat_fav')->where('place_id','=',$place->id)->where('user_id','=',Auth::user()->id)->get();
		}
		// Visit counter
		$visit = DB::table('stat_visit')->where('place_id','=',$place->id)->increment('visit');
		if (!$visit) {
			DB::table('stat_visit')->insert(array('place_id' => $place->id, 'visit' => 1));
		}
		// Single 
		if ($place->publish == 'y') {
			Session::put('pid', $place->id);
			return View::make('single')
						->with('title',$title)
						->with('place',$place)
						->with('pictures',$pictures)
						->with('fields',$fields)
						->with('placeFields',$placeFields)
						->with('menuCats',$menuCats)
						->with('menuItems',$menuItems)
						->with('statFav',$statFav)
						->with('avg',$avg)
						->with('totalAvg',$totalAvg);
		} else {
			return Redirect::route('restaurant');
		}
	}
	/*
	/ Home page search
	*/
	public function search()
	{
		$keyword 		= Input::get('keyword');
		if(!$keyword) {
			return Redirect::back();
		}
	    $searchTerms 	= explode(' ', $keyword);
	    // Places Results
	    $query 			= DB::table('places');
	    foreach($searchTerms as $term)
	    {
	        $query->where('title', 'LIKE', '%'. $term .'%');
	    }
	    $placeResults 	= $query->get();
	    // Categories Results
	    $query 			= DB::table('categories');
	    foreach($searchTerms as $term)
	    {
	        $query->where('title', 'LIKE', '%'. $term .'%');
	    }
	    $categories 	= $query->get();
	    $categoriesResults = array();
	    foreach($categories as $category) 
	    {
	    	$cats = DB::table('place_categories')->where('category_id','=',$category->id)->get();
	    	foreach($cats as $cat) 
	    	{
	    		$categoriesResults[] = DB::table('places')->where('id','=',$cat->place_id)->get();
	    	}
	   	}
	   	$definitions 	=	Definition::all();
		$values 		=	DefinitionValue::all();
		$placeDefinition= 	DB::table('place_definitions')->get();
	   	$placePicAll 	= DB::table('place_pictures')->get();
		$title 			= 'جستجو';
		return View::make('search')
					->with('title',$title)
					->with('values',$values)
					->with('placeDefinition',$placeDefinition)
					->with('definitions',$definitions)
					->with('placePicAll',$placePicAll)
					->with('keyword',$keyword)
					->with('placeResults',$placeResults)
					->with('categoriesResults',$categoriesResults);
	}
	/*
	/ Sidebar quick search
	*/
	public function filter()
	{
		$filterOptions = Input::get('filter_options');
		if($filterOptions)
		{
			$filterResults = array();
			foreach ($filterOptions as $option) 
			{
				$definitions = DB::table('place_definitions')->where('value_id','=',$option)->get();
				foreach ($definitions as $definition)
				{
					$filterResults[] = DB::table('places')->where('id','=',$definition->place_id)->get();
				}
			}
			$definitions 	=	Definition::all();
			$values 		=	DefinitionValue::all();
			$placeDefinition= 	DB::table('place_definitions')->get();
		   	$placePicAll 	= DB::table('place_pictures')->get();
			$title 			= 'جستجو';
			return View::make('filter')
						->with('title',$title)
						->with('values',$values)
						->with('placeDefinition',$placeDefinition)
						->with('definitions',$definitions)
						->with('placePicAll',$placePicAll)
						->with('filterResults',$filterResults)
						->with(Input::old());
		} 
		else 
		{
			return Redirect::back();
		}
	}
	/*
	/ Pages
	*/
	public function page($pageUrl) 
	{
		$page 	= DB::table('pages')->where('link','=',$pageUrl)->first();
		$content= DB::table('page_contents')->where('page_id','=',$page->id)->first();
		$title = $content->title;

		$definitions 	=	Definition::all();
		$values 		=	DefinitionValue::all();
		return View::make('page')
					->with('content',$content)
					->with('title',$title)
					->with('definitions',$definitions)
					->with('values',$values);
	}
	/*
	/ News
	*/
	public function news()
	{
		$title 			= 	'اخبار';
		$news 			= 	News::orderBy('id','desc')->get();
		$definitions 	= 	Definition::all();
		$values 		= 	DefinitionValue::all();
		return View::make('news')
				->with('title',$title)
				->with('news',$news)
				->with('definitions',$definitions)
				->with('values',$values);
	}
	/*
	/ News Single
	*/
	public function newsSingle($newsUrl) 
	{
		$news = News::where('link','=',$newsUrl)->first();
		$title = 'اخبار | ' . $news->title;
		$definitions 	= 	Definition::all();
		$values 		= 	DefinitionValue::all();
		return View::make('news_single')
					->with('title',$title)
					->with('news',$news)
					->with('definitions',$definitions)
					->with('values',$values);
	}
	/*
	/ Contact
	*/
	public function contact()
	{
		if (Input::get('contact')) {
			$validator = Validator::make(Input::all(), array('subject' => 'required', 'email' => 'required', 'text' => 'required'));
			if ($validator->passes()) {
				$data = Input::all();
			    Mail::send('emails.contact',$data, function($message)
			    {
			        $message->to('sar.razavi@gmail.com')->subject('رستوران‌یاب | ارتباط - '. Input::get('subject'));
			    });
		    	return Redirect::back()->with('alert-success', 'پیغام با موفقیت ارسال شد');
		    }
		    else 
		    {
		    	return Redirect::back()->with('alert-error', 'خطا! پر کردن تمام فیلدها الزامی است.');
		    }
		}
		$title 			=	'ارتباط';
		$definitions 	=	Definition::all();
		$values 		=	DefinitionValue::all();
		return View::make('contact')
				->with('title',$title)
				->with('definitions',$definitions)
				->with('values',$values);
	}
	/*
	/ Place Registration
	*/
	public function place_registration()
	{
		if (Input::get('place_registration')) {
			$rules = array(
				'placeName'		=>	'required',
				'placeType'		=>	'required',
				'placePhone'	=>	'required',
				'placeAddress'	=>	'required',
				'managerName'	=>	'required',
				'managerPhone'	=>	'required'
			);
			$messages = array(
				'placeName.required'	=>	'نام رستوران الزامی است.',
				'placeType.required'	=>	'نوع رستوران الزامی است.',
				'placePhone.required'	=>	'تلفن رستوران الزامی است.',
				'placeAddress.required'	=>	'آدرس رستوران الزامی است.',
				'managerName.required'	=>	'نام مدیر الزامی است.',
				'managerPhone.required'	=>	'تلفن مدیر الزامی است.'
			);
			$validator = Validator::make(Input::all(), $rules, $messages);
			if ($validator->passes()) {
				DB::table('user_place_registration')
						->insert(array(
							'placeName'		=>	Input::get('placeName'),
							'placeType'		=>	Input::get('placeType'),
							'placePhone'	=>	Input::get('placePhone'),
							'placeAddress'	=>	Input::get('placeAddress'),
							'managerName'	=>	Input::get('managerName'),
							'managerPhone'	=>	Input::get('managerPhone'),
							'email'			=>	Input::get('email'),
							'description'	=>	Input::get('description'),

						));
				return Redirect::back()->with('alert-success','اطلاعات رستوران ثبت شد.<br /> بعد از بررسی‌ با شما تماس خواهیم گرفت.');
			} else {
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}
		$title 			=	'ثبت رستوران';
		$definitions 	=	Definition::all();
		$values 		=	DefinitionValue::all();
		return View::make('place_registration')
				->with('title',$title)
				->with('definitions',$definitions)
				->with('values',$values);

	}
	

}