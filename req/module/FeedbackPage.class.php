<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once('util/MailUtil.class.php');

class FeedbackPage extends FormPageModule {

	function doBeforeOutput(){
		$this->doInit();
		$this->setPageTitle("Обратная связь");
	}

	function doFormInit(){
		$this->response->write($this->renderTemplate('feedback.tpl'));
	}

	function doFormValid(){
		
		$mail = new MailUtil();
		$mail->setTo(ADMIN_EMAIL);
		$mail->setSubject('Обратная связь / '.$_SERVER['HTTP_HOST']);
		$mail->setFrom("{$_SERVER['HTTP_HOST']} <".ADMIN_EMAIL.">");
		$tdata = array(
						'fio' => $this->formData['fio'],
						'message' => $this->formData['message'],
						'email' => $this->formData['email'],
						'phone' => $this->formData['phone'],
						);
		$mail->setEmailTextTemplate('mail/feedback.tpl',$tdata);
		if (!$mail->doSend()){
			$this->template->assign('errors',array("Не возможно отправить Ваше сообщение. Попробуйте позже."));
		}
		else{
			$this->template->assign('notes',array('Ваше сообщение успешно отправлено!'));
		}
		
		$this->response->write($this->renderTemplate('feedback.tpl'));
	}

	function doFormInValid(){
		$this->template->assign($this->formData);		
		$this->response->write($this->renderTemplate('feedback.tpl'));
	}
	
	function doValidation() {
		$rules = array(
			new EmptyFieldRule("fio", 'Контактное лицо'),
			new EmptyFieldRule("message", 'Сообщение'),
			new CaptchaRule("kcaptcha"),
			//new EmptyFieldRule("email", 'Котактные данные'),
			//new WrongEmailFormatRule("email", 'E-mail'),
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