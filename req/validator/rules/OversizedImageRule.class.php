<?php

require_once("validator/rules/Rule.class.php");

class OversizedImageRule extends Rule  
{

	protected $size;
	protected $errorMessage = array(
				'ru' => "Размер изображения {param} не должен превышать {param2} байт",
				'en' => "Image {param} size shouldn't be over {param2} byte",	
			); 
	protected $assignMessage = array(
				'ru' => "размер изображения не должен превышать {param2} байт",
				'en' => "image {param} size shouldn't be over {param2} byte",	
			); 
	function OversizedImageRule($field, $size, $name = '', $id = '') {
		parent::__construct($field, $name,$id);
		$this->size = $size;	
	}	
	function checkError($formData) {
		if (!empty($formData[$this->field]['tmp_name']) && $formData[$this->field]['size'] > $this->size) {
			if ($this->size > 1024) {
				$this->size = $this->size / 1024;
				$this->errorMessage['ru'] = str_replace("{param2} ", "{param2} К", $this->errorMessage['ru']);
				$this->errorMessage['en'] = str_replace("{param2} ", "{param2} K", $this->errorMessage['en']);
				$this->assignMessage['ru'] = str_replace("{param2} ", "{param2} К", $this->assignMessage['ru']);
				$this->assignMessage['en'] = str_replace("{param2} ", "{param2} K", $this->assignMessage['en']);
			}
			$this->param2 = $this->size;
			if ($this->param == $this->field) $this->param = " "; else $this->param = " '".$this->param."' ";			
			$this->valid = false;	
		}	
	}		
}

?>