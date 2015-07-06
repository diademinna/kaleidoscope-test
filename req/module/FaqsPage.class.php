<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once('util/MailUtil.class.php');

class FaqsPage extends FormPageModule{
	
	function doBeforeOutput(){
		$this->doInit();
		
		$page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $page);
		
		define('COUNT_PAGE', 10);
		require_once 'module/common/PagerFactory.class.php';
		$pager = new PagerFactory();
		$sql = "SELECT * FROM faqs WHERE active=1 ORDER BY pos DESC, id DESC";
		$fromWhereCnt = "faqs WHERE active=1";
		$href = "/faqs/";
		
		$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
		$data = $pager->getPageData();
		
		$this->template->assign('pager_string', $pagerString);
		$this->template->assign('data_faqs', $data);
		
		$this->setPageTitle("Вопрос-ответ");
	}

	function doFormInit(){		
		$this->response->write($this->renderTemplate('faqs.tpl'));
	}
	
	function doFormValid(){
		
		$mail = new MailUtil();
		$mail->setTo(ADMIN_EMAIL);
		$mail->setSubject('Поступил новый Вопрос');
		if($this->formData['email']){
			$email = $this->formData['email'];
		}
		else {
			$email = "{$_SERVER['HTTP_HOST']} <".ADMIN_EMAIL.">";
		}
		$mail->setFrom($email);		
		$tdata = array(
						'fio' => $this->formData['fio'],
						'question' => $this->formData['question'],
						'email' => $this->formData['email'],
				      );
		
		$mail->setEmailTextTemplate('mail/faqs_mail.tpl',$tdata);
		if (!$mail->doSend()){
			$this->template->assign('errors', array("Не возможно отправить Ваше сообщение. Попробуйте позже."));
		}
		else{
			$this->template->assign('notes', array('Спасибо. Ваш вопрос принят.'));
		}
		
		
		$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM faqs");
		$pos = (int)$query_pos->getOneValue();
		if(!$pos){
			$pos = 1;
		} 
			
		$query = $this->conn->newStatement("INSERT INTO faqs SET question=:question:, fio=:fio:, email=:email:, pos=:pos:");		
		$query->setText('question', $this->formData['question']);
		$query->setText('fio', $this->formData['fio']);
		$query->setText('email', $this->formData['email']);
		$query->setInteger("pos", $pos);
		$query->execute();
				
		$this->response->write($this->renderTemplate('faqs.tpl'));
	}
	
	function doFormInValid(){		
		$this->template->assign('data_form', $this->formData);				
		$this->response->write($this->renderTemplate('faqs.tpl'));
	}
	
	
	function doValidation(){
		$rules = array(
			new EmptyFieldRule("fio", 'Ф.И.О.'),
			new EmptyFieldRule("question", 'Ваш вопрос'),
			new EmptyFieldRule("email", "Эл. почта"),
            new WrongEmailFormatRule("email", "Эл. почта"),
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