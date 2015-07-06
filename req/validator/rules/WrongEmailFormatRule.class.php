<?php

require_once("validator/rules/Rule.class.php");
	
class WrongEmailFormatRule extends Rule  
{
	
	protected $errorMessage = array(
				'ru' => "Неправильный формат E-mail",
				'en' => "Wrong E-mail format",
				);
				
	protected $assignMessage = array(
				'ru' => "неправильный формат",
				'en' => "Wrong E-mail format",
			); 

	function WrongEmailFormatRule($field, $id = '') {
		parent::__construct($field, '', $id);
		
	}

	function checkError($formData) {
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && !preg_match("/^[a-zA-Z0-9][\w\.-]*@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/",$formData[$this->field])) {
			$this->valid = false;	
		}
	}		
}

?>