<?php

class HttpFileParser {
  
  function parseFiles($files) {
    $result = array();
    foreach ($files as $key => $data) {
      if ($this->_isSingleFile($data)) {
        $result[$key] = $data;      
      } else {
        $result[$key] += $this->_parseComplex($data);      
      }
    }
    return $result;    
  }
  
  function _parseComplex($data) {
    $result = array();
    foreach ($data as $dataKey => $dataValue) {
      foreach ($dataValue as $key => $value) {
        $this->_parsePropertyRecursive($result[$key], $dataKey, $value);
      }
    }
    return $result;
  }
  
  function _isSingleFile($data)
  {
    return 
      (isset($data['name'])) && (!is_array($data['name'])) &&
      (isset($data['error'])) && (!is_array($data['error'])) &&
      (isset($data['type'])) && (!is_array($data['type'])) &&
      (isset($data['size'])) && (!is_array($data['size'])) &&
      (isset($data['tmp_name'])) && (!is_array($data['tmp_name']));
  }
  
  function _parsePropertyRecursive(&$result, $propertyName, $data)
  {
    if (!is_array($data)) { 
      $result[$propertyName] = $data;    
    } else {
      foreach ($data as $dataKey => $dataValue) {
        $this->_parsePropertyRecursive($result[$dataKey], $propertyName, $dataValue);
      }
    }       
  }  
  
}