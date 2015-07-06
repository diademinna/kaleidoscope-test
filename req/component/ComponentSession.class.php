<?php

class ComponentSession {
  
  var $_httpSession;
  
  function ComponentSession() {
    $this->_httpSession =& HttpSession::getInstance();	
  }
  
  
  function getValue($name) {
  	return $this->_httpSession->get($name);
  }
  
  function removeValue($value) {
  	
  }
  
  function hasValue($name) {
  	
  }
  
  function setValue($name, $value) {
  	
  }
  
}