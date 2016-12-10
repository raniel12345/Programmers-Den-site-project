<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

// function for displaying tinymce
if( ! function_exists('display_tinymce')){

	function display_tinymce($textarea_name = ''){
		if($textarea_name != ''){
			return "<textarea class='myTextarea' name='".$textarea_name."'></textarea>";
		}else{
			return "<h1>(tinymce) - No textarea name provided!</h1>";
		}
	}
}

// function for getting current semester
if( ! function_exists('get_current_semester') ){

	function get_current_semester(){
		$current_semester_year = date('Y') ."-". date('Y', strtotime('+1 year'));
		//echo date('m', strtotime('-1 month'));
		$current_month = date('m');

		$current_semester = "";
		if($current_month >= 8){
			$current_semester = "First Semester: ".$current_semester_year;
		}else if($current_month <= 5){
			$current_semester = "Second Semester: ".$current_semester_year;
		}else{
			$current_semester = "Summer Class". $current_semester_year;
		}

		return $current_semester;
	}
}

?>