<?php

require_once("validator/rules/Rule.class.php");

class GooglemapRule extends Rule  
{

	protected $field2;

	protected $errorMessage = array(
				'ru' => "Необходимо отметить {param} на карте",
				'en' => "",
			); 

	function GooglemapRule($field, $field2, $name = '') {
		parent::__construct($field,$name);
		$this->field2 = $field2;		
		$this->valid = true;
	}	

	function checkError($formData) {
		if (!$formData[$this->field] || !$formData[$this->field2] || abs($formData[$this->field]) > 180 || abs($formData[$this->field2]) > 180) {				
			$this->valid = false;	
		}	
	}		
}

?>