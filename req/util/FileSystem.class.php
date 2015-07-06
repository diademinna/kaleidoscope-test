<?php

class FileSystem {  
  
	static public function createFolder($folderName, $permissions = 0777){	
		$folders = explode('/', $folderName);
		$fName = '.';
		foreach ($folders as $folder) {       
		//      if ( in_array($folder, array('', '.', '..'))) {
		//        continue;
		//      }            
		$fName = $fName . '/' . $folder;   
		  
		if (!is_dir($fName)) {
		    mkdir ($fName, $permissions);
		    chmod($fName, $permissions);
		}
		
		//      $dir = opendir($fName);
		//      // echo system('pwd');
		//      if(!$dir) {  
		//        mkdir ($fName, $permissions);
		//      } else {
		//        closedir ($dir);
		//      }
		}   
	}
	
	// ПРИМЕР
	// if (file_exists("uploaded/product/{$id}/charact.xml")) {...}	
	// РАБОТАЕТ![Zero]
	static function existsFile($fileName){
		return file_exists($fileName);
	}
  
	static function readFile($fileName){
		if (!($fp = @fopen($fileName, 'r'))) {
		  return false;
		}
		if ($fsize = filesize($fileName)) 
		  $source = fread($fp, $fsize);
		else {
		  $source = '';
		  while (!feof($fp)) {
		    $source .= fread($fp, 4096);
		  }
		}
		fclose($fp);
		return $source;   
	}  
  
	// пример 
	// FileSystem::deleteFolder("uploaded/product/{$id}", true);
	// РАБОТАЕТ![Zero]
	static public function deleteFolder($folderName, $removeRoot = false){
		if (is_dir($folderName)) {
			$dir = opendir($folderName);
			while(($file = @readdir($dir))) {
			  if ( is_file ($folderName."/".$file)) {
			    @unlink ($folderName."/".$file);
			  }
			  else if ( is_dir ($folderName."/".$file) && ($file != ".") && ($file != "..")) {
			   FileSystem::deleteFolder ($folderName."/".$file, true);  
			  }
			}
			closedir ($dir);
			
			if ($removeRoot) {
			   @rmdir ($folderName);
			}
		}
	}  

	// Заливка файла на сервер 
	// РАБОТАЕТ![Zero]
	static public function uploadFile($sourcefile, $location, $filename){
		if(!file_exists($location)){
			FileSystem::createFolder($location);
			//mkdir ($location, 0777);
			//chmod ($location, 0777);
		}
		if(!is_executable($filename)){
			move_uploaded_file($sourcefile, $location."/".$filename);
			@chmod($location."/".$filename, 0777);
		}
		else{			
			throw new Exception('File Upload Error'); // REVIEW
		}
	}
  
	static public function saveFile($content,$location,$filename=null){
		if(!$filename){
			$path_parts = pathinfo($location);
			$location = $path_parts['dirname'];
			$filename = $path_parts['basename'];
		}
		if(!file_exists($location)){
			if($location2 = preg_replace("~/[^/]+$~", "", $location)){
				if(!file_exists($location2)){
		  		mkdir ($location2, 0777);
		    	chmod ($location2, 0777);
				}
			}
			mkdir ($location, 0777);
			chmod ($location, 0777);
			}
			if(!is_executable($filename) ){
				if (!($fp = fopen($location . "/" . $filename, "w+"))){
					throw new GeneralException('Save File Error : '.$location."/".$filename);
				}
				fwrite($fp, $content);
				fclose($fp);
				@chmod($location . "/" . $filename, 0777);
				return true;
			}
		else{
			throw new Exception('File Upload Error'); // REVIEW
		}
	}
  
	// Удаление файла 
	// РАБОТАЕТ![Zero]
	static public function deleteFile($filename) {
		if(file_exists($filename)){
			unlink($filename);
		}
	}
  
  
	static public function deleteFileByMask($mask) {	
		$files = glob($mask);
		foreach ($files as $file)
		@unlink($file);
	}
  
  
	static public function copyFile($source, $dest) {
		copy($source, $dest);
		chmod($dest, 0777);
	}
   
	static public function deleteOldFiles($folderName, $time){
		if ($handle = opendir($folderName)) {
		    while (false !== ($file = readdir($handle))) { 
		        if ($file != "." && $file != "..") { 
			      if (!is_dir($file)) {
			      	if (filemtime("{$folderName}/{$file}") < $time) {
			      		unlink("{$folderName}/{$file}");
			      	}
			      }
		        }
		    }
		    closedir($handle); 
		}
	}

}
