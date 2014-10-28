<?php
date_default_timezone_set('PRC');

require_once('config.php');
require_once('manager.php');
require_once('workflows.php');
$w = new Workflows();

$m = new Manager($config);

$query = trim($argv[1]);

if(empty($query))
{
	$datas = $m->showUsege();
}else{
	$p = explode(" ", $query);
	$action = array_shift($p);
	$datas = $m->$action($p);
}



foreach ($datas as $value) {
	$w->result( $value[0], $value[1], $value[2], $value[3], $value[4], $value[5], $value[6]);
}
echo $w->toxml();