<?php

require_once('db/drivers/mysql/MySqlStatement.class.php');

class MySqlManipulationStatement extends MySqlStatement {

  function getAffectedRowCount() {
    return mysql_affected_rows($this->connection->getConnectionId());
  }
  
}

