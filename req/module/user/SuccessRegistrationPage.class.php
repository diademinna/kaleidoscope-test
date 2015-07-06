<?php
require_once("module/AbstractPageModule.class.php");

class SuccessRegistrationPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}
	
    function  doContent() {
        $this->response->write($this->renderTemplate('user/success_registration.tpl'));
    }
}