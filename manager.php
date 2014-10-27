<?php

class Manager{
	private $CMDS = array(
		"add" => array(
			"add {title} : add post {title}",
			"add {dir} {title} : add post {title} to dir {dir}",
			),
		"edit" => array(
			"edit ... : edit post filename match *{search}*",
			),
		"templet" => array(
			"templet {templet_name} : edit templet {templet_name}"
			),
		);
	private $home;

	function __construct($home)
	{
		$this->home = $home;
	}

	function __call($method,$args)
	{
		if(!isset($this->CMDS[$method]))
		{
			return $this->showUsege();
		}elseif(count($args) == 0 || count($args[0]) == 0)
		{
			return $this->showUsege($method);
		}else{
			$datas = $this->$method($args[0]);
			if(count($datas) == 0)
			{
				$datas = $this->showUsege($method);
			}
			return $datas;
		}
	}

	private function showUsege($action = '')
	{
		$result = array();
		if(!empty($action) && isset($this->CMDS[$action]))
		{
			foreach ($this->CMDS[$action] as $value) {
				$result[]=array( 'use helper', '', $value);
			}
		}else{
			foreach ($this->CMDS as $action => $list) {
				foreach ($list as $value) {
					$result[]=array( 'use helper', '', $value,  '', null, 'yes', $action);
				}
			}
		}
		return $result;
	}

	private function add($args)
	{
		$result = array();
		$today = date("Y-m-d");
		if(!empty($args[1]))
		{
			$dir = $args[0];
			$title = $args[1];
			$filename = "$today"."-"."$title".".md";
			$filapath = $this->home."/_posts/$dir/$filename";
			$result[]=array( 'new', "new $filapath", "add post : $dir/$filename");
		}else{
			$title = $args[0];
			$filename = "$today"."-"."$title".".md";
			$filapath = $this->home."/_posts/$filename";
			$result[]=array( 'new', "new $filapath", "add post : $filename");
		}
		return $result;
	}

	private function edit($args)
	{
		$result = array();
		$dir = $this->home."/_posts";
		$file_list = $this->listFiles($dir);
		foreach ($file_list as $value) {
			$filename = $value[1];
			$match = $args[0];
			if(preg_match("/$match/", $filename))
			{
				$result[]=array( 'edit', 'open '.$value[0], 'edit post : '.$value[1]);
			}
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
			if(preg_match("/$match/", $filename))
			{
				$result[]=array( 'edit', 'open '.$value[0], 'edit templet : '.$value[1]);
			}
		}
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
}