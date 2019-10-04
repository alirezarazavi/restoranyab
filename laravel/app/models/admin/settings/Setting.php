<?php
class Setting extends Eloquent {

	protected $fillable = array('name', 'value');
	public $timestamps 	= false;
	
}