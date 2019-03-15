<?php

$routes = [
	'index' => function(){
		die(debug(Event::Current()));
		
		$post = new NewsPost(1);
		$author = $post->Author();
		
		return '<h1>' . $post->Get('subject') . '</h1><h2>By ' . $author->Get('username') . '</h2>' . $post->Get('message');
	},
	
	'404' => function(){
		return '<h1>Page Not Found</h1><p>The page you requested could not be found</p>';
	},
];

?>