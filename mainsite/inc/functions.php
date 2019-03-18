<?php

function assocToQueryString($str){
	global $db;
	
	if(is_numeric($str)){
		$str = $str;
	}elseif(is_string($str)){
		$str = "'" . $db->escape_string($str) . "'";
	}else{
		$str = false;
	}
	
	return $str;
}

function debug(){
	ob_start();
	
	foreach(func_get_args() as $arg){
		echo '<pre>' . print_r($arg, true) . '</pre>';
	}
	
	return ob_get_clean();
}

function slug($title){
	// Only lowercase letters
	$title = strtolower($title);
	// Anything not alphanumerical to a dash
	$title = preg_replace('/[^a-z0-9]/', '-', $title);
	// More than two dashes should just be one dash
	$title = preg_replace('/[-]{2,}/', '-', $title);
	// If the first or last character is a dash
	$title = preg_replace('/([-]$|^[-])/', '', $title);
	
	// We're done
	return $title;
}

function urlForum(){
	if($_SERVER['HTTP_HOST'] == 'nintendocfc.com'){
		return 'http://forum.nintendocfc.com';
	}
	
	return 'http://php56.example.com/ncfc/forums';
}

function urlMainsite(){
	if($_SERVER['HTTP_HOST'] == 'nintendocfc.com'){
		return 'http://nintendocfc.com';
	}
	
	return 'http://php56.example.com/ncfc/mainsite';
}

?>