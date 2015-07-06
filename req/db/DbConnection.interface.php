<?php
/**
 * Database connection interface
 *
 * @author voyachek
 * @package core
 */


class DbConnection {
  
  function connect() { }
  
  function disconnect() { }
  
  function getConnectionId() { }
  
  function isConnected() { }
  
  function execute($sql) { }
  
  /**
   * @return MySqlQueryStatement
   */
  function newStatement($sql) {	}
  
  function getTableMetadata($tableName) {
  	
  }
  
}