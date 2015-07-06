<?php
class ActivatePage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->doInit();
		if ($this->user) {
			$this->response->redirect('/');
		}
	}	
	
	function doContent(){
		$conn = &DbFactory::getConnection();
		$checkSum = $this->request->getValue('checkSum');
		$id = $this->request->getValue('id');
		$this->template->assign('id', $id);
		
		// проверяем не прошло ли 2 дня с даты регистрации
		$query = $conn->newStatement("SELECT * FROM user WHERE id={$id} AND ( DATE_ADD(date, INTERVAL 72 HOUR) > now() )");
		$user = $query->getFirstRecord();
		
		if($user){
			$new_checkEmail = base64_encode(md5($user['email']));
		
			//print_r($checkEmail."<br />");print_r($new_checkEmail);die();
			if ($new_checkEmail == $checkSum) {
				$query = $conn->newStatement("UPDATE user SET activate=1 WHERE id=:id:");
				$query->setInteger('id', $id);
				$query->execute();
				
				$this->template->assign('result', 'Ваш E-mail подтверждён! Теперь вы можете <a href="/login/">войти</a>');
			}
			else {
				$this->template->assign("result", "Активация аккаунта не выполнена.");
			}
		}
		else{
			$this->template->assign("result", "Ваш аккаунт уже не может быть активирован. Свяжитесь с администратором сайта"." ". ADMIN_EMAIL);
		}
		
		$this->response->write($this->renderTemplate('user/activate.tpl'));
	}
}
?>