<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");

class AdminContentAddPage extends FormPageModule {	
	
	public function doBeforeOutput() {	
		$this->Authenticate();
		$this->template->assign("tinymce", 1);
	}
	
	
	public function doFormInit() {
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		if (!empty($action) && $action == "edit" && !empty($id)) {
			
			$conn = &DbFactory::getConnection();
			$query = $conn->newStatement("SELECT * FROM content WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
			
			$this->template->assign("id", $id);
			$this->template->assign("action", $action);
		}
		
		$this->response->write($this->renderTemplate("admin/admin_content_add.tpl"));
	}	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		$conn = &DbFactory::getConnection();
		
        	
		if (!empty($action) && $action == "edit" && !empty($id)) {
			$query = $conn->newStatement('UPDATE content SET name=:name:, text=:text:, title=:title:, url=:url: WHERE id=:id:');
	        $query->setInteger('id', $id);
		}
		else{
			$query = $conn->newStatement('INSERT INTO content SET name=:name:, text=:text:, title=:title:, url=:url:');		
		}
		
		$query->setText('name',$this->formData['name']);
        $query->setText('text',$this->formData['text']);
        $query->setVarChar('title',$this->formData['title']);
        $query->setVarChar('url',$this->formData['url']);
		$query->execute();
		
		$this->response->redirect("/admin/content/list/");
	}
	
	public function doFormInvalid() {
		$this->template->assign("id", $this->request->getValue("id"));
		$this->template->assign("action", $this->request->getValue("action"));
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_content_add.tpl"));
	}
	
	public function doValidation() {
		$validator = new Validator($this->formData);
		
		$validator->validate(array(
			new EmptyFieldRule("name", "Название"),
			new EmptyFieldRule("text", "Контент"),
			new EmptyFieldRule("url", "URL")
		));
		
		$errors = $validator->getErrorList();		
		
		// Проверка уже занятого урла!
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM content WHERE url=:url: AND id!=:id:");
		$query->setVarChar('url', $this->formData['url']);
		$query->setInteger('id', $this->formData['id']);
		$data_temp = $query->getFirstRecord();
		if($data_temp){
			$errors[] = "Такой URL (путь) уже есть в списке."; 
		}
		
		// возращаем результат
		if (!$errors) {
			return true;
		}
		else {
			$this->template->assign("errors", $errors);
			return false;
		}
	}
	
}
?>