<?php

require_once('db/drivers/mysql/MySqlStatement.class.php');

class MySqlQueryStatement extends MySqlStatement {

	function MySqlQueryStatement(&$connection, $sql) {
		parent::MySqlStatement($connection, $sql);
	}

	function getOneValue() {
		$queryId = $this->connection->execute($this->getSql());
		$row = mysql_fetch_row($queryId);
		mysql_free_result($queryId);
		if (is_array($row)) {
			return $row[0];
		} else {
			return null;
		}
	}

	function getOneColumnAsArray() {
		$column = array();
		$queryId = $this->connection->execute($this->getSql());
		while (is_array($row = mysql_fetch_row($queryId))) {
			$column[] = $row[0];
		}
		mysql_free_result($queryId);
		return $column;
	}

	function getTwoColumnsAsArray() {
		$column = array();
		$queryId = $this->connection->execute($this->getSql());
		while(is_array($row = mysql_fetch_row($queryId)))
		$column[$row[0]] = $row[1];
		mysql_free_result($queryId);
		return $column;
	}

	function getFirstRecord() {
		$rs = $this->getAssocRecordSet();
		$rs->rewind();
		return ($rs->valid()) ? $rs->current() : null;
	}

	function getAllRecords($keyField = null)
	{
		
		$data = $this->getRecordSet();
		$result = array();

		if (is_null($keyField)) {
			$key = 0;
		}

		for ($data->rewind(); $data->valid(); $data->next())
		{
			$record = $data->current();
			if (is_null($keyField)) {
				$result[$key++] = $record;
			} else {
				$result[$record[$keyField]] = $record;
			}
		}
		
		return $result;
	}

	function getRecordSet() {
		return $this->getAssocRecordSet();
	}

	function getAssocRecordSet() {
		if (!class_exists('MySqlRecordSet'))
		require_once( 'req/db/drivers/mysql/MySqlRecordSet.class.php');
		return new MySqlRecordSet($this->connection, $this->getSql(), MYSQL_ASSOC);
	}

	function getNumericRecordSet() {
		if (!class_exists('MySqlRecordSet'))
		require_once( 'req/db/drivers/mysql/MySqlRecordSet.class.php');
		return new MySqlRecordSet($this->connection, $this->getSql(), MYSQL_NUM);
	}

}