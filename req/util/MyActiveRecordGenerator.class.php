<?php

require_once("util/FileSystem.class.php");

class MyActiveRecordGenerator {
	
	public static function doProcess(){
		
		require_once('util/ActiveRecordGenerator.class.php');
		require_once('util/FileSystem.class.php');
		
		$conn = DbFactory::getConnection();
		$tables = $conn->newStatement("show tables")->getOneColumnAsArray();
		
		$dir = "req/model/";
//		$dir = "z:/home/sport58/www/req/model/";
//		$dir = "/www/beescrm.konura.com/httpdocs/req/model/";
		
		foreach ($tables as $name) {
			$gen = new ActiveRecordGenerator($name);
			FileSystem::saveFile($gen->getArClassContent(),$dir.'active_record/'.$gen->getArNameClass().'.class.php');
			$filename = $dir.'business_logic/'.$gen->getNameClass().'.class.php';
			if (!FileSystem::existsFile($filename))
				FileSystem::saveFile($gen->getClassContent(),$filename);
		}
	}
	
}