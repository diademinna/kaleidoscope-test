<?php

class DbTableMetadata {
  
  var $fields = array();
  var $primaryKey = '';
  
  function addField($fieldName, $fieldType, $fieldSize = 0, $primaryKey = false, $notNull = false) {
    
    // identify field metatype
    if ($metaType = $this->getMetaType($fieldType)) {
      $fieldType = $metaType;
    } else {
      die('Invalid field type: ' . $fieldType . ' of field ' . $fieldName);
    }
    
    if ($primaryKey) {
      $this->primaryKey = $fieldName;
    }
    
  	$field = array('name' => $fieldName, 'type' => $fieldType, 'size' => $fieldSize, 'not_null' => $notNull);
  	$this->fields[$fieldName] = $field;  	
  }
  
  function hasField($fieldName) {
  	return isset($this->fields[$fieldName]);
  }
  
  function getFieldsCount() {
    return count($this->fields);
  }
  
  function getFields() {
    return $this->fields;
  }
  
  function setFields($fields) {
    return $this->fields = $fields;
  }
  
  function getField($name) {
    return $this->fields[$name];
  }
  
  function getFieldType($fieldName) {
    return isset($this->fields[$fieldName]['type']) ? 
      $this->fields[$fieldName]['type'] : false;
  }
  
  function getFieldSize($fieldName) {
    return isset($this->fields[$fieldName]['size']) ? 
      $this->fields[$fieldName]['size'] : false;    
  }
  
  function isFieldNotNull($fieldName) {
  	return isset($this->fields[$fieldName]['not_null']) ? 
      $this->fields[$fieldName]['not_null'] : false;    
  }
  
  function getMetaType($fieldType) {

    static $typeMap = array(
      DB_STRING_TYPE => array('varchar', 'char', 'string', 'nchar', 'enum', 
        'charaster', 'interval', 'enum'),
      DB_INTEGER_TYPE => array('integer', 'int', 'long', 'bigint'),
      DB_TEXT_TYPE => array('longchar', 'text', 'memo'),
      DB_BLOB_TYPE => array('blob', 'image', 'binary'),
      DB_BOOLEAN_TYPE => array('boolean', 'logical'),
      DB_DATE_TYPE => array('date', 'year'),
      DB_TIME_TYPE => array('time'),
      DB_TIMESTAMP_TYPE => array('timestamp'),
      DB_DATETIME_TYPE => array('datetime'),
      DB_FLOAT_TYPE => array('float', 'real', 'double', 'decimal', 'currency', 'money', 'numeric')
    );
    
    $fieldType = strtolower($fieldType);
    foreach ($typeMap as $type => $variants) {
      if (in_array($fieldType, $variants)) {
        return $type;
      }
    }
    return false;
  }
  
  function getPrimaryKey() {
    return $this->primaryKey;
  }
  
  function setPrimaryKey($primaryKey) {
    $this->primaryKey = $primaryKey;
  }
  
}