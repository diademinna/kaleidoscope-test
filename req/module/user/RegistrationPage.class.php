<?php
require_once("module/FormPageModule.class.php");
require_once('validator/Validator.class.php');
require_once("util/FileSystem.class.php");
require_once('util/MailUtil.class.php');

class RegistrationPage extends FormPageModule {
	
    function  doBeforeOutput() {
		$this->doInit();
                
        if ($this->user) {
        	$this->response->redirect('/');
        }
    }
    
    function doFormInit() {
		$this->setTplName('user/registration.tpl');
	}

    function  doFormInvalid() {
        $this->template->assign($this->formData);
        $this->setTplName('user/registration.tpl');
    }

    function  doFormValid() {
    	$conn = &DbFactory::getConnection();
    	
        $query = $conn->newStatement("INSERT INTO user SET name=:name:, last_name=:last_name:, email=:email:, phone=:phone:, name_company=:name_company:, city=:city:, address=:address:, login=:login:, password=:password:, date=now(), activate=:activate:");
        $query->setVarchar("name", $this->formData['name']);
        $query->setVarchar("last_name", $this->formData['last_name']);
        $query->setVarchar("login", $this->formData['email']);
        $query->setVarchar("email", $this->formData['email']);
        $query->setVarchar("phone", $this->formData['phone']);
        $query->setVarchar("city", $this->formData['city']);
        $query->setVarchar("address", $this->formData['address']);
        $query->setVarchar("name_company", $this->formData['name_company']);
        $query->setVarchar("password", md5($this->formData['reg_password']) );
        $query->setInteger("activate", 0);
        $query->execute();
        
        $insertId = $query->getInsertId();
        
        $this->formData['servak'] = $_SERVER['HTTP_HOST'];
        $this->formData['id'] = $insertId;
        $this->formData['checkSum'] = base64_encode(md5($this->formData['email']));
		
        // отправляем письмо!
        $mail = new MailUtil();
        $mail->setTo($this->formData['email']);
        $mail->setSubject('Вы зарегистрированы на сайте '.$_SERVER['HTTP_HOST']);
        $mail->setFrom("{$_SERVER['HTTP_HOST']} <" . ADMIN_EMAIL . ">");
        $tdata = $this->formData;
        $mail->setEmailTextTemplate('mail/registration_confirm.tpl', $tdata);
        if (!$mail->doSend()) {
                $message = 'Ошибка. Письмо не отправлено. Повторите попытку позже.';
        }
		
        $this->response->redirect("/success_registration/");
	}

    function  doValidation() {
    	$conn = &DbFactory::getConnection();
        if (!$this->user) {
            $validator = new Validator($this->formData);
            $rules = array(
                new EmptyFieldRule("name","Имя"),
                new EmptyFieldRule("last_name","Фамилия"),
                new EmptyFieldRule("email","Эл. почта"),
                new WrongEmailFormatRule("email","Эл. почта"),
                new EmptyFieldRule("city","Город / населенный пункт"),
                new EmptyFieldRule("reg_password","Пароль"),
                new EmptyFieldRule("reg_password2","Подтверждение пароля"),
            );

            $validator->validate($rules);
            if ($errors = $validator->getErrorList()) {
                $this->template->assign("errors", $errors);
                return false;
            }
            else {
            	if( UserAction::checkEmailBusy($this->formData['email']) ){
            		$errors[] = "Пользователь с таким адресом эл. почты уже есть в базе";
            		$this->template->assign("errors", $errors);
            		return false;
            	}
            	elseif (UserAction::checkLoginBusy($this->formData['login'])){
            		$errors[] = "Пользователь с таким логином уже есть в базе";
            		$this->template->assign("errors", $errors);
            		return false;
            	}
            	elseif ($this->formData['reg_password'] != $this->formData['reg_password2']){
            		$errors[] = "Пароль и подтверждение пароля не совпадает";
            		$this->template->assign("errors", $errors);
            		return false;
            	}
            }
        }
        return true;
    }
    //*** DEVELOPER AJAX ***//

  
}