<?php
require_once('config.php');
date_default_timezone_set("UTC");

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
			echo $p[0];
		}else{
			echo implode($pipe, "\n" ) ;
		}
	}elseif($action == "qiniulogin")
	{
		$tool = exec("pwd")."/qboxrsctl";
		exec("$tool login ".$p[0]." ".$p[1]." 2>&1",$pipe,$ret);
		if($ret == 0){
			echo "qiniu login succ";
		}else{
			echo implode($pipe, "\n" ) ;
			exit(1);
		}
	}elseif($action == "paste2qiniu")
	{
		$filepath = sys_get_temp_dir()."/".date("YmdHis").".png";
		$tool = exec("pwd")."/pngpaste";
		$pipe = null;
		exec("$tool $filepath 2>&1",$pipe,$ret);
		if($ret == 0){
		}else{
			echo implode($pipe, "\n" ) ;
			exit(1);
		}

		$tool = exec("pwd")."/qboxrsctl";
		$filename = date("Ym")."/".date("YmdHis").".png";
		exec("$tool put ".$config["qiniu_bucket"]." ".$filename." $filepath 2>&1",$pipe,$ret);
		if($ret == 0){
			echo $config["qiniu_url"]."/".$filename;
		}else{
			echo implode($pipe, "\n" ) ;
			exit(1);
		}
	}
}

