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
	}elseif($action == "paste2image")
	{
		$filepath = $config["home"]."/".$p[0];
		exec('mkdir "'.dirname($filepath).'"');
		$tool = exec("pwd")."/pngpaste";
		$pipe = null;
		exec("$tool $filepath 2>&1",$pipe,$ret);
		if($ret == 0){
			echo $filepath;
		}else{
			echo implode($pipe, "\n" ) ;
		}
	}
}

