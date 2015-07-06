<?php
$dir = "req/validator/rules/";
$dh = opendir($dir);
while($file = readdir($dh)) {
	if ($file!="." && $file!=".." && $file!=".svn" && $file!="Rule.class.php") require_once($dir.$file);
}

class Validator
{
	protected $formData;
	protected $lang;
	protected $valid;
	protected $errorList;
	protected $rules = NULL;

 	function Validator ($formData, $lang = 'ru') {
		$this->formData = $formData;
		$this->lang = $lang;
		$this->valid = true;
		$this->errorList = array();
	}

	function  validate ($rules) {
		foreach ($rules as $rule) {
			$rule->checkError($this->formData);
			if (!$rule->isValid()) {
				$this->errorList[] = $rule->getMessage($this->lang); 
				$this->valid = false;
			}
		}
		$this->rules = $rules;
		return $this->valid;
	}
	
	function getErrorList () {
		return $this->errorList;
	}

	function assignErrors ($template) {
		if ($this->rules != NULL) {
			foreach ($this->rules as $rule) {
				if (!$rule->isValid() && $rule->getErrorId() != '') {
					$template->assign($rule->getErrorId(), $rule->getAssignMessage($this->lang));
				}
			}
		}
	}

} 
?>