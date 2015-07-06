<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once('util/MailUtil.class.php');

class CallbackPage extends FormPageModule{

	function doBeforeOutput(){		
		$this->doInit();		
		$this->setPageTitle("Обратная связь");		
	}

	function doFormInit(){
		$this->response->write($this->renderTemplate('callback.tpl'));
	}

	function doFormInValid(){
		// не заходим
	}

	function doFormValid(){
		
		// сохраняем в базу
		$query = $this->conn->newStatement("INSERT INTO callback_user SET fio=:fio:, tel=:tel:, email=:email:, text=:text:, date=now()");
		$query->setVarChar('fio', $this->formData['fio']);
		$query->setVarChar('tel', $this->formData['tel']);
		$query->setVarChar('email', $this->formData['email']);
		$query->setText('text', $this->formData['text']);
		$query->execute();
		
		// отправляем на почту
		$mail = new MailUtil();
		$mail->setTo(ADMIN_EMAIL);
		$mail->setSubject('Обратная связь / '.$_SERVER['HTTP_HOST']);
		$mail->setFrom("{$_SERVER['HTTP_HOST']} <".ADMIN_EMAIL.">");
		$mail->setEmailTextTemplate('mail/callback.tpl', $this->formData); // $tdata
		if (!$mail->doSend())
			$this->template->assign('errors', 'Не возможно отправить Вашу заявку. Попробуйте позже.');
		else
			$this->template->assign('notes', "Ваше сообщение отправлено.");
		
		$this->response->write($this->renderTemplate('callback.tpl'));
	}

	function doValidation(){
		return true;
	}
	
}
?>