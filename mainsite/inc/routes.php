<?php

$routes = [
	'index' => function(){
		//$model = new Model('mybb_posts', 'pid', 1);
		
		$result = NewsPost::FetchQuery('pid');
		
		die('<pre>' . print_r($result, true) . '</pre>');
		
		return 'Hello, World!';
	},
	
	'404' => function(){
		return '<h1>Page Not Found</h1><p>The page you requested could not be found</p>';
	},
];

?>