<?php

require_once("cache/ICacheStorage.interface.php");
require_once("util/FileSystem.class.php");

require_once('util/Serializer.class.php');

/* 
 SV: �������� ������ - ������ ������ ��������  ����� � ��������� ����. 
 ����� getAll ����� ������ �� ������������� ��� ����� ������
 ������ ����� ������� �������������� �������� ����� � ��������.
 ����������������� �������� ����� ����, ��. $cacheFolder,
 ������ ������� ����� ��� �������� 
 */

class FileCacheStorage implements ICacheStorage {
  
  protected $cacheFolder = 'templates_c';
  
  public function __construct() {
    FileSystem::createFolder($this->cacheFolder);
  }
  
  protected function getCacheFileName($group, $key) {
    return $this->cacheFolder . '/' . $group . '/' . ($key);  	
  }
  
  protected function getCacheFolderName($group) {    
    return  $this->cacheFolder . '/' . $group;
  }
  
  /**
   * ��������� ������� � ������������ ��������, ��������� � ����
   *
   * @param string $key
   * @param string $group
   * @return boolean
   */
  public function validate($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {
  	
    // ����������� �� ������ ������� ���������� � ���� �� � �� ������������
  	if (!file_exists($this->getCacheFileName($group, $key))) {
  	  return false; 
  	}      	
  	
  	$f = fopen($this->getCacheFileName($group, $key), "r");
  	$timeMapValue = fgets($f);
  	fclose($f);
  
  	$timeMapValue = trim($timeMapValue);
    if (!isset($timeMapValue) || empty($timeMapValue)) {
      // ���� ����� ������������ �� �������, ������� ����� ����������      
      return true;        
    }

  	// �������� �������
    // ������� ���� �����, ����� ��������� ������ Date � DatePeriod
    if (time() > $timeMapValue) {
    	return false;
    }
    
    return true;    
  }
  
  public function putValue($value, $key, $group = ICacheStorage::DEFAULT_CACHE_GROUP, $expired_time = null) {

    FileSystem::createFolder($this->getCacheFolderName($group));   

    if (!is_null($expired_time)) {
    	$expired_time += time();
    } 
       
    $file_string = $this->getCacheFileName($group, $key);
//		echo ($file_string);
    
    $file = fopen($file_string, 'w');
    fputs($file, ($expired_time == null ? '' : $expired_time) . "\n");
    
    if (is_object($value)) {
//	    	$value = new Serializer($value);    	
    } 
    $serialValue = serialize($value);
    fputs($file, $serialValue . "\n"); 
    fclose($file);
    
//    chmod($file_string, 0777);
    
    return true;
  }  
  
  public function getValue($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {

    if (!$this->validate($key, $group)) {
      return null;
    }
    
     	$content = file_get_contents($this->getCacheFileName($group, $key));
  	$pos = strpos($content, "\n");
    $value = substr($content, $pos + strlen("\n"));

    $value = unserialize($value);  
    
		if ($value instanceof Serializer) {
			$value = $value->getSubject();
		}
    return $value;
  }
  
  public function flushValue($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {
  	$file = $this->getCacheFileName($group, $key);
  	if (file_exists($file)) {
  		unlink($file);
  	}
  }
  
  public function flushGroup($group = ICacheStorage::DEFAULT_CACHE_GROUP) {    
    // SV: ������� ��� �����
    FileSystem::deleteFolder($this->getCacheFolderName($group), true);    
  }  
  
  public function flushAll() {        
    // SV: ������� ��� ����� $cacheFolder � ��� �������� � ���
    //     ����������� �������� �������� � ������ FileSystem ���� (core/src/util/FileSystem.class.php)
    FileSystem::deleteFolder($this->cacheFolder, false);    
  }  
  
}
