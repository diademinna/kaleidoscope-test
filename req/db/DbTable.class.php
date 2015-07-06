<?php

require_once("db/DbFactory.class.php");
require_once('db/DbTableMetadata.class.php');

require_once('service/CacheService.class.php');
require_once('cache/FileCacheStorage.class.php');

if (!defined('CACHE_DB_TABLE_METADATA')) {
    define('CACHE_DB_TABLE_METADATA', false);
}

class DbTable  {

    const CACHE_GROUP = 'db_table_metadata';
    static $db;
    
		/**
		 * @var DbConnection */
    protected $connection;
    protected $tableName;

    // IN FUTURE:
    // var $autoConstraints;
    // var $constraints;

    protected $_metadata;
    //  var $primaryKey;
		
    //memCache
    private static $staticMetadata;
    private static $staticConnection;
    
    private function getConnection(){
    	if(isset(self::$staticConnection[self::$db]) && self::$db){
    		return self::$staticConnection[self::$db];
    	}
    	$conn = DbFactory::getConnection();
    	self::$db = "_";
    	return self::$staticConnection[self::$db] = $conn;
    }
    
    public function __construct($tableName = '') {
    	$this->connection = $this->getConnection();
      
    	if(isset(self::$staticMetadata[$tableName])){
    		$this->_metadata = self::$staticMetadata[$tableName];
    		$this->tableName = $tableName;
    	}
    	else{
        if ($tableName) {
            $this->tableName = $tableName;
            self::$staticMetadata[$tableName] = $this->_metadata = $this->retriveTableMetadate();
            //      $this->fields = $this->_metadata->getFields();
            //      $this->primaryKey = $this->_metadata->getPrimaryKey();
        }
    	}
    }
	/**
	 * @return DbTableMetadata */
    public function retriveTableMetadate() {
    		$cacheService = new CacheService(new FileCacheStorage());
    		
        if (CACHE_DB_TABLE_METADATA == false) {
            $metadata = $this->connection->getTableMetadata($this->tableName);
            if(!$metadata){
            	
            	throw new GeneralException('no metadata for table: '.$this->tableName);
        		}
            $cacheService->putValue($metadata, $this->tableName, self::$db . DbTable::CACHE_GROUP);
        }
        else {
        	$metadata = $cacheService->getValue($this->tableName, self::$db . DbTable::CACHE_GROUP);
        }
        return $metadata;
    }

    //  function _cascadeDelete($rows)
    //  {
    //
    //    foreach ($this->constraints as $constraintsArray)
    //    {
    //      foreach ($constraintsArray as $key => $params)
    //      {
    //        $fieldName = $params['field'];
    //        $className = $params['table'];
    //
    //        $class_path = new ClassPath($dbTable);
    //        $dbTable = $class_path->createObject();
    //    // TODO
    //    //        foreach ($rows as $row)
    //    //          $dbTable->delete(array($fieldName . '=' . $dbTable->get));
    //      }
    //    }
    //
    //  }
    //

    function hasField($name) {
        return $this->_metadata->hasField($name);
    }

    function getFieldType($field) {
        if (!$this->hasField($field)) {
            return false;
        }

        $this->_metadata->getFieldType($field);

    }

    function getPrimaryKey() {
        return $this->_metadata->getPrimaryKey();
    }

    function _filterRow($row)
    {
        $filtered = array();
        foreach (array_keys($row) as $field) {
            if ($this->hasField($field))
            $filtered[$field] = $row[$field];
        }
        return $filtered;
    }


    function delete($where)
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $where;
        $query = $this->connection->newStatement($sql);
        $query->execute();
        return $query->getAffectedRowCount();
    }

    function deleteAll()
    {
        $sql = 'DELETE FROM ' . $this->tableName;
        $query = $this->connection->newStatement($sql);
        $query->execute();
        return $query->getAffectedRowCount();
    }

    function deleteById($id)
    {$where= $this->getPrimaryKey() . " = '" . $id . "'";
    return $this->delete($where);
    }

    function select($where = '', $order = '', $offset = 0, $limit = '')
    {
        //  	$query = new SelectQuery($this->tableName);
        //  	$query->setLimit($offset, $limit);
        //  	$query->addFrom('');
        //  	$query->addCriteria(new FieldCriteria('id', $id, SQL_EQUAL));
        //  	$query->addField('name');
        //  	$query->toString();

        $query = "SELECT * FROM `" . $this->tableName . "` ";
        if(!empty($where))
        {
            $query .= ' WHERE ' . $where;
        }
        if(!empty($order))
        {
            $query .=' ORDER BY ' . $order;
        }
        if (!empty($limit) || $offset > 0) {
            $offset = (int) $offset;
            $limit = (int) $limit;
            $query .= " LIMIT {$offset}, {$limit} ";
        }

        $data = $this->connection->newStatement($query);
        return $data->getAllRecords();//$this->getPrimaryKey()
    }

    function selectById($id)  {
        // $id = $this->connection->quote($id);
        $where=$this->getPrimaryKey() . " =  '" . $id . "'";
        return $this->selectFirst($where);
    }

    function selectFirst($where = '', $order = '') {
        $query = "select * from `" . $this->tableName . "` ";
        if(!empty($where))
        {
            $query .=  ' WHERE ' . $where;
        }
        if(!empty($order))
        {
            $query .= ' ORDER BY ' . $order;
        }
        $data = $this->connection->newStatement($query);
        return $data->getFirstRecord();
    }

    function insert($values) {

        $sql = 'INSERT INTO ' . $this->tableName;

        $values = $this->_filterRow($values);

        $fieldNames = array_keys($values);
        $fieldValues = array();
        foreach ($fieldNames as $field) {
            $fieldValues[] = ':' . $field . ':';
        }

        $sql .= '(' . implode(',', $fieldNames) . ') VALUES (' . implode(',', $fieldValues) . ')';

        $query = $this->connection->newStatement($sql);
        foreach ($values as $key => $value) {
            $query->setAs($key, $value, $this->_metadata->getFieldType($key));
        }
        $query->execute();
        return $query->getInsertId();
    }

    function update($values, $where='') {

        $sql = 'UPDATE `' . $this->tableName . '` SET ';

        $values = $this->_filterRow($values);

        $values_sql = array();
        foreach ($values as $key => $value) {
            $values_sql[] = " {$key}=:{$key}:";
        }
        $sql .= implode(",", $values_sql);

        if (!empty($where)) {
            $sql .= ' WHERE (' . $where . ')';
        }
//        $sql = str_replace("''", "'", $sql);

        $query = $this->connection->newStatement($sql);
        foreach ($values as $key => $value) {
            $query->setAs($key, $value, $this->_metadata->getFieldType($key));
        }
        $query->execute();
        return $query->getAffectedRowCount();

    }

    function updateById($values, $id) {
        $where= $this->getPrimaryKey() . " = '" . $id . "'";
        return $this->update($values,$where);
    }

    //   function __sleep() {
    //		$this->connection = null;
    //    return array(array_keys(get_class_vars(get_class($this))));
    //  }

    function __wakeup() {
        $this->connection = DbFactory::getConnection();
    }

    public function getTableName() {
        return $this->tableName;
    }
    
    
    /**
     * getCountOfRecords
     *
     * @param string $where
     * @return unknow_type
     */
    public function getCountOfRecords($where='') {
    	$sqlQuery = "SELECT COUNT(*) AS number FROM `{$this->tableName}`";
    	if (!empty($where)) {
    		$sqlQuery .= " WHERE {$where}";
    	}
    	$query = $this->connection->newStatement($sqlQuery);
    	return $query->getFirstRecord();
    }


}
