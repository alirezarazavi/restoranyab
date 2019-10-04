<?php
class Functions {

	public static function excerpt($text, $numb = 650) {
	    if (mb_strlen($text) > $numb) {
	        $text = strip_tags($text);       
	  		$text = substr($text, 0, $numb);
	        $text = mb_substr($text, 0, mb_strrpos($text, " "));
	        $etc = " ...";
	        $text = $text . $etc;
	    }
	    return $text;
	} 

}