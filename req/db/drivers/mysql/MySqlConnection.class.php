<?php
require_once('db/DbQueryException.class.php');
/**
 * MySql database driver
 *
 * @author voyacherk
 * @package core
 */

class MySqlConnection { // implements DbConnection   
  
  var $connectionId;
  var $config;
  
  /**
   * @param DbConfig $config
   * @return MySqlConnection
   */
  function MySqlConnection(DbConfig $config) {
    $this->config = $config;    
  }
  
  /**
   * Execute a SQL script and return result. Raise error if execution failed.
   * @param string $sql
   * @return mixed
   */
  function execute($sql) {
    $result = mysql_query($sql, $this->getConnectionId());
    if ($result == false) {
      $this->raiseError($sql);
    }      
    return $result;
  }
  
  /**
   * Try to connect to database
   * @return bool Success flag
   */
  function connect() {
  	if(!$this->connectionId = @mysql_connect(
	      $this->config->getHost(), 
	      $this->config->getUser(), 
	      $this->config->getPassword())) throw new DbQueryException('database connect', __FILE__, __LINE__);  
    
      
    if (!$this->connectionId) {
      $this->connectionId = null;
      $this->raiseError();
      return false;
    }
    
    if (!@mysql_select_db($this->config->getDatabase(),$this->connectionId)) {
    	$this->raiseError('database select');
      return false;
    }
    mysql_query("SET NAMES 'utf8'; ");
    //mysql_query("SET CHARSET 'utf8'; ");
   return true;
  }
  
  /**
   * Return connection descriptor
   * @return resource
   */
  function getConnectionId() {
  	return $this->connectionId;
  }
  
  /**
   * Return true if connection available, otherwise false
   * @return bool
   */
  function isConntected() {
  	return isset($this->connectionId) && !is_null($this->connectionId);
  }
  
  /**
   * Break connection with DB
   */
  function disconnect() {
    if ($this->isConntected()) {
      mysql_close($this->connectionId);
    }
  }
  
  /**
   * Create new statement object. Result can be instance of 
   * MySqlQueryStatement (for SELECT, SHOW, DESCRIBE, EXLAIN), 
   * MySqlInsertStatement (for INSERT), MySqlManipulationStatement (for DELETE, UPDATE)
   * and MySqlStatement in other cases.
   * 
   * @see MySqlStatement
   *
   * @param string $sql Base SQL script
   * @param array $params
   * @return object Instance of statement object
   */
  function newStatement($sql, $params = array()) {
    if (preg_match('~^\s*\(*\s*(\w+).*$~m', $sql, $match)) {
      $statement = $match[1];
    } else {
      $statement = $sql;
    }

    if (defined('SHOW_DEBUG_INFORMATION')) {
	  	$GLOBALS['test_counter']++;
	  	$GLOBALS['sql_list'] .= "<br/>{$sql}";
    }
    switch(strtoupper($statement)) {
      case 'SELECT':
      case 'SHOW':
      case 'DESCRIBE':
      case 'EXPLAIN':
        if (!class_exists('MySqlQueryStatement')) {
          require_once('db/drivers/mysql/MySqlQueryStatement.class.php');
        }
        return new MySqlQueryStatement($this, $sql);
      case 'INSERT':
        if (!class_exists('MySqlInsertStatement')) {
          require_once('db/drivers/mysql/MySqlInsertStatement.class.php');
        }
        return new MySqlInsertStatement($this, $sql);
      case 'UPDATE':
      case 'DELETE':
        if (!class_exists('MySqlManipulationStatement')) {
          require_once('db/drivers/mysql/MySqlManipulationStatement.class.php');                
        }
        return new MySqlManipulationStatement($this, $sql);
      default:
        if (!class_exists('MySqlStatement')) {
          require_once('db/drivers/mysql/MySqlStatement.class.php');                
        }
        
        return new MySqlStatement($this, $sql);
    }
  }
  
  function getTableMetadata($tableName) {
    $resource = mysql_query('SELECT * FROM `' . $tableName . '` LIMIT 0', $this->getConnectionId());
    
    if ($resource) {
      if (!class_exists('DbTableMetadata')) {
        include_once('db/DbTableMetadata.class.php');
      }
      
      $metadata = new DbTableMetadata();
      
      $fieldsCount = mysql_num_fields($resource);
      for ($i = 0; $i < $fieldsCount; $i++) {
        $type = mysql_field_type($resource, $i);
        $name = mysql_field_name($resource, $i);
        $len = mysql_field_len($resource, $i);
        $flags = explode(" ", mysql_field_flags($resource, $i));        
        $not_null = in_array('not_null', $flags);
        $primary_key = in_array('primary_key', $flags);
        $metadata->addField($name, $type, $len, $primary_key, $not_null);
      }
      mysql_free_result($resource);
    
      return $metadata;  
      
    } else {
      return false;
    }    
    
  }

  public function escape($value) {
  	return mysql_real_escape_string($value);  
  } 

  /**
   * Die with DB error message
   * @param string $message
   */
  function raiseError($message = '') {
    throw new DbQueryException($message . '. ' . mysql_error($this->connectionId), __FILE__, __LINE__);
  }
  
}