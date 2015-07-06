<?php

require_once('util/ClassPath.class.php');
//require_once('db/active_record/IActiveRecord.interface.php');
require_once('db/DbTable.class.php');
require_once('db/ProxyActiveRecord.class.php');

class ActiveRecord
{
	protected $dbTable;
	protected $classDbTable;
	protected $isNew = true;
	protected $isDeleted = false;
	protected $classProperties; // = array('id' => array('column' => 'id'));
	protected $oneToOne;
	protected $oneToMany;
	protected $manyToOne;

	protected $currentHash = null;

	protected $id;
	
	public function __construct($dbTable) {
		$this->dbTable = new DbTable($dbTable);
		$this->classDbTable = $dbTable;
	}
	public function getIsNew() {
		return $this->isNew;
	}

	public function setIsNew($isNew) {
		$this->isNew = $isNew;
	}

	protected function createObject($classPath) {
		$cp = new ClassPath($classPath);
		return $cp->createObject();
	}


	protected function loadOneToOne() {
		$id = $this->getId();
		foreach ($this->oneToOne as $property => $options) {
			if($options['lazy']) {
				$object = new ProxyActiveRecord($id, $options['class']);
			} else {
				$object = $this->createObject($options['class']);
				$object->loadById($id);
			}
			$this->$property = $object;
		}
	}

	protected function loadOneToMany() {
		$id = $this->getId();

		foreach ($this->oneToMany as $property => $options) {
			if ($options['lazy']) {
				$tmpObject = $this->createObject($options['class']);
				$proxyIdArray = $this->findPKByFK($tmpObject->getPrimaryKey(), $tmpObject->getClassDbTable(), $options['foreign_key'], $id);
				if ($proxyIdArray) {
					$collection = array();
					foreach ($proxyIdArray as $proxyId) {
						$object = new ProxyActiveRecord($proxyId, $options['class']);
						$collection[] = $object;
					}

				} else {
					$collection = null;
				}
			} else {
				$object = $this->createObject($options['class']);
				$collection = $object->findByCondition($options['foreign_key'] . "='{$id}'");
			}
			$this->$property = $collection;
		}


	}

	protected function loadManyToOne($record) {
		foreach ($this->manyToOne as $property => $options) {

			//$options['foreign_key'];
			$id =& $record[$options['foreign_key']];
			if (!is_null($id)) {
				if($options['lazy']) {
					$object = new ProxyActiveRecord($id, $options['class']);
				} else {
					$object = $this->createObject($options['class']);
					$object->loadById($id);
				}
				$this->$property = $object;
			}
		}
	}
	
	static private $pkarray;

