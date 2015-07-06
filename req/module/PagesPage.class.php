<?php
require_once("module/AbstractPageModule.class.php");

class PagesPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->doInit();
	}
	
	function doContent(){
		$id = $this->request->getValue('id');
		
		$query = $this->conn->newStatement("SELECT * FROM pages WHERE id=:id:");
		$query->setInteger('id', $id);
		$data = $query->getFirstRecord();
		$this->template->assign('data', $data);

		$this->setPageTitle("{$data['title']}");
		$this->response->write($this->renderTemplate('pages.tpl'));
	}
}
?>