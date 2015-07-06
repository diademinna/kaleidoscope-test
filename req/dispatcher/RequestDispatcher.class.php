<?php

class RequestDispatcher {
  
  var $httpRequest;
  
  var $component;
  
  function RequestDispatcher(&$httpRequest) {
  	
     	$this->httpRequest =& $httpRequest;
  }
  
  function dispatch() {
    //$a = 'MyClass';
  	//$this->component = new $a() ;
  }
  
  function & getDispatchedComponent() {
    return $this->component;
  }
  
}