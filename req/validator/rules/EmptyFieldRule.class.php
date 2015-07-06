<?php

require_once("validator/rules/Rule.class.php");

class EmptyFieldRule extends Rule  
{

	protected $errorMessage = array(
				'ru' => "Не заполнено поле «{param}»",
				'en' => "Field «{param}» is empty",
			); 

	protected $assignMessage = array(
				'ru' => "обязательное!",
				'en' => "Field is empty",
			);

	function checkError($formData) {
		if (!isset($formData[$this->field]) || $formData[$this->field] === '') {				
			$this->valid = false;	
		}	
	}		
}

?>