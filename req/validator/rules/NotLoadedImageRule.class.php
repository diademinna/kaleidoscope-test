<?php

require_once("validator/rules/Rule.class.php");

class NotLoadedImageRule extends Rule  
{
	
	protected $errorMessage = array(
				'ru' => "Изображение{param}не указано",		
				'en' => "Image{param}isn't shown",
			); 
				
	protected $assignMessage = array(
				'ru' => "изображение не указано",
				'en' => "Image isn't shown",
			); 

	function checkError($formData) {
		if (empty($formData[$this->field]['tmp_name'])) {
			$this->valid = false;	
			if ($this->param == $this->field) $this->param = " "; else $this->param = " '".$this->param."' ";					
		}	
	}		
}

?>