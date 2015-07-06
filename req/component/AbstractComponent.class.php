<?php

class AbstractComponent {
  
  var $response;
  var $response;
  var $componentSession;

  function AbstractComponent() {
  	
  }
  
  function getClass() {
  	return 'AbstractComponent';
  }
  
  function doContent() {
  	die('Error: Abstract method called.');
  }
  
  function & getSession() {
  	$this->session;
  }
  
  function setSession(&$session) {
  	$this->session =& $session;
  }
  
  function & getRequest() {
    return $this->request;
  }  
  
  function setRequest(&$response) {
  	$this->request =& $response;
  }
  
  function getResponse(&$response) {
  	return $this->response;
  }
  
  function setResponse(&$response) {
  	$this->response =& $response;
  }
  
}