<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');

class AdminBlogCommentAddPage extends FormPageModule {
	function doBeforeOutput(){
		$this->Authenticate();		
	}
	
	function doFormInit(){
		$action = $this->request->getValue("action");
		$this->template->assign('action', $action);
		
		$page = $this->request->getValue ('page');
		$this->template->assign('page', $page);
		
		if ($action == 'edit'){
			$id = $this->request->getValue('id');
			
			$query = $this->conn->newStatement("SELECT * FROM blog_comment WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_blog_comment_add.tpl'));
	}

	function doFormInValid(){		
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate('admin/admin_blog_comment_add.tpl'));
	}

	function doFormValid(){		
		// формируем параметры get чтобы не потерять их при редиректе.		
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
			
			$query = $this->conn->newStatement("
				UPDATE blog_comment SET 
					name=:name:, 
					text=:text:,
					date=:date:
				WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{ // добавление
			$query = $this->conn->newStatement("
				INSERT INTO blog_comment SET 
					name=:name:, 
					text=:text:,
					date=now()
			");
		}
		
		$query->setVarChar("name", $this->formData["name"]);
		$query->setText("text", $this->formData["text"]);
		$query->setDateTime("date", $this->formData["date"]);
		$query->execute();		
		        
		$this->response->redirect("/admin/blog_comment/list/{$page}/".($get_param?$get_param:"") );
	}

	function doValidation(){
        $validator = new Validator($this->formData);
        $rules = array(
            new EmptyFieldRule("text", "Комментарий")
        );

        $validator->validate($rules);
        if ($errors = $validator->getErrorList()) {
            $this->template->assign("errors", $errors);
            return false;
        }
        else return true;
	}
}

?>