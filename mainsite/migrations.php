<?php

define('MYBB_ROOT', './forums/');
define('IN_MYBB', 1);

require MYBB_ROOT . 'global.php';
require './mainsite/inc/functions.php';
require './mainsite/models/Model.php';
require './mainsite/models/Event.php';

/**/

$brand = new Brand();
$brand->Set('title', 'Zelda');
$brand->Save();

$brand = new Brand();
$brand->Set('title', 'Metroid');
$brand->Save();

$brand = new Brand();
$brand->Set('title', 'Megaman');
$brand->Save();

/**/

$m = file_get_contents('./mainsite/migrations.php');
$m = explode("", $m);
$m[1] = "\n\n\n\n";
$m = implode($m);

file_put_contents('./mainsite/migrations.php', $m);

?>