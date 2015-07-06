<?php

class Url {
  
  var $_protocol = '';
  var $_user = '';
  var $_password = '';
  var $_host = '';
  var $_port = '';
  var $_path = '';
  var $_anchor = '';
  var $_query_items = array();
  var $_path_elements = array();
  
  function Url($str = '') {
  	if (!empty($str))
      $this->parse($str);
  }
  
  function reset() {
    $this->_protocol = '';
    $this->_user = '';
    $this->_password = '';
    $this->_host = '';
    $this->_port = '';
    $this->_path = '';
    $this->_anchor = '';
    $this->_query_items = array();
    $this->_path_elements = array();
  }

  function parse($str) {
    if (empty($str))	{
      return false;
    }
      
    if (!$parts = @parse_url($str)) {
      return false;
    }
    
    foreach ($parts as $key => $value) {
      switch ($key) {
        case 'scheme':
          $this->setProtocol($value); 
          break;
        case 'user':
          $this->setUser($value);
          break;
        case 'host':
          $this->setHost($value);
          break;
        case 'port':
          $this->setPort($value);
          break;
        case 'pass':
          $this->setPassword($value);
          break;
        case 'path':
          $this->setPath($value);
          break;
        case 'query':
          $this->setQueryString($value);
          break;
        case 'fragment':
          $this->setAnchor($value);
          break;
      }
    }
  }
  
  
  function getProtocol() {
  	return $this->_protocol;
  }
  
  function getUser() {
    return $this->_user;	
  }
  
  function getPassword() {
  	return $this->_password;
  }
  
  function getHost() {
  	return $this->_host;
  }
  
  function getPath() {
  	return $this->_path;
  }
  
  function getAnchor() {
  	return $this->_anchor;
  }
  
  function setProtocol($protocol) {
  	$this->_protocol = $protocol;
  }
  
  function setUser($user) {
  	$this->_user = $user;
  }
  
  function setPassword($password) {
  	$this->_password = $password;
  }
  
  function setHost($host) {
  	$this->_host = $host;
  }
  
  function setPort($port) {
  	$this->_port = $this->post;
  }
  
  function setPath($path) {
  	$this->_path = $path;
  	$this->_path_elements = explode('/', $this->_path);
  }
  
  function setAnchor($anchor) {
  	$this->_anchor = $anchor;
  }
  
  function setQueryString($query_string) {
    $this->_query_items = $this->_parseQueryString($query_string);
  }
  
  function _parseQueryString($query_string) {
  	$query_string = rawurldecode($query_string);
  	parse_str($query_string, $arr);
  	foreach ($arr as $key => $value) {
  	  if (!is_array($value)) {
        $arr[$key] = rawurldecode($value);
  	  }
  	}
  	return $arr;
  }
  
  function toString($parts = array('protocol', 'user', 'password', 'host', 'port', 'path', 'query', 'anchor')) {
  	$result = '';
    if (in_array('protocol', $parts)) {
      $result .= !empty($this->_protocol) ? $this->_protocol . '://' : '';
    }
      
    if (in_array('user', $parts)) {
      $result .= $this->_user;
      if(in_array('password', $parts))
        $result .= (!empty($this->_password) ? ':' : '') . $this->_password;
      $result .= (!empty($this->_user) ? '@' : '');
    }

    if(in_array('host', $parts)) {
      $result .= $this->_host;

      if(in_array('port', $parts))
        $result .= (empty($this->_port) ||  $this->_port == '80') ? '' : ':' . $this->_port;
    } else {
      $result = '';
    }

    if(in_array('path', $parts)) {
      $result .= $this->_path;
    }

    if(in_array('query', $parts)) {
      $query_result = $this->getQueryString();
      $result .= !empty($query_result) ? '?' . $query_result : '';
    }

    if(in_array('anchor', $parts)) {
      $result .= !empty($this->_anchor) ? '#' . $this->_anchor : '';
    }

    return $result;      
  }
  
  function getQueryString() {
    $query_string = '';
    $query_items = array();
    $flat = array();
    
    include_once('utils/ArrayUtils.inc.php');
    
    array_flat($this->_query_items, $flat);    
    ksort($flat);
    
    foreach ($flat as $key => $value) {
      if ($value != '' || is_null($value)) {
        $query_items[] = $key . '=' . $value;
      } else {
        $query_items[] = $key;
      }
    }

    if ($query_items) {
      $query_string = implode('&', $query_string);
    }
    return $query_string;
  }
  
  function clearQueryItems() {
    $this->_query_items = array();
  }
}