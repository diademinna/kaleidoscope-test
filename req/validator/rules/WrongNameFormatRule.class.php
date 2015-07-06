<?php

require_once("validator/rules/Rule.class.php");
	
class WrongNameFormatRule extends Rule  
{
	
	protected $errorMessage = array(
				'ru' => "Поле «{param}» должно содержать только буквы",	
				'en' => "Field «{param}» must contain letters only",
			); 
				
	protected $assignMessage = array(
				'ru' => "поле должно содержать только буквы",	
				'en' => "Field must contain letters only",
			); 

	function checkError($formData) {
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && !preg_match("/^([a-zа-яёЁА-ЯA-Z\-])+$/u",$formData[$this->field])) {
			$this->valid = false;	
		}	
	}		
}

?>