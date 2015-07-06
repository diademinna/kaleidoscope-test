<?php

require_once('exception/ExceptionOutput.class.php');

class GeneralException extends Exception {
	
	protected $params;
	
	public function __construct($message, $code = 0, $params = array()) {
		parent::__construct($message, $code);
		$this->params = $params;
	}
	
	public function __toString() {
		$output = new ExceptionOutput($this);
		$output->setParams($this->params);
		return $output->getString();	
	}
	
}

