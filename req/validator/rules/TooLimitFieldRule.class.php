<?php

require_once("validator/rules/Rule.class.php");

class TooLimitFieldRule extends Rule  
{

	protected $min_size;
	protected $max_size;
	
	
	protected $errorMessage = array(
				'ru' => "Поле «{param}» должно быть от {param2} до {param3} символов",	
				'en' => "Field «{param}» shouldn't have size bigger than {param3} and smaller {param2} symbols",	
			); 			
	
	protected $assignMessage = array(
				'ru' => "поле должно быть от {param2} до {param3} символов",	
				'en' => "Field shouldn't have size bigger than {param3} and smaller {param2} symbols",	
			); 
	

	function TooLimitFieldRule($field, $min_size=0, $max_size, $name = '', $id = '') {
		parent::__construct($field,$name,$id);
		$this->min_size = $min_size;
		$this->max_size = $max_size;
		$this->param2 = $this->min_size;
		$this->param3 = $this->max_size;
	}	
	function checkError($formData) {
		if (isset($formData[$this->field]) && $formData[$this->field] != '' && (mb_strlen($formData[$this->field], "UTF-8") < $this->min_size || mb_strlen($formData[$this->field], "UTF-8") > $this->max_size)) {
			$this->valid = false;	
		}	
	}		
}

?>