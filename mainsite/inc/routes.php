<?php

$routes = [
	'index' => function(){
		return 'Hello, World!';
	},
	
	'404' => function(){
		return '<h1>Page Not Found</h1><p>The page you requested could not be found</p>';
	},
];

?>