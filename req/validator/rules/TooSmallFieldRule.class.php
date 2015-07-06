<?php

require_once("validator/rules/Rule.class.php");

class TooSmallFieldRule extends Rule  
{

	protected $size;
	protected $errorMessage = array(
				'ru' => "Поле {param} не должно быть меньше {param2} символов",	
				'en' => "Field {param} shouldn't have size smaller than {param2} symbols",	
			); 			
	
	protected $assignMessage = array(
				'ru' => "поле не должно быть меньше {param2} символов",	
				'en' => "Field shouldn't have size smaller than {param2} symbols",	
			); 
	
	function TooSmallFieldRule($field, $size, $name = '', $id = '') {
		parent::__construct($field,$name,$id);
		$this->size = $size;
	}	
	function checkError($formData) {
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && mb_strlen($formData[$this->field], 'UTF-8') < $this->size) {
			$this->param2 = $this->size;
			$this->valid = false;	
		}	
	}		
}

?>