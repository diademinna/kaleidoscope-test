<?php
class AdminHelpPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
	}

	function doContent()	{
		$this->response->write($this->renderTemplate('admin/admin_help.tpl'));
	}

}
?>