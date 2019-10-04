<?php
class DefinitionValue extends Eloquent {

	protected $table = 'definition_values';
	
	public static function setValue($value,$definition_id)
	{
		if ($value) {
			DB::table('definition_values')->insert(array(
				'title'			=> $value,
				'sort'			=> 'defualt',
				'definition_id'	=>	$definition_id,
				'image'			=> null
			));
		}
	}

	public static function getValue($id)
	{
		return DB::table('definition_values')->where('definition_id','=',$id)->get();
	}

}