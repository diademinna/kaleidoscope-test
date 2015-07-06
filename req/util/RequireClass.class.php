<?php

/*
header("content-type: text/plain");
$arg = new ActiveRecordGenerator("food");
echo $arg->getArClassContent();
echo $arg->getClassContent();
 */

class RequireClass {
	/**
	 * @param class1,class2...
	 */
	static public function model(){
		$models = func_get_args();
		foreach ($models as $class){
			self::requireOne($class);
		}
	}
	
	/**
	 * @param CategoryName, class1,class2...
	 */
	static public function modelByCategory(){
		$models = func_get_args();
		$dir = $models[0];
		unset($models[0]);
		self::requireByDir($dir, $models);
	}
		
	
	static private function requireByDir($dir, $classes){
		foreach ($classes as $class){
			self::requireOne($class, $dir);
		}
	}
	
	static private function requireOne($class, $dir = null){
		$file = "model/".(($dir)?$dir."/":'').$class.".class.php";
		if(!file_exists($file)){
				 //throw new Exception("class: '{$file}' location not found");
		}
		require_once ($file);
	}
	
}
