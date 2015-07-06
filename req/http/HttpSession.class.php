<?php
/**
 * Session envelopment class. Provides correct saving objects to session.
 *
 * @author voyachek
 * @package core
 */
define('SESS_INCLUDES', '_sess_includes');

class HttpSession {
  var $started;
  
  public function HttpSession() {
    $this->started = false;
  }
  
  public function & getInstance() {
  	if (!isset($GLOBALS['HttpSessionInstance'])) {
  	  $GLOBALS['HttpSessionInstance'] = new HttpSession();
  	}
  	return $GLOBALS['HttpSessionInstance'];
  }
  
  public function start() {
    if ($this->started) return false;
    @session_start();   
    $this->started = true;
    return true;  
  }
  
  public function close() {
    @session_write_close();
  }
  
  public function & get($name) {
    return isset($_SESSION[$name]) ? $_SESSION[$name] : $_SESSION[$name] = '';
  }
  
  public function set($name, $value) {
    $_SESSION[$name] = $value;  
  }
  
  public function has($name) {
    return isset($_SESSION[$name]);
  }
  
  public function registerClass($class_name, $file) {
    $class_name = strtolower($class_name); // PHP 4 problem         
    if (!isset($_SESSION[SESS_INCLUDES][$class_name])) {
      $_SESSION[SESS_INCLUDES][$class_name] = $file;
    }
  }
  
  public function remove($name) {
    if (isset($_SESSION[$name])) {
      //session_unregister($name);
      unset($_SESSION[$name]);
    }
  }
  
  public function _includeSessionClasses() {
    $includes = $_SESSION[SESS_INCLUDES];
    foreach ($includes as $include) {
      include_once($include);    
    }
  }
  
  public function unserialize_callback($class_name) {
    if (isset($_SESSION[SESS_INCLUDES][$class_name])) {
      include_once($_SESSION[SESS_INCLUDES][$class_name]);
    } else {
      die('Class ' . $class_name . ' cannot be serialized ');
    }
  }
}

function __unserialize_callback($class_name) {
  Session::unserialize_callback($class_name); 
}

?>