<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");

class AdminFaqsAddPage extends FormPageModule{
	
	var $page;
	var $get_param;

	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->template->assign("tinymce", 1);
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
		
	}
	
	public function doFormInit() {
		$action = $this->request->getValue('action');
		$id = $this->request->getValue('id');		
				
		if (!empty($id) AND $action == "edit") {
			$query = $this->conn->newStatement("SELECT * FROM faqs WHERE id=:id:");
			$query->setInteger("id", $id);
			$data = $query->getFirstRecord();
			
			if($data['date'] AND $data['date']!="0000-00-00"){ // преобразование даты
				$temp = explode("-", $data['date']);
				$data['date'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
			}
			
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_faqs_add.tpl'));
	}
  
	 
	public function doFormValid(){
		$action = $this->request->getValue("action");
		$id = $this->request->getValue('id');
		
		
		// преобразование даты
		if($this->formData["date"]){
			$temp = explode("-", $this->formData["date"]);
			$this->formData["date"] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
		}
		else{
			$this->formData["date"] = date('Y-m-d');  // берем текущую
		}
		
				
		if (!empty($id) AND $action == 'edit') {
			 $query = $this->conn->newStatement("UPDATE faqs SET fio=:fio:, question=:question:, answer=:answer:, email=:email:, date=:date: WHERE id=:id:");
			 $query->setInteger('id', $id); 
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM faqs");
			$pos = (int)$query_pos->getOneValue();
			if(!$pos){
				$pos = 1;
			} 
			
			$query = $this->conn->newStatement("INSERT INTO faqs SET fio=:fio:, question=:question:, answer=:answer:, email=:email:, date=:date:, pos=:pos:, active=:active:");
			$query->setInteger("pos", $pos);
			$query->setInteger('active', 1);
		}
		
		$query->setVarChar("fio", $this->request->getValue('fio'));
		$query->setVarChar("question", $this->request->getValue('question'));
		$query->setVarChar("answer", $this->request->getValue('answer'));
		$query->setVarChar("email", $this->request->getValue('email'));
		$query->setDate("date", $this->formData['date']);
		$query->execute();
		
		$this->response->redirect("/admin/faqs/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}	
	
	public function doFormInValid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate('admin/admin_faqs_add.tpl'));
	}
	
	function doValidation(){
		$rules = array(
			new EmptyFieldRule("question", 'Вопрос'),
			new EmptyFieldRule("answer", 'Ответ'),	
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