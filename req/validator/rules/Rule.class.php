<?php

class Rule 
{
	protected $errorId = '';
	protected $field;
	protected $param;
	protected $param2;
	protected $param3;
	protected $valid;
	
	function Rule($field, $name = '', $id = '') {
		$this->errorId = $id;
		$this->field = $field;
		if ($name === '') $name = $field;
		$this->param = $name;
		$this->valid = true;
	}

	function checkError() {

	}	
	
	function getMessage($lang = 'ru') {
		$errorText = $this->errorMessage[$lang];
		if ($this->param != '') $errorText = str_replace('{param}', $this->param, $errorText);
		if ($this->param2 != '') $errorText = str_replace('{param2}', $this->param2, $errorText);
		if ($this->param3 != '') $errorText = str_replace('{param3}', $this->param3, $errorText);
		return $errorText;
	}	
	
	function getAssignMessage($lang = 'ru') {
		$errorText = $this->assignMessage[$lang];
		if ($this->param != '') $errorText = str_replace('{param}', $this->param, $errorText);
		if ($this->param2 != '') $errorText = str_replace('{param2}', $this->param2, $errorText);
		if ($this->param3 != '') $errorText = str_replace('{param3}', $this->param3, $errorText);
		return $errorText;
	}	
	
	function isValid() {
		return $this->valid;
	}
	
	function getErrorId() {
		return $this->errorId;
	}
}
?>