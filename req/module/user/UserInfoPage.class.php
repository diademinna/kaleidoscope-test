<?php
class UserInfoPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
		$rand_new = rand(1, 100000);
		$this->template->assign('rand_new', $rand_new);
		
		$this->setPageTitle("Профиль");
	}	
		
	function doContent(){
		$conn = &DbFactory::getConnection();		
		$id = $this->request->getValue("id");
		
		// чтобы нельзя было посмотреть личную инфу пользователя		
		if ($this->user['id'] != $id) { // если ID в URLe тотже что залогинет
			$this->response->redirect('/');
		}

		$query = $conn->newStatement("SELECT * FROM user WHERE id=:id:");
		$query->setInteger('id', $id);
		$data = $query->getFirstRecord();
		
		$this->template->assign('data', $data);
	
		$this->response->write($this->renderTemplate('user/user_info.tpl'));
	}
}
?>