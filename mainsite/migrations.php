<?php

define('MYBB_ROOT', './forums/');
define('IN_MYBB', 1);

require MYBB_ROOT . 'global.php';
require './mainsite/inc/functions.php';
require './mainsite/models/Model.php';
require './mainsite/models/Event.php';

/**/

$event = new Event();
$event->Set('begin_date', strtotime('2018-11-1'));
$event->Set('end_date', strtotime('2019-11-9'));
$event->Set('title', 'Fake 2018 NCFC');
$event->Save();

/**/

$m = file_get_contents('./mainsite/migrations.php');
$m = explode("", $m);
$m[1] = "\n\n\n\n";
$m = implode($m);

file_put_contents('./mainsite/migrations.php', $m);

?>