<?php

class UserAction {

	static public function isLogin() {  // вызываем из Abstract при загрузке каждой страницы сайта.
		require_once 'http/HttpSession.class.php';

		$conn = &DbFactory::getConnection();
		if (HttpSession::has('user')) { // если авторизован. проверяется есть ли текущая сессия.
			$user = unserialize(HttpSession::get('user'));
			$query = $conn->newStatement("SELECT * FROM user WHERE id=:id: AND activate=1");
			$query->setInteger('id', $user['id']);
			$user = $query->getFirstRecord();
			HttpSession::set('user', serialize($user));
		}
		elseif ($_COOKIE['auto_login'] && $_COOKIE['auto_password']) {  // КОГДА УСТАНОВЛЕН АВТО ВХОД. ИНФА БЕРЕТСЯ ИЗ КУКИ И СОЗДАЕТСЯ СЕССИЯ.
			
			$query = $conn->newStatement("SELECT * FROM user WHERE login=:login: AND activate=1");
			$query->setVarChar('login', $_COOKIE['auto_login']);
			$user = $query->getFirstRecord();
			
			if(md5($user['password']) == $_COOKIE['auto_password']){
				HttpSession::set('user', serialize($user));
			}
			
			UserAction::LastVisit($user);  // сохраняем последний визит на сайт! если необходимо
		}
		
		return HttpSession::has('user') ? unserialize(HttpSession::get('user')) : FALSE;
	}
	
	
	static public function checkLogin($formdata) {  // проверка введенных логина и пароля. вызывается из Login.php
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM user WHERE login=:login:");
		$query->setVarChar('login', $formdata['login']);
		$user = $query->getFirstRecord();
		
		if($user && !$user['activate']){  // если не активирован
			$str = "no_activate";
			return $str;
		}
		elseif ($user && $user['activate']==1 && $user['password']==$formdata['password']) {
			if ($formdata["remember"]) {
				$expires = time() + 3600 * 24 * 350; // час * 24 часа - сутки * 356
 
				setcookie('auto_login', $formdata['login'], $expires, "/");
				setcookie('auto_password', md5($formdata['password']), $expires, "/");
			}
			return $user;
		}
		else{
			return false;
		}
	}
	
	
	static public function login($user) {  // если логин и пароль верен! создаем сессию. вызывается Login.php
		require_once 'http/HttpSession.class.php';
		HttpSession::set('user', serialize($user));
		
		UserAction::LastVisit($user);  // сохраняем последний визит на сайт! если необходимо
				
		return true;
	}
	
		
	static public function logout() {
		require_once 'http/HttpSession.class.php';
		HttpSession::remove('user');
		setcookie("auto_login", "", time() - 3600, "/");
		setcookie("auto_password", "", time() - 3600, "/");
	}
	
	static public function checkLoginBusy($login) {
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT id FROM user WHERE login=:login:");
		$query->setVarChar('login', $login);
		return $query->getOneValue();
	}
	
	static public function checkEmailBusy($email) {
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT id FROM user WHERE email=:email:");
		$query->setVarChar('email', $email);
		return $query->getOneValue();
	}
	
	static public function checkEmailRestore($formdata) {
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM user WHERE email=:email:");
		$query->setVarChar('email', $formdata['email']);
		$email = $query->getFirstRecord();
		
		if ($email && $email['activate']==1 && $email['email']==$formdata['email']) {
			return $email;
		} 
		else {
			return false;
		}
	}	
	
	static public function LastVisit($user) {  // сохранияет последний визит пользователя.
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("UPDATE user SET last_visit=NOW() WHERE id=:id:");
		$query->setInteger('id', $user['id']);
		return $query->execute();
	}
	
}