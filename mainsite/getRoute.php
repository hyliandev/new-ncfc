<?php

$route = 'index';

if(!empty($_GET['route'])){
	$route = $_GET['route'];
}

// This requires that the 404 route exists
// Make sure it never gets erased lol
if(empty($routes[$route])){
	$route = '404';
}

try {
	$content = $routes[$route]();
}
catch(Exception $e){
	Fatality($e);
}

?>