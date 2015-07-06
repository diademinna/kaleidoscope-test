<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once('util/MailUtil.class.php');

class VacancyPage extends FormPageModule {

	function doBeforeOutput(){
		$this->doInit();
		
		$this->setPageTitle("Вакансии");
	}

	function doFormInit(){
		define('COUNT_PAGE', 10);
		require_once 'module/common/PagerFactory.class.php'; 

		$pager = new PagerFactory();
		$page = $this->request->getValue ('page');
		if(!$page){
			$page=1;
		}
		$this->template->assign('page', $page);

		$sql = "SELECT * FROM vacancy WHERE active=1 ORDER BY pos DESC, id DESC";
		$fromWhereCnt = "vacancy WHERE active=1";
		$href = "/vacancy/page/";

		$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
		$data = $pager->getPageData();
		$this->template->assign('pager_string', $pagerString);
		$this->template->assign('data_vacancy', $data);
		
		$this->response->write($this->renderTemplate('vacancy.tpl'));
	}

	function doFormInValid(){
		// не заходим
	}

	function doFormValid(){
		// сохраняем в базу
		$query = $this->conn->newStatement("INSERT INTO vacancy_user SET id_vacancy=:id_vacancy:, fio=:fio:, phone=:phone:, email=:email:, text=:text:, ext=:ext:, date=now()");	
		$query->setInteger('id_vacancy', $this->formData['id_vacancy']);
		$query->setVarChar('fio', $this->formData['fio']);
		$query->setVarChar('phone', $this->formData['phone']);
		$query->setVarChar('email', $this->formData['email']);
		$query->setText('text', $this->formData['message']);
		
		$user_file = $this->request->getValue("user_file");
				
		if ($user_file['tmp_name']){ // Если файл ЗАГРУЖАЮТ			
			// расширение
			$file_pieces = explode(".", $user_file['name']);
			$file_type = $file_pieces[count($file_pieces)-1];
			$query->setVarChar('ext', $file_type);
			$query->execute();
			
			$id_new = $query->getInsertId();
			$this->formData['id_new'] = $id_new;
			$this->formData['ext'] = $file_type;
			
			FileSystem::uploadFile($user_file['tmp_name'], "uploaded/vacancy/", "{$id_new}.{$file_type}");
		}
		else{ // Если файл не загружают
			$query->setVarChar('ext', NULL);
			$query->execute();
		}
				
		// достаем эту вакансии
		$query = $this->conn->newStatement("SELECT * FROM vacancy WHERE id=:id:");
		$query->setInteger('id', $this->formData['id_vacancy']);
		$data_vacancy = $query->getFirstRecord();
		
		$this->formData['vacancy_name'] = $data_vacancy['name'];
		$this->formData['vacancy_text'] = $data_vacancy['text'];
		$this->formData['BASE_URL'] = BASE_URL;		
		
		// отправляем письмо
		$mail = new MailUtil();
		$mail->setTo(ADMIN_EMAIL);
		$mail->setSubject('Вакансии / '.$_SERVER['HTTP_HOST']);
		$mail->setFrom("{$_SERVER['HTTP_HOST']} <".ADMIN_EMAIL.">");
		$mail->setEmailTextTemplate('mail/vacancy.tpl', $this->formData); // $tdata
		if (!$mail->doSend())  
			$this->template->assign('errors', 'Не возможно отправить Вашу заявку. Попробуйте позже.');
		else
			$this->template->assign('notes', "Ваше сообщение отправлено.");
				
		$this->response->write($this->renderTemplate('vacancy.tpl'));
	}

	function doValidation() {
		return true;
	}
	
}
?>