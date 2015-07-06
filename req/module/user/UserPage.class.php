<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once("util/ImageUtil.class.php");

class UserPage extends FormPageModule {
	function doBeforeOutput(){
		$this->doInit();
		$rand_new = rand(1, 100000);
		$this->template->assign('rand_new', $rand_new);
	}

	function doFormInit(){
		
		$id = $this->request->getValue("id");
		
		if ($this->user['id'] == $id) { // если ID в URLe тотже что залогинет
			$conn = &DbFactory::getConnection();
			$query = $conn->newStatement("SELECT * FROM user WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			if($data['dob'] AND $data['dob']!="0000-00-00"){
				$temp = explode("-", $data['dob']);
				$data['dob'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
			}
			
			$this->template->assign('data', $data);
			
			$this->response->write($this->renderTemplate('user/user.tpl'));
		}
		else{
			$this->response->redirect("/");
		}
	}

	function doFormInValid(){		
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate('user/user.tpl'));
	}

	function doFormValid(){
		//$action = $this->request->getValue("action");
		$id = $this->request->getValue('id');
		
		$conn = &DbFactory::getConnection();

			
		$query = $conn->newStatement("UPDATE user SET name=:name:, last_name=:last_name:, email=:email:,  city=:city:, address=:address:, phone=:phone:, name_company=:name_company:, login=:login: WHERE id=:id:");
	    $query->setInteger('id', $id);
		$query->setVarChar('name',$this->formData['name']);
		$query->setVarChar('last_name',$this->formData['last_name']);
		$query->setVarChar('name_company',$this->formData['name_company']);
		$query->setVarChar('login',$this->formData['email']);
		$query->setVarChar('email',$this->formData['email']);
		$query->setVarChar("city", $this->formData["city"]);
		$query->setVarChar("address", $this->formData["address"]);
		$query->setVarChar("phone", $this->formData["phone"]);
                $query->execute();
		
		
		$this->response->redirect("/user/{$id}/?note=save");
	}

	function doValidation() {
		// пользователь может сменить email надо проверить нет ли такого в базе!!!!
		$conn = &DbFactory::getConnection();
       
		$validator = new Validator($this->formData);
		$rules = array(
			new EmptyFieldRule("email", "Эл. почта"),
                        new WrongEmailFormatRule("email", "Эл. почта"),
			new EmptyFieldRule("name", "Имя"),
			new EmptyFieldRule("city", "Город / населенный пункт")
			
		);

		$validator->validate($rules);
		if ($errors = $validator->getErrorList()) {
			$this->template->assign("errors", $errors);
			return false;
		}
		else {
			$id_user_same_email = UserAction::checkEmailBusy($this->formData['email']);
						
			if($id_user_same_email AND ($id_user_same_email != $this->user['id']) ){ // надо проверить не его ли это email!
				$errors[] = "Пользователь с таким адресом эл. почты уже есть в базе";
				$this->template->assign("errors", $errors);
				return false;
			}
		}        
        return true;
	}
}

?>