<?php

class ComponentRequest {

  var $session;
  var $user;
  var $params;
  var $componentUrl;
  var $tagUrl;
  
  var $_httpRequest;
  
  function ComponentRequest() {
  	
  }
  
  function getParam($name) {
  	return $this->params[$name];
  }
  
  function hasParam($name) {
  	return isset($this->params[$name]);
  }
  
  function & getSession() {
  	return $this->session;
  }
  
  function & getUser() {
  	return $this->user;
  }  
  
}

