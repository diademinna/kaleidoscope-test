<?php

interface ICacheStorage {  
  
	const DEFAULT_CACHE_GROUP = 'default';
	
  public function validate($key, $group = self::DEFAULT_CACHE_GROUP);
  
  public function putValue($value, $key, $group = self::DEFAULT_CACHE_GROUP, $expired_time = null);
  
  public function getValue($key, $group = self::DEFAULT_CACHE_GROUP);
  
  public function flushValue($key, $group = self::DEFAULT_CACHE_GROUP);
  
  public function flushGroup($group = self::DEFAULT_CACHE_GROUP);
  
  public function flushAll();
  
}

