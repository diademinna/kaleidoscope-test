<?php

require_once("validator/rules/Rule.class.php");

class WrongSymbolRule extends Rule  
{

	protected $errorMessage = array(
				'ru' => "Поле состоит из недопустимых символов {param}",
				'en' => "Field {param} is empty",
			); 
				
	function checkError($formData) {
		if (!empty($formData[$this->field]) && !preg_match("/^([a-z0-9])+$/iu", $formData[$this->field])) {			
			$this->valid = false;	
		}	
	}		
}

?>