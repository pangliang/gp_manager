<?php

class Manager{

	private $CMDS = array(
		"add" => array(
			"title"=>"add",
			"subtitle"=>"add {dir}/{title} : add post {title} to dir {dir}",
			),
		"edit" => array(
			"title"=>"edit",
			"subtitle"=>"edit post filename match *{query}*",
			),
		"templet" => array(
			"title"=>"templet",
			"subtitle"=>"edit templet which filename match *{query}*",
			),
		);
	private $config;

	function __construct($config)
	{
		$this->config = $config;
	}

	function __call($method,$args)
	{
		return $this->$method($args[0]);
	}

	private function showUsege($action = '')
	{
		$result = array();
		if(!empty($action) && isset($this->CMDS[$action]))
		{
			$conf = $this->CMDS[$action];
			$result[]=array( 'use helper', '', $conf['title'], $conf['subtitle'], null, 'yes', $action." ");
		}else{
			foreach ($this->CMDS as $action => $conf) {
				$result[]=array( 'use helper', '', $conf['title'], $conf['subtitle'], null, 'yes', $action." ");
			}
		}
		return $result;
	}

	private function add($args)
	{
		$result = array();
		$today = date("Y-m-d");
		$dir = dirname($args[0]);
		$title = str_replace($dir."/", "", $args[0]) ;
		$filename = "$today"."-"."$title".".md";
		$filapath = $this->config['home']."/".$this->config['post_dir']."/$dir/$filename";
		$result[]=array( 'add', "add $filapath", "add post : $dir/$filename");
		return $result;
	}

	private function edit($args)
	{
		$result = array();
		$dir = $this->config['home']."/".$this->config['post_dir'];
		$file_list = $this->listFiles($dir);
		foreach ($file_list as $value) {
			$filename = $value[1];
			$match = $args[0];
			if(preg_match("/$match/i", $filename))
			{
				$result[]=array( 'edit', 'open '.$value[0], 'edit '.$value[1]);
			}
		}
		if(count($result) ==0)
		{
			$result[]=array( 'use helper', '', "can't find file which name like *".$args[0]."*", "type different search words ...", null, 'yes', "");
		}
		return $result;
	}

	private function templet($args)
	{
		$result = array();
		$dir = exec('pwd')."/templets";
		$file_list = $this->listFiles($dir);
		foreach ($file_list as $value) {
			$filename = $value[1];
			$match = $args[0];
			if(preg_match("/$match/i", $filename))
			{
				$result[]=array( 'edit', 'open '.$value[0], 'edit '.$value[1]);
			}
		}
		if(count($result) ==0)
		{
			$result[]=array( 'use helper', '', "can't find file which name like *".$args[0]."*", "type different search words ...", null, 'yes', "");
		}
		return $result;
	}

	private function config($args)
	{
		$result = array();
		$dir = exec('pwd');
		$result[]=array( 'edit', 'open '.$dir."/config.php", 'edit config file');
		return $result;
	}

	private function paste2image($args)
	{
		$result = array();
		$filepath = $this->config['post_images_dir']."/".date("Ymd")."/".date("YmdHis").".png";
		$result[]=array( 'paste2image', 'paste2image '.$filepath, "save to $filepath from clipboard");
		return $result;
	}

	private function listFiles($dir)
	{
		$result = array();
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	if ( $file == ".." || $file == ".")
		        		continue;
		        	$filepath = $dir."/"."$file";
		        	if( is_dir($filepath) )
		        	{
		        		$result=array_merge($result, $this->listFiles($filepath));
		        	}
		        	else{
		            	$result[]=array( $filepath, $file);
		        	}
		        }
		        closedir($dh);
		    }
		}
		return $result;
	}

	private function listDirs($dir)
	{
		$result = array();
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	if ( $file == ".." || $file == ".")
		        		continue;
		        	$filepath = $dir."/"."$file";
		        	if( is_dir($filepath) )
		        	{
		        		$result[]=array( $filepath, $file);
		        	}
		        }
		        closedir($dh);
		    }
		}
		return $result;
	}
}