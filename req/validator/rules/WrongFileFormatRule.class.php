<?php

require_once("validator/rules/Rule.class.php");

class WrongFileFormatRule extends Rule  
{

	protected $format;
	protected $errorMessage = array(
				'ru' => "Неправильный формат файла{param}(допустимые форматы: {param2})",	
				'en' => "Wrong file{param}format (alllowed formats: {param2})",	
			);
	
	protected $assignMessage = array(
				'ru' => "неправильный формат файла (допустимые форматы {param2})",	
				'en' => "Wrong ашду format (alllowed formats: {param2})",	
			); 

	function WrongFileFormatRule($field, $format = 'jpeg', $name = '', $id = '') {
		parent::__construct($field, $name,$id);
		$this->format = $format;
	}
	
	function checkError($formData) {
		if (!empty($_FILES[$this->field]['tmp_name'])) {
			if (is_array($this->format)) {
				$param2 = '';			
				$num = 0;
				$this->valid = false;
				$filename = explode(".", $_FILES[$this->field]['name']);
				$type = $filename[sizeof($filename) - 1];
				foreach ($this->format as $format) {
					if ($type==$format) $this->valid = true;
					if ($num+1<count($this->format)) $param2 .= $format . ", ";
					else $param2 .= $format;
					$num++;
				}
				$this->param2 = $param2;
			}
//			else {
//				if ($_FILES[$this->field]['type']!="image/" . $this->format)
//				if ($this->format != "jpeg" || ($this->format == "jpeg" && $_FILES[$this->field]['type'] != "image/p" . $this->format)) {
//					$this->param2 = $this->format;
//					$this->valid = false;						
//				}
//			}
		}
		if ($this->param == $this->field) $this->param = " "; else $this->param = " '".$this->param."' ";
	}		
}

?>