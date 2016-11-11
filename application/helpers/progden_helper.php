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
/*
if( ! function_exists('output_as_json') ){

	function output_as_json($array_to_display){
		$this->output->set_content_type('application/json')->set_output(json_encode($array_to_display));
	}
}*/
?>