<?php

class FormPageModule extends AbstractPageModule {
		
	var $formData = array();
	var $formVar = 'form';
	
	var $tplName = ''; 
	
	function doContent() {
		// every form _must_ have submitted hidden field  
		$isFormSubmitted =& $this->request->getValue('submitted');
			$this->formData = $this->request->export();
		if (isset($isFormSubmitted) && $isFormSubmitted) {
	
			if ($this->doValidation()) {
				$this->doFormValid();				
			} else {
				$this->doFormInvalid();
			}
			
		} else {
			$this->doFormInit();
		}
		$this->template->assign($this->formVar, $this->formData);
		if (!empty($this->tplName)) {
		  $this->response->write($this->template->fetch($this->tplName));
		}
	}
	   
	function doFormInit() {
		// 
	}
	
	function doFormInvalid() {
		//
	}
	
	function doFormValid() {
		//
	}
	
	function doValidation() {
		return true;
	}
	
	function setTplName($tplName) {
		$this->tplName = $tplName;		
	}

}
