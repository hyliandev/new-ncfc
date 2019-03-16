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