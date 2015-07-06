<?php

require_once('db/DbConfig.class.php');
require_once('exception/GeneralException.class.php');

// field types
define('DB_STRING_TYPE',    'string');
define('DB_TEXT_TYPE',      'text');
define('DB_INTEGER_TYPE',   'integer');
define('DB_FLOAT_TYPE',     'float');
define('DB_BOOLEAN_TYPE',   'boolean');
define('DB_DATE_TYPE',      'date');
define('DB_TIME_TYPE',      'time');
define('DB_DATETIME_TYPE',  'datetime');
define('DB_TIMESTAMP_TYPE', 'timestamp');
define('DB_BLOB_TYPE',      'blob');

class DbFactory {

	protected $defaultConnection;

	protected $connections;

	/**
   * @static 
   *
   * @return unknown
   */
	static function getInstance() {

		if (!isset($GLOBALS['DbFactoryInstance'])) {
			$instance = new DbFactory();
			$GLOBALS['DbFactoryInstance'] = $instance;
		} else {
			$instance = $GLOBALS['DbFactoryInstance'];
		}

		return $instance;
	}

	static function setDefaultConnection($connection) {
		$instance = DbFactory::getInstance();
		$instance->defaultConnection = $connection;
	}

	function createConnection($cs) {
		if (!class_exists('DbConfig')) {
			include_once('db/DbConfig.class.php');
		}

		$config = new DbConfig($cs);

		$driver = $config->getDriver();
		$className = $driver . 'Connection';

		include_once('db/drivers/' . strtolower($driver) . '/' . $className . '.class.php');

		return new $className($config);
	}

	/**
   * Get connection
   *
   * @param string $cs
   * @return DbConnection
   */
	static public function getConnection($cs = DEFAULT_CONNECTION) {

		$instance = DbFactory::getInstance();

		if (empty($cs)) {
			$cs = $instance->defaultConnection;
			if ($instance->defaultConnection == null) {
				throw new GeneralException('Default connection not defined');
			}
		}


		if (!isset($instance->connections[$cs])) {
			$instance->connections[$cs] = $instance->createConnection($cs);
			$instance->connections[$cs]->connect();
		}

		return $instance->connections[$cs];
	}

}