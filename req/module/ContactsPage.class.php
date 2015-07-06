<?php

class ContactsPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}
	
	function doContent(){
		$query = $this->conn->newStatement("SELECT * FROM contacts WHERE id=:id:");
		$query->setInteger('id', 1);
		$data_contacts = $query->getFirstRecord();
		$this->template->assign('data_contacts', $data_contacts);
		
		$this->setPageTitle("{$data_contacts['title']}");
		$this->response->write($this->renderTemplate('contacts.tpl'));
	}
}
?>