	private function findPKByFK ($primaryKey, $tableName, $foreignKey, $id) {
		if(isset(self::$pkarray[$primaryKey][$tableName][$foreignKey][$id])){
			return self::$pkarray[$primaryKey][$tableName][$foreignKey][$id];
		}
		$connection = DbFactory::getConnection();
		$query = "SELECT {$primaryKey} FROM `{$tableName}` WHERE {$foreignKey}=:id:";
		$statement = $connection->newStatement($query);
		$statement->setInteger('id', $id);
		self::$pkarray[$primaryKey][$tableName][$foreignKey][$id] = $statement->getOneColumnAsArray();
		return self::$pkarray[$primaryKey][$tableName][$foreignKey][$id];
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getPrimaryKey() {
		return $this->dbTable->getPrimaryKey();
	}


	public function setPropertyByFieldName($fieldName, $value) {
		foreach ($this->classProperties as $property => $options) {
			if ($options['column'] == $fieldName) {
				$this->$property = $value;
				break;
			}
		}
	}

	public function setFKPropertyByFK($fieldName, $value) {
		foreach ($this->manyToOne as $property => $options) {
			if ($options['foreign_key'] == $fieldName) {
				$this->$property = $value;
				break;
			}
		}
	}

	protected function getClassDbTable() {
		return $this->classDbTable;
	}

	protected function setClassDbTable($classDbTable) {
		$this->classDbTable = $classDbTable;
		$this->dbTable = new DbTable($this->classDbTable);
	}

	protected function getDbTable() {
		if (!isset($this->dbTable)) {
			$this->dbTable = new DbTable($this->classDbTable);
		}
		return $this->dbTable;
	}

	public function loadFromRecord($record) {
		foreach ($this->classProperties as $property => $options) {
			$this->$property = $record[$options['column']];
			// $this->id = ...
		}

		if (is_array($this->oneToOne)) {
			$this->loadOneToOne();
		}


		if (is_array($this->oneToMany)) {
			$this->loadOneToMany();
		}

		if (is_array($this->manyToOne)) {
			$this->loadManyToOne($record);
		}

		// remember current hash
		$this->setCurrentHash();
		return true;
	}
	
	public function loadById($id)
	{
		if(!$record = $this->dbTable->selectById($id)) {
			return false;
		}
		$this->loadFromRecord($record);
		$this->isNew = false;
		return true;
	}

	public function loadByCondition($sql) {
		$record = $this->dbTable->selectFirst($sql);
		if ($record) {
			$this->loadFromRecord($record);
			$this->isNew = false;
			return true;
		} else {
			return false;
		}
	}
	/**
	 * @param array('field'=>'value') $array
	 * @return ActiveRecord
	 */
	public function loadByAssoc($array) {
		$sql = "select * from {$this->classDbTable} where ";
		$where = array();
		foreach ($array as $field => $value) {
			$where[] = "{$field} = :{$field}:";
		}
		$sql .= implode(" AND ", $where);
		
		
		
		$conn = DbFactory::getConnection();
		$q = $conn->newStatement($sql);
		
		foreach ($array as $field => $value) {
			$q->set($field, $value);
		}
		
		$record = $q->getFirstRecord();
		
		if ($record) {
			$this->loadFromRecord($record);
			$this->isNew = false;
			return true;
		} else {
			return false;
		}
	}

	public function findByCondition($sql = '', $order = '', $offset = 0, $limit = '') {
		$records = $this->dbTable->select($sql, $order, $offset, $limit);
		if ($records) {
			$className = get_class($this);
			foreach ($records as $record) {
				$object = new $className();
				$object->loadFromRecord($record);
				$object->isNew = false;
				$collection[] = $object;
			}
			return $collection;
		} else {
			return null;
		}
	}

	protected function _prepareDataToSave() {
		$result = array();
		foreach ($this->classProperties as $property => $options) {
			if ($this->dbTable->hasField($options['column'])) {
				$result[$options['column']] = $this->$property;
			}
		}

		if (is_array($this->manyToOne)) {
			foreach ($this->manyToOne as $property => $options) {
				if($this->$property){
					foreach ($this->$property as $propOne) {
						if (($propOne instanceof IActiveRecord) || ($propOne instanceof ProxyActiveRecord)) {
							$result[$options['foreign_key']] = $propOne->getId();
						} else {
							$result[$options['foreign_key']] = null;
						}
					}
				}
			}
		}

		if (is_array($this->oneToOne)&&(is_null($this->getId()))) {
			foreach ($this->oneToOne as $property => $options) {
				if ($options['dependent']) {
					if (($this->$property instanceof IActiveRecord) || ($this->$property instanceof ProxyActiveRecord)) {
						$result[$this->classProperties['id']['column']] = $this->$property->getId();
						$this->setId($this->$property->getId());
					}
				}

			}
		}

		return $result;
	}

	public function save() {
		if (!$this->isDirty()) {

			$data = $this->_prepareDataToSave();
			if ($this->isNew) {
				$idAlreadySetted = ( (int) ($this->getId()) > 0 );
				$new_id = $this->dbTable->insert($data);
				if (!$idAlreadySetted) {
					$this->setId($new_id);
				}
			} else {
				$this->dbTable->updateById($data, $this->getId());
			}
			$this->isNew = false;

			if (is_array($this->oneToOne)) {
				$this->saveOneToOne();
			}

			if (is_array($this->oneToMany)) {
				$this->saveOneToMany();
			}

			// remember current hash
			$this->setCurrentHash();
		}
		return $this->getId();
	}

	public function delete() {

		if($this->getId() && !$this->isNew && !$this->isDeleted) {
			$this->dbTable->deleteById($this->getId());
			$this->isNew = true;

			if (is_array($this->oneToOne)) {
				$this->deleteOneToOne();
			}

			if (is_array($this->oneToMany)) {
				$this->deleteOneToMany();
			}

			$this->isDeleted = true;
			return true;
		}
		return false;
	}

	protected function deleteOneToOne() {
		$id = $this->getId();
		foreach ($this->oneToOne as $property => $options) {
			if(($options['cascade_delete'])&&(is_object($this->$property))&&(!$options['dependent'])) {
				$this->$property->delete();
			}
		}

	}
	protected function deleteOneToMany() {
		$id = $this->getId();
		foreach ($this->oneToMany as $property => $options) {
			if(($options['cascade_delete'])&&(is_array($this->$property))) {
				foreach ($this->$property as $element) {
					$element->delete();
				}
			}
		}
	}

	protected function saveOneToOne() {

		foreach ($this->oneToOne as $property => $options) {
			if(($options['cascade_save'])&&(is_object($this->$property))&&(!$options['dependent'])) {
				$this->$property->setId($this->getId());
				$this->$property->save();
			}
		}
	}

	protected function saveOneToMany() {
		foreach ($this->oneToMany as $property => $options) {
			if(($options['cascade_save'])&&(is_array($this->$property))) {
				foreach ($this->$property as $element) {
					$element->save();
				}
			}
		}
	}

	public function isDirty() {
		return $this->getCurrentHash() == $this->getHash();
	}

	public function getHash() {
		return md5(serialize(clone $this));
	}


	public function getCurrentHash() {
		return $this->currentHash;
	}

	public function setCurrentHash() {
		$this->currentHash = $this->getHash();

	}
	
	/**
	 * countRecords
	 *
	 * @return int
	 */
	public function countRecords($where) {
		$result = $this->dbTable->getCountOfRecords($where);
		if (!$result) {
			$countRecord = 0;
		}
		else {
			$countRecord = $result['number'];
		}
		return $countRecord;
	}

}

