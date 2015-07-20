<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once("util/ImageUtil.class.php");

class AdminUserAddPage extends FormPageModule {
	function doBeforeOutput(){
		$this->Authenticate();
		
		//$this->template->assign('tinymce', 1);
		
		$conn = &DbFactory::getConnection();		
	}

	function doFormInit(){
		$action = $this->request->getValue("action");
		$this->template->assign('action', $action);
		
		$page = $this->request->getValue ('page');
		$this->template->assign('page', $page);
		
		if ($action == 'edit') {
			$id = $this->request->getValue('id');
			
			$conn = &DbFactory::getConnection();
			$query = $conn->newStatement("SELECT * FROM user WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_user_add.tpl'));
	}

	function doFormInValid(){		
//		$page = $this->request->getValue ('page');
//		$this->template->assign('page', $page);

		$action = $this->request->getValue("action");
		$this->template->assign('action', $action);
		
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate('admin/admin_user_add.tpl'));
	}

	function doFormValid(){
		$conn = &DbFactory::getConnection();
		
		// формеруем параметры get чтобы не потерять их при редиректе.
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		
		$action = $this->request->getValue("action");
		$id = $this->request->getValue('id');
		
		$page = $this->request->getValue ('page');
		
		if ($action == 'edit') { // редактирование
			$to_db ="";
			$new_pass = $this->formData['new_password'];
			if($new_pass){
				$new_pass = md5($new_pass);
				$to_db = "password='{$new_pass}',";
			}
			
			$query = $conn->newStatement("UPDATE user SET login=:login:, {$to_db} email=:email:, level=:level:, name=:name:,  city=:city:, address=:address:, date=:date:, activate=:activate:  WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{ // добавление
			$query = $conn->newStatement("INSERT INTO user SET login=:login:, password=:password:, email=:email:, level=:level:, name=:name:, city=:city:,  address=:address:, date=now(), activate=1");
			$query->setVarChar("password", md5($this->formData["password"]));
			
		}
		
				
		$query->setVarChar("login", $this->formData["login"]);
		$query->setVarChar("email", $this->formData["email"]);
		$query->setInteger("level", $this->formData["level"]);
		$query->setVarChar("name", $this->formData["name"]);
		$query->setVarChar("city", $this->formData["city"]);
		$query->setVarChar("address", $this->formData["address"]);
		$query->setDateTime("date", $this->formData["date"]);
        $query->setInteger("activate", $this->formData['activate']?1:0);
		$query->execute();		
		
        
		$this->response->redirect("/admin/user/list/{$page}/".($get_param?$get_param:"") );
	}

	function doValidation() {
	
		$conn = &DbFactory::getConnection();
        
        $validator = new Validator($this->formData);
        $rules = array(
            new EmptyFieldRule("login","Логин"),
            new EmptyFieldRule("email","Эл. почта"),
            new WrongEmailFormatRule("email","Эл. почта")
        );

        $validator->validate($rules);
        if ($errors = $validator->getErrorList()) {
            $this->template->assign("errors", $errors);
            return false;
        }
        else {
        	if($this->formData['action'] == 'edit'){
        		if(UserAction::checkEmailBusy($this->formData['email']) AND UserAction::checkEmailBusy($this->formData['email']) != $this->formData['id'] ){
	        		$errors[] = "Пользователь с таким адресом эл. почты уже есть в базе";
	        		$this->template->assign("errors", $errors);
	        		return false;
	        	}
	        	elseif (UserAction::checkLoginBusy($this->formData['login']) AND UserAction::checkLoginBusy($this->formData['login']) != $this->formData['id'] ){
	        		$errors[] = "Пользователь с таким логином уже есть в базе";
	        		$this->template->assign("errors", $errors);
	        		return false;
	        	}
        	}
        	else{  // добавление закрыто!!!! не должен заходить сюда
        		if(UserAction::checkEmailBusy($this->formData['email']) ){
	        		$errors[] = "Пользователь с таким адресом эл. почты уже есть в базе";
	        		$this->template->assign("errors", $errors);
	        		return false;
	        	}
	        	elseif (UserAction::checkLoginBusy($this->formData['login'])){
	        		$errors[] = "Пользователь с таким логином уже есть в базе";
	        		$this->template->assign("errors", $errors);
	        		return false;
	        	}
        	}
        	
        }
        return true;
        
	}
}

?>