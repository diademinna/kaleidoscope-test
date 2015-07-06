<?php
class AdminPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
	}

	function doContent()	{
		$this->response->write($this->renderTemplate('admin/index.tpl'));
	}

}

?>