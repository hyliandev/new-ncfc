<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Nintendo Community Fangame Convention
 * Mainsite Software
 * Developed by HylianDev
 * Public Domain for anything not included in MyBB
 */

// Our fatal error handler
// Outputs errors to a file here called "error_log"
// This could be somewhere else, but I shoved it here because:
// This function simply *must* work under any circumstances
// It can't depend on a file include or anything!
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

// Some basic requries
foreach([
	'./models/Model.php',
	'./models/Event.php',
	'./models/NewsPost.php',
	'./models/User.php',
	'./inc/functions.php',
	'./inc/routes.php',
	'./inc/mybb.php',
	'./inc/views.php',
] as $file){
	if(!file_exists($file)){
		Fatality('File not found: ' . $file);
	}
	
	require_once $file;
}

// Get MyBB
require_once MYBB_ROOT . 'global.php';

// Execute all of our code; this is a rabbit hole to the rest of the files
require_once 'getRoute.php';

// Parse the forum properly
eval("\$forums = \"" . $templates->get("forumdisplay") . "\";");

// Add our content to the forum's output
$forums = explode('<!--content-->', $forums);
$forums = implode('<!--content--><div id="container">' . $content . '</div>', [
	array_shift($forums),
	array_pop($forums)
]);

// Display the page properly
output_page($forums);

?>