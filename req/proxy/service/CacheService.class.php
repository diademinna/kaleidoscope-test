<?php

// FYI:  serialize() 

// $cache = new CacheService(new FileCacheStorage('vars/mycache.dat'));

class CacheService {
  
  protected $storage;
  
  public function __construct($storage) {
    $this->storage = $storage;
  }
  
  public function putValue($value, $key, $group = ICacheStorage::DEFAULT_CACHE_GROUP, $expired_time = null) {
  	return $this->storage->putValue($value, $key, $group, $expired_time);
  }
  
  public function validate($key, $group = self::DEFAULT_CACHE_GROUP) {
  	return $this->storage->validate($key, $group);
  }
  
  public function getValue($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {    
    // return null if value is invalid (timeout)
    return $this->storage->getValue($key, $group);
  }
  
  public function flushValue($key, $group = ICacheStorage::DEFAULT_CACHE_GROUP) {
    return $this->storage->flushValue($key, $group);
  }
  
  public function flushGroup($group = ICacheStorage::DEFAULT_CACHE_GROUP) {
    return $this->storage->flushGroup($group);
  }
  
  public function flushAll() {  	
    return $this->storage->flushAll();
  }
      
}
