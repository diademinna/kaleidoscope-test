<?php

require_once("validator/rules/Rule.class.php");
	
class WrongFigureFormatRule extends Rule  
{
	
	protected $errorMessage = array(
				'ru' => "Поле «{param}» должно содержать только цифры",		
				'en' => "Field «{param}» must contain figures only",
			); 
				
	protected $assignMessage = array(
				'ru' => "должно содержать только цифры",
				'en' => "Field must contain figures only",
			); 

	function checkError($formData) {
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && !is_numeric($formData[$this->field])) {
			$this->valid = false;	
		}	
	}		
}

?>