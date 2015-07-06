<?php
require_once("module/FormPageModule.class.php");
require_once('validator/Validator.class.php');

class ChangePasswordPage extends FormPageModule {

    function doBeforeOutput() {
		$this->doInit();
        if (!$this->user) {
        	$this->response->redirect("/");
        }
    }
    
    function doFormInit() {
    	$this->response->write($this->renderTemplate("user/change_password.tpl"));
	}

    function doFormInvalid() {
        $this->template->assign($this->formData);
        $this->response->write($this->renderTemplate("user/change_password.tpl"));
    }

    function doFormValid() {
    	$conn = &DbFactory::getConnection();
        $query = $conn->newStatement("UPDATE user SET password=:password: WHERE id=:id:");
        $query->setVarChar("password", md5($this->formData['new_password']));
        $query->setInteger("id", $this->user['id']);
        $query->execute();
        
        $this->response->redirect("/change_password/?note=save");
    }

    function doValidation() {
        $validator = new Validator($this->formData);
        $rules = array(
            new EmptyFieldRule("cur_password", "Пароль"),
            new EmptyFieldRule("new_password", "Новый пароль"),
            new EmptyFieldRule("new_password_rep", "Повтор нового пароля"),            
            new FieldsIsNotMatchRule("new_password", "new_password_rep", "Новый пароль", "Повтор нового пароля")
        );
        $validator->validate($rules);
        if ($errors = $validator->getErrorList()) {
            $this->template->assign("errors", $errors);
            return false;
        }
        else {
            if (isset($this->formData['new_password'])) {
            	$conn = &DbFactory::getConnection();
                $query = $conn->newStatement('SELECT id FROM user WHERE password=:password: AND id=:id:');
                $query->setVarChar("password", md5($this->formData['cur_password']));
                $query->setInteger("id",  $this->user['id']);
                if (!$query->getOneValue()) {
                    $this->template->assign("errors", array('Неверное значение Текущий пароль'));
                    return false;
                }
            }
        }
        return true;
    }
	
}