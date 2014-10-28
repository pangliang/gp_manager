<?php
require_once('config.php');

$query = trim($argv[1]);

if(!empty($query))
{
	$p = explode(" ", $query);
	$action = array_shift($p);
	if($action == "open")
	{
		exec('open "'.$p[0].'"');
	}elseif($action == "add")
	{
		$pwd = exec("pwd");
		$template = $pwd."/templets/default.md";
		exec('mkdir "'.dirname($p[0]).'"');
		exec('cp "'.$template.'" "'.$p[0].'"');
		exec('open "'.$p[0].'"');
	}
}

