<?php

class DbConfig {
  var $driver;
  var $host;
  var $user;
  var $password;
  var $database;
  var $charset;
  
  function DbConfig($connectionString)
  {
    $parts = parse_url($connectionString);
    
    $this->driver = $parts['scheme'];
    $this->host = $parts['host'];
    $this->user = $parts['user'];
    $this->password = isset($parts['pass'])?($parts['pass']):"";
    $this->database = trim($parts['path'], '/');
  }
  
  function getDriver()
  {
  	return $this->driver;
  }
  
  function getHost()
  {
  	return $this->host;
  }
  
  function getUser()
  {
  	return $this->user;
  }
  
  function getPassword()
  {
  	return $this->password;
  }
  
  function getDatabase()
  {
  	return $this->database;
  }
  
  function getCharset()
  {
  	return $this->charset;
  }
  
}