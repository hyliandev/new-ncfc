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

?>