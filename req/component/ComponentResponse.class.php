<?php

class ComponentResponse {

  var $_httpResponse;
  
  var $content;
  
  function ComponentResponse(&$httpResponse) {
    $this->httpResponse =& httpResponse();
  }
  
  function redirect($url) {  	
    $this->httpResponse->redirect($url);
  }
  
  function write($string) {
  	$this->content .= $string;
  }
  
  function getContent() {
    return $this->content;
  }
    
}
