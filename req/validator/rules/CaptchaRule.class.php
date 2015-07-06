<?php
require_once("validator/rules/Rule.class.php");

class CaptchaRule extends Rule{

	protected $errorMessage = array(
				'ru' => "Неверный код подтверждения",
				'en' => "Field {param} is wrong",
			); 

	protected $assignMessage = array(
				'ru' => "неверный код подтверждения",
				'en' => "",
			); 
			
	function CaptchaRule($field, $id = '') {
		parent::__construct($field, '', $id);
		
	}

	function checkError($formData) {
		if (HttpSession::getInstance()->get('captcha_keystring') != $formData[$this->field] || empty($formData[$this->field])) {
			$this->valid = false;
		}
	}
}
?>