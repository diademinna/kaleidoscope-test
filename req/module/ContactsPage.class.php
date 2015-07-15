<?php

class ContactsPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}
	
	function doContent(){
		$query = $this->conn->newStatement("SELECT * FROM contacts");
		$query->setInteger('id', 1);
		$data_contacts = $query->getAllRecords();
		$this->template->assign('data_contacts', $data_contacts);
		
		$this->setPageTitle("Контакты");
		$this->response->write($this->renderTemplate('contacts.tpl'));
	}
}
?>