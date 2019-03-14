<?php

function Fatality($e){
	http_response_code(500);
	
	$file = 'error_log';
	$content = '';
	
	if(file_exists($file)){
		$content = file_get_contents($file);
	}
	
	file_put_contents($file, $content . '[ ' . date('Y-m-d g:i:sa') . ' ]' . "\n" . $e . "\n\n");
	?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Server Error &dash; NCFC</title>
</head>
<body>
<h1>Server Error</h1>
<p>There's an error! Please come back later.</p>
</body>
</html>
<?php
	die();
}

// Requires
foreach([
	'./inc/mybb.php',
	'./inc/routes.php',
	'./inc/models.php',
] as $file){
	if(!file_exists($file)){
		Fatality('File not found: ' . $file);
	}
	
	require_once $file;
}

// Get MyBB
require_once MYBB_ROOT . 'global.php';

$plugins->run_hooks('forumdisplay_start');
$plugins->run_hooks('forumdisplay_end');

eval("\$forums = \"" . $templates->get("forumdisplay") . "\";");

$forums = explode('<!--content-->', $forums);
$forums = implode('<!--content-->' . $content, [
	array_shift($forums),
	array_pop($forums)
]);

output_page($forums);

?>