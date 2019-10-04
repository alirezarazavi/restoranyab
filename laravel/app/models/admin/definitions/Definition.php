<?php
class Definition extends Eloquent {

	public static function setDefinition ($definition)
	{
		if ($definition) {
			DB::table('definitions')->insert(array(

				'title'				=>	$definition,
				'sort'				=>	'default',
				'topcategory_id'	=>	'1',
				'show_filter'		=>	'n',
			
			));
		}
	}

	public static function getDefinition ()
	{
		return DB::table('definitions')->orderBy('id','desc')->get();
	}

}