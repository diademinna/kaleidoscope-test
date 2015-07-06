<?php

require_once("validator/rules/Rule.class.php");

class FieldsIsNotMatchRule extends Rule  
{

	protected $field2;
	protected $errorMessage = array(
				'ru' => "Значение поля «{param}» не совпадает со значением поля «{param2}»",	
				'en' => "Field «{param}» is not match field «{param2}»",	
			); 	
	
	protected $assignMessage = array(
				'ru' => "значение поля {param} не совпадает со значением поля {param2}",	
				'en' => "Field {param} is not match field {param2}",	
			); 

	function FieldsIsNotMatchRule($field, $field2, $name = '', $name2 = '', $id = '') {
		parent::__construct($field, $name, $id);
		$this->field2 = $field2;		
		$this->valid = true;
		$this->param2 = $name2;				
	}

	function checkError($formData) {
		if ($formData[$this->field] != $formData[$this->field2]) {
				$this->valid = false;	
		}	
	}		
}

?>