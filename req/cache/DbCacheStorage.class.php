<?php

require_once("cache/ICacheStorage.inteface.php");
require_once("db/DbTable.class.php");

require_once('util/Serializer.class.php');

class DbCacheStorage implements ICacheStorage {

	protected $dbTable;
	
	public function __construct($cacheTable) {
		$this->dbTable = new DbTable($cacheTable);
	}

	public function validate($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {

		// ����������� �� ������ ������� ���������� � ���� �� � �� ������������
		$row = $this->dbTable->selectFirst("cache_key = '$key' and cache_group = '$group'");
		if (empty($row)) {
			return false;
		}

		$timeMapValue = $row['expired_time'];
    if (!isset($timeMapValue) || is_null($timeMapValue)) {
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
		
		 if (is_object($value)) {
//    	$value = new Serializer($value);    	
    } 
    $serialValue = serialize($value);

    
    // �������� ����� ������������ ��������
    if (!is_null($expired_time)) {
    	$expired_time += time();
    }  
    
		$row = Array(
			'cache_group' => $group, 'cache_key' => $key, 'expired_time' => $expired_time, 'value' => $serialValue
		);
		
		$id = $this->dbTable->insert($row);
		return $id;
	}

	public function getValue($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {
		if (!$this->validate($key, $group)) {
			return null;
		}

		$row = $this->dbTable->selectFirst("cache_key = '$key' and cache_group = '$group'");
		
		$value = unserialize($row['value']); 
		if ($value instanceof Serializer) {
			$value = $value->getSubject();
		}
		
    return $value;
	}

	public function flushValue($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {
		$row = $this->dbTable->delete("cache_key = '$key' and cache_group = '$group'");
	}

	public function flushGroup($group = DEFAULT_CACHE_GROUP) {
		$row = $this->dbTable->delete("cache_group = '$group'");
	}

	public function flushAll() {
		$row = $this->dbTable->deleteAll();
	}
	
}


?>