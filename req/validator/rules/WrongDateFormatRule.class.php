<?php

require_once("validator/rules/Rule.class.php");
	
class WrongDateFormatRule extends Rule  
{

	protected $errorMessage = array(
				'ru' => "Неправильный формат даты у поля «{param}» [YYYY-MM-DD]",
				'en' => "Field «{param}» has wrong date format",
			); 
				
	protected $assignMessage = array(
				'ru' => "неправильный формат",	
				'en' => "Field has wrong date format",
			); 

	function WrongDateFormatRule($field, $name='', $id = '') {
		parent::__construct($field, $name, $id);
		
	}

	function checkError($formData) {
		$date = explode('-', $formData[$this->field]);
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && (preg_match("/[0-9]+-[0-9]+-[0-9]+/",$formData[$this->field]) && !checkdate($date[1], $date[2], $date[0]) || !preg_match("/[0-9]+-[0-9]+-[0-9]+/",$formData[$this->field]))) {
			$this->valid = false;	
		}	
	}		
}

?>