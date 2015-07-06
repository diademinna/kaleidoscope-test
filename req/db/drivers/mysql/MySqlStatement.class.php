<?php

class MySqlStatement 
{
  var $connection;
  var $statement;
  var $parameters = array();

  function MySqlStatement(&$connection, $sql)
  {
    $this->statement = $sql;
    $this->connection =& $connection;
  }

  function setBoolean($name, $value) {
   	$this->parameters[$name] = is_null($value) ? 'NULL' : (($value) ? '1' : '0');
  }
  
  function setString($name, $value) {
   	$this->parameters[$name] = is_null($value) ? 
   	  'NULL' : "'" . mysql_real_escape_string((string) $value) . "'";
  }
  
  function _setDate($name, $value, $format) {
    if (is_int($value))
      $this->parameters[$name] = "'" . date($format, $value) ."'";
    else if (is_string($value)) {
      $this->parameters[$name] = "'" . mysql_real_escape_string($value) . "'";
    } else {
      $this->parameters[$name] = "NULL";
    }
  }
  
  function setDate($name, $value) {
    $this->_setDate($name, $value, 'Y-m-d');
  }
  
  function setTime($name, $value) {
  	$this->_setDate($name, $value, 'H:i:s');
  }
  
  function setTimeStamp($name, $value) {
    $this->_setDate($name, $value,'Y-m-d H:i:s');
  }
  
  function setDateTime($name, $value) {
    $this->_setDate($name, $value,'Y-m-d H:i:s');
  }
  
  function setInteger($name, $value) {
    $this->parameters[$name] = is_null($value) ? 'NULL' : intval($value);
  }
 
  function setFloat($name, $value) {
   // $this->parameters[$name] = is_null($value) ? 'NULL' : "'" . floatval($value) . "'";
	if(!is_null($value)){
		$value = str_replace(',', '.', $value);
	}
   
    $this->parameters[$name] = is_null($value) ? 'NULL' : "'{$value}'";
  }
  
  function setNull($name) {
  	$this->parameters[$name] = 'NULL';
  }
  
  function setText($name, $value) {
   	$this->parameters[$name] = is_null($value) ? 
   	  'NULL' : "'" . mysql_real_escape_string((string) $value) . "'";    	
  }
  
  function setVarChar($name, $value) { 
   	$this->parameters[$name] = is_null($value) ? 
   	  'NULL' : "'" . mysql_real_escape_string((string) $value) . "'";
  
  }  
 
  function set($name, $value)
  {
    if (is_string($value))
      $this->setString($name, $value);
    else if (is_int($value))
      $this->setInteger($name, $value);
    else if (is_bool($value))
      $this->setBoolean($name, $value);
    else if (is_float($value))
      $this->setFloat($name, $value);
    else
      $this->setNull($name);
  }
  
  function setAs($name, $value, $type = '')
  {
    $setters = array(
      DB_BOOLEAN_TYPE => 'setBoolean',
      DB_STRING_TYPE => 'setString',
      DB_TEXT_TYPE => 'setText',
      DB_INTEGER_TYPE => 'setInteger',
      DB_FLOAT_TYPE => 'setFloat',
      DB_DATE_TYPE => 'setDate',
      DB_TIME_TYPE => 'setTime',
      DB_TIMESTAMP_TYPE => 'setTimeStamp',
      DB_DATETIME_TYPE => 'setDateTime'            
    );
    
    if (isset($setters[$type])) {
      $setter = $setters[$type];
      $this->$setter($name, $value);
    } else {
      $this->set($name, $value);
    }
  }
  
  function setAsIs($name, $value)
  {
  	$this->parameters[$name] = $value;
  }
    
  function getSql()
  {
    $sql = $this->statement;
    foreach ($this->parameters as $key => $value)
      $sql = str_replace(':' . $key . ':', $value, $sql);
    return $sql;
  }
  
  function execute()
  {
  	
    return (boolean) $this->connection->execute($this->getSql());
  }
}