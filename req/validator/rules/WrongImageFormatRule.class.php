<?php

require_once("validator/rules/Rule.class.php");

class WrongImageFormatRule extends Rule  
{

	protected $format;
	protected $errorMessage = array(
				'ru' => "Неправильный формат изображения{param}(допустимые форматы: {param2})",	
				'en' => "Wrong image{param}format (alllowed formats: {param2})",	
			);
	
	protected $assignMessage = array(
				'ru' => "неправильный формат изображения (допустимые форматы {param2})",	
				'en' => "Wrong image format (alllowed formats: {param2})",	
			); 

	function WrongImageFormatRule($field, $format = 'jpeg', $name = '', $id = '') {
		parent::__construct($field, $name,$id);
		$this->format = $format;
	}
	
	function checkError($formData) {
		if (!empty($_FILES[$this->field]['tmp_name'])) {
			if (is_array($this->format)) {
				$param2 = '';			
				$num = 0;
				$this->valid = false;
				foreach ($this->format as $format) {
					if ($_FILES[$this->field]['type']=="image/" . $format || ($format == "jpeg" && $_FILES[$this->field]['type'] == "image/p" . $format)) $this->valid = true;
					if ($num+1<count($this->format)) $param2 .= $format . ", ";
					else $param2 .= $format;
					$num++;
				}
				$this->param2 = $param2;
			}
			else {
				if ($_FILES[$this->field]['type']!="image/" . $this->format)
				if ($this->format != "jpeg" || ($this->format == "jpeg" && $_FILES[$this->field]['type'] != "image/p" . $this->format)) {
					$this->param2 = $this->format;
					$this->valid = false;						
				}
			}
		}
		if ($this->param == $this->field) $this->param = " "; else $this->param = " '".$this->param."' ";
	}		
}

?>