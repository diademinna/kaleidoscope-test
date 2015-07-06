<?php
require_once("module/FormPageModule.class.php");
require_once('validator/Validator.class.php');
require_once("util/FileSystem.class.php");
require_once('util/MailUtil.class.php');

class RestorePasswordPage extends FormPageModule {
	var $email;

    function  doBeforeOutput() {
		$this->doInit();
    }

    function  doFormInvalid() {
        $this->template->assign($this->formData);
        $this->response->write($this->renderTemplate('user/restore_password.tpl'));
    }
    
    
    public function doFormInit() {
		$this->response->write($this->renderTemplate("user/restore_password.tpl"));
	}
    
	function doFormValid() {
		if ($this->email['email'] == $this->formData['email']) {
			
			$pass_new = rand(1000, 100000);
			
			$conn = &DbFactory::getConnection();
			$query = $conn->newStatement("UPDATE user SET password=:pass_new: WHERE id=:id:");
			$query->setInteger('id', $this->email['id']);
			$query->setText('pass_new', md5($pass_new) );
			$query->execute();
			
			$this->formData['pass_new'] = $pass_new;
			
	       	$this->formData['servak'] = $_SERVER['HTTP_HOST'];
	       	
	       	$mail = new MailUtil();
			$mail->setTo($this->formData['email']);
			$mail->setSubject("Восстановление пароля на сайте".$_SERVER['HTTP_HOST']);
			$mail->setFrom("{$_SERVER['HTTP_HOST']} <" . ADMIN_EMAIL . ">");
			$tdata = $this->formData;
			$mail->setEmailTextTemplate('mail/restore_pass.tpl', $tdata);
			if (!$mail->doSend()) {
				$message = 'Ошибка. Письмо не отправлено. Повторите попытку позже.';
			}
	       	
	       	$this->template->assign('result', 'На ваш E-mail отправлено письмо с новым паролем.');
		}
		$this->response->write($this->renderTemplate("user/restore_password.tpl"));
		
	}

	function doValidation() {

		$validator = new Validator($this->formData);
        $rules = array(
            new EmptyFieldRule("email", "Ваш E-mail"),
        );
        $validator->validate($rules);
        if ($errors = $validator->getErrorList()) {
            $this->template->assign("errors", $errors);
            return false;
        }
        else {
			$conn = &DbFactory::getConnection();
			if (!$this->email = UserAction::checkEmailRestore($this->formData)) {
				$errors[] =  "Неверный E-mail";
				$this->template->assign('errors', $errors);
				return false;
			}
			else{
				return true;
			}
		}
	}
}