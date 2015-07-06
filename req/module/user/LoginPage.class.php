<?php
require_once("module/FormPageModule.class.php");

class LoginPage extends FormPageModule {
	var $user;
	
	function doBeforeOutput() {
		$this->doInit();
		if($this->user) {
			$this->response->redirect('/');
		}
	}
	
	
	function doFormInit() {
		$this->response->write($this->renderTemplate('user/login.tpl'));
	}
	function doFormInvalid() {
		$this->template->assign('data', $this->formData);		
		$this->response->write($this->renderTemplate('user/login.tpl'));
	}
	function doFormValid() {
		UserAction::login($this->user);
		$this->response->redirect(HTTP_REFERER);
	}
	
	function doValidation() {
		require_once("validator/Validator.class.php");
		$rules = array(
			//new EmptyFieldRule("login", 'Логин'),
			//new EmptyFieldRule("password", 'Пароли'),
		);
		$validator = new Validator($this->formData);
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else {
			$conn = &DbFactory::getConnection();
			$this->formData['password'] = md5($this->formData['password']);
			
			//			if (UserAction::checkActivateUser($this->formData)) {
			//				$errors['text'] = "Неверный Пароль или Логин";
			//				$this->template->assign('errors', $errors);
			//				return false;
			//			}

			$this->user = UserAction::checkLogin($this->formData);
			if($this->user == "no_activate"){
				$errors['text'] = "Ваш аккаунт не подтвержден.";
				$this->template->assign('errors', $errors);
				return false;
			}
			elseif (!$this->user){
				$errors['text'] = "Неверный Пароль или Логин";
				$this->template->assign('errors', $errors);
				return false;
			}
			
			return true;
		}
	}
	
}
