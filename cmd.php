<?php
date_default_timezone_set('PRC');

$SETTINGS_FILE = "settings.plist";
$home = "/Volumes/f/liang8305.github.com";

require_once('manager.php');
$m = new Manager($home);

$query = trim($argv[1]);

if(empty($query))
{
	$datas = $m->showUsege();
}else{
	$p = explode(" ", $query);
	$action = array_shift($p);
	$datas = $m->$action($p);
}

require_once('workflows.php');
$w = new Workflows();

foreach ($datas as $value) {
	$w->result( $value[0], $value[1], $value[2], $value[3], $value[4], $value[5], $value[6]);
}
echo $w->toxml();