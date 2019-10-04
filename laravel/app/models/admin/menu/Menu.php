<?php
class Menu extends Eloquent {

	// Table Name
	protected $table = 'Menu';
	
	// Fillable
	protected $fillable = array('title', 'link', 'position');

	// Timestamp
	public $timestamps = false;

}