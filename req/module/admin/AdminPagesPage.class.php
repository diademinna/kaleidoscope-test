<?php
require_once("module/FormPageModule.class.php");
require_once('validator/Validator.class.php');

class AdminPagesPage extends FormPageModule {
	
	public function doBeforeOutput() {
		$this->Authenticate();
		$this->template->assign("tinymce", 1);
	}
		
	public function doFormInit() {
		 		
		$id = $this->request->getValue("id");
		
		if (!empty($id)){
			$query = $this->conn->newStatement("SELECT * FROM pages WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate("admin/admin_pages.tpl"));
	}
		
	
	public function doFormValid() {
		$id = $this->request->getValue("id");
				
		if (!empty($id)) {
			$query = $this->conn->newStatement('UPDATE pages SET name=:name:, text=:text:, title=:title: WHERE id=:id:');
	        $query->setInteger('id', $id);
	        $query->setText('name',$this->formData['name']);
	        $query->setText('text',$this->formData['text']);
	        $query->setString('title',$this->formData['title']);
	        $query->execute();
		}
		
		$this->template->assign('data', $this->formData);
		$this->template->assign("errors", "Информация сохранена");
		
		$this->response->write($this->renderTemplate("admin/admin_pages.tpl"));
	}
	
	public function doFormInvalid() {
		$this->template->assign('data', $this->formData);		
		$this->response->write($this->renderTemplate("admin/admin_pages.tpl"));
	}
	
	public function doValidation() {	
		$rules = array(
			new EmptyFieldRule("name", "Название"),
			//new EmptyFieldRule("text", "Контент")
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