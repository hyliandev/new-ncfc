<?php

$routes = [
	'index' => function(){
		return view('news/archive', [
			'posts' => NewsPost::FetchQuery('mybb_posts', 'pid', [ 'fid' => 2, ], 2),
		]);
	},
	
	'404' => function(){
		return '<h1>Page Not Found</h1><p>The page you requested could not be found</p>';
	},
];

?>