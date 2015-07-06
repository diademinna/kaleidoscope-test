<?php

/**
 * Response routine class. 
 * 
 * @package core
 * @author voyachek
 */

//require_once('her/Object.php');
require_once('http/Url.class.php');

class HttpRequest {
  
  var $url; 
  var $request;
  
  function HttpRequest() { 
    $this->request = array_merge($_GET, $_POST);
    if (get_magic_quotes_gpc()) {
      $this->request = $this->_stripHttpSlashes($this->request);
    }
    
    if (count($_FILES)) {
      
      include_once('http/HttpFileParser.class.php');
      $fileParser = new HttpFileParser();
      $this->request = array_merge($this->request, $fileParser->parseFiles($_FILES));
    }
    
    $this->url = new Url(isset($_SERVER['REQUEST_URI']) ? 
      $_SERVER['REQUEST_URI'] : '');
  }

  function _stripHttpSlashes($data, $result = array()) {
    foreach($data as $key => $value) {
      $result[$key] = (is_array($value)) ? 
        $this->_stripHttpSlashes($value) : stripcslashes($value);
    }
    return $result;
  }
  
  function getValue($name) {
  	return isset($this->request[$name]) ? $this->request[$name] : '';
  }
  
  function setValue($name, $value) {
  	$this->request[$name] = $value;
  }
  
  function hasValue($name) {
		return !empty($this->params[$name]);
  }
	
  function getAction() {
    return $this->has('action') ? $this->get('action') : '';
  }
  
  function & getUrl() {
    return $this->url; 
  }  
  function export() {
		return $this->request;
		
	}
}

?>