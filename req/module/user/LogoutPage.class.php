<?php
require_once("module/AbstractPageModule.class.php");

class LogoutPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}	
	
	function doContent() {
		UserAction::logout();
		$this->response->redirect(HTTP_REFERER);
	}
}