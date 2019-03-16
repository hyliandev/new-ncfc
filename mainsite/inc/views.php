<?php

function view($file, $vars = []){
	global $_SETTINGS;
	
	if(!file_exists($file = './views/' . $file . '.php')){
		return false;
	}
	
	extract($vars);
	
	ob_start();
	
	include $file;
	
	return ob_get_clean();
}

?>