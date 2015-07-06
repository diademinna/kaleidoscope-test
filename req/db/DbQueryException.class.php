<?php

require_once('exception/ExceptionOutput.class.php');

class DbQueryException extends Exception {
	
	protected $msg;
	protected $tplFile;
	protected $tplLine; 
	
	function __construct($msg, $tplFile = null, $tplLine = null) {
		$this->msg = $msg;
		$this->tplFile  = $tplFile;
		$this->tplLine = $tplLine;
		parent::__construct($msg);		
	}
		
	public function __toString() {
		$output = new ExceptionOutput($this);
		$output->setTitle('Database Query Exception');
		$output->setFile($this->tplFile);	
		$output->setLine($this->tplLine);
		return $output->getString();
	}
}
