<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminVacancyAddPage extends FormPageModule {	
	
	var $page;
	var $get_param;
	
	public function doBeforeOutput() {
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		if (!empty($id) AND $action == "edit"){
			$conn =& DbFactory::getConnection();
			$query = $conn->newStatement("SELECT * FROM vacancy WHERE id={$id}");
			$data = $query->getFirstRecord();
			
			if($data['date'] AND $data['date']!="0000-00-00"){ // преобразование даты
				$temp = explode("-", $data['date']);
				$data['date'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
			}
			
			$this->template->assign('data', $data);
		}
		$this->response->write($this->renderTemplate('admin/admin_vacancy_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
			
		$conn = &DbFactory::getConnection();
		
		// преобразование даты
		if($this->formData["date"]){
			$temp = explode("-", $this->formData["date"]);
			$this->formData["date"] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
		}
		else{
			$this->formData["date"] = date('Y-m-d');  // берем текущую
		}
		
        	
		if (!empty($id) && $action == "edit"){
			$query = $conn->newStatement("UPDATE vacancy SET name=:name:, text=:text:, date=:date: WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{
			$query_pos = $conn->newStatement("SELECT MAX(pos)+1 FROM vacancy");
			$pos = (int)$query_pos->getOneValue();
			if(!$pos){
				$pos = 1;
			}
			
			$query = $conn->newStatement("INSERT INTO vacancy SET name=:name:, text=:text:, date=:date:, pos=:pos:, active=:active:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos);
		}
		
		$query->setVarChar('name', $this->formData['name']);
		$query->setText('text', $this->formData['text']);
		$query->setDate('date', $this->formData['date']);
		$query->execute();
		
		
		$this->response->redirect("/admin/vacancy/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_vacancy_add.tpl"));
	}
	
	
	function doValidation(){
		$rules = array(
			new EmptyFieldRule("name", 'Название'),
		);
		
		$validator = new Validator($this->formData);
		
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else return true;
	}
	
	
	
	//*** DEVELOPER AJAX ***//
	
	// Удалить картинку из выбранного элемента
	function deleteImage($page, $id, $get_param){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM vacancy WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/vacancy/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/vacancy/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE vacancy SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->redirect("/admin/vacancy/add/{$page}/edit/{$id}/".($get_param?$get_param:"") );
		
		return $xajax;
	}
	
}

?>