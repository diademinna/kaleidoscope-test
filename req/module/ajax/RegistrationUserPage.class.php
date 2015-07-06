<?php
require_once("module/AbstractPageModule.class.php");
require_once('util/MailUtil.class.php');

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class RegistrationUserPage extends AbstractPageModule {

	
	
	function doContent(){
		$name = $this->request->getValue('name');
		$last_name = $this->request->getValue('last_name');
		$email = $this->request->getValue('email');
		$phone = $this->request->getValue('phone');
		$city = $this->request->getValue('city');
		$address = $this->request->getValue('address');
		$password = $this->request->getValue('password');
                
                $query = $this->conn->newStatement("INSERT INTO user SET name=:name:, last_name=:last_name:, email=:email:, phone=:phone:, name_company=:name_company:, city=:city:, address=:address:, login=:login:, password=:password:, date=now(), activate=:activate:");
                $query->setVarchar("name", $name);
                $query->setVarchar("last_name", $last_name);
                $query->setVarchar("login", $email);
                $query->setVarchar("email", $email);
                $query->setVarchar("phone", $phone);
                $query->setVarchar("city", $city);
                $query->setVarchar("address", $address);
                $query->setVarchar("name_company", $name_company);
                $query->setVarchar("password", md5($password) );
                $query->setInteger("activate", 0);
                $query->execute();
                
                $form = array();
                $form['login'] = $email;
                $form['password'] = $password;
                
                
                $insertId = $query->getInsertId();
        
                $form['servak'] = $_SERVER['HTTP_HOST'];
                $form['id'] = $insertId;
                $form['checkSum'] = base64_encode(md5($email));

                // отправляем письмо!
                $mail = new MailUtil();
                $mail->setTo($email);
                $mail->setSubject('Вы зарегистрированы на сайте '.$_SERVER['HTTP_HOST']);
                $mail->setFrom("{$_SERVER['HTTP_HOST']} <" . ADMIN_EMAIL . ">");
                $tdata = $form;
                $mail->setEmailTextTemplate('mail/registration_confirm.tpl', $tdata);
                $mail->doSend();
                echo json_encode(array('data_reg_user'=>'ok'));
                
                die();
	}
	
}
?>