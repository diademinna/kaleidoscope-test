<?php

require_once("validator/rules/Rule.class.php");
	
class WrongPhoneFormatRule extends Rule  
{
	
	protected $errorMessage = array(
				'ru' => "Неправильный формат телефонного номера",		
				'en' => "Wrong phone number format",
			); 
				
	protected $assignMessage = array(
				'ru' => "неправильный формат",		
				'en' => "Wrong phone number format",
			); 

	function WrongPhoneFormatRule($field, $id = '') {
		parent::__construct($field, '', $id);
		
	}

	function checkError($formData) {
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && !preg_match("/^\+?[0-9()-]*$/",$formData[$this->field])) {
			$this->valid = false;	
		}	
	}		
}

?>