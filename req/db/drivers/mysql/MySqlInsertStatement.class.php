<?php

require_once('db/drivers/mysql/MySqlStatement.class.php');

class MySqlInsertStatement extends MySqlStatement {
  
  function getInsertId() {
    return mysql_insert_id($this->connection->getConnectionId());
  }
  
}

