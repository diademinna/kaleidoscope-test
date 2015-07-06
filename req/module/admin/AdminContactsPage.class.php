<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");

class AdminContactsPage extends FormPageModule {	
	
	public function doBeforeOutput() {
		$this->Authenticate();		
		$this->template->assign("tinymce", 1);
	}
		
	public function doFormInit(){
		
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM contacts WHERE id=1");
		$data = $query->getFirstRecord();
		$this->template->assign('data', $data);
		
		$this->response->write($this->renderTemplate('admin/admin_contacts.tpl'));
	}
	
	
	public function doFormValid(){
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		$conn = &DbFactory::getConnection();
		
		$query = $conn->newStatement("UPDATE contacts SET name=:name:, description=:description:, title=:title:, latitude=:latitude:, longitude=:longitude:, name_on_map=:name_on_map: WHERE id=1");
		
		$query->setText('name', $this->formData['name']);
		$query->setText('description', $this->formData['description']);
		$query->setText('title', $this->formData['title']);
		$query->setVarChar('latitude', $this->formData['latitude']);
		$query->setVarChar('longitude', $this->formData['longitude']);
		$query->setText('name_on_map', $this->formData['name_on_map']);
		$query->execute();

	    $this->template->assign("notice", "Информация была успешно сохранена");
	    
		$this->response->redirect("/admin/contacts/");
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_contacts.tpl"));
	}
	
	
	function doValidation(){
		$rules = array(
			//new EmptyFieldRule("name", 'Название'),
		);
		
		$validator = new Validator($this->formData);
		
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else return true;
	}
	
}
?>