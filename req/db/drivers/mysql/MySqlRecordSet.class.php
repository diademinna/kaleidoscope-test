<?php



class MySqlRecordSet // implements Iterator 
{ 
  var $key;
  var $current;
  var $valid = false;	
	
  var $connection;
  var $fetchMode;
  var $queryId;
  var $query;
  
  function MySqlRecordSet(&$connection, $query, $fetchMode = null)
  {
  	$this->connection =& $connection;
  	$this->fetchMode = $fetchMode;
    $this->query = $query;
  }
  
  function rewind()
  {
    if (isset($this->queryId) && is_resource($this->queryId))
    {
      if (mysql_data_seek($this->queryId, 0) === false)
        $this->connection->_raiseError();
    } else {
      $query = $this->query;
      $this->queryId = $this->connection->execute($query);
    }
    $this->key = 0;
    $this->next();
  }
  
  function valid() {
  	return $this->valid;
  }
   
  function key() {
  	return $this->key;
  }
   
  function current() {
  	return $this->current;
  }
   
  function next()
  {
    $this->current = mysql_fetch_array($this->queryId, $this->fetchMode);
    $this->valid = is_array($this->current);
    $this->key++;
  }
  
  function getRowCount()
  {
  	if (is_null($this->queryId))
      $this->rewind();
    return mysql_num_rows($this->queryId);
  }
  
}


