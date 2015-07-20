<?php
require_once("module/AbstractPageModule.class.php");
require_once('util/MailUtil.class.php');
require_once('util/MailUtil.class.php');

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class AddRespondPage extends AbstractPageModule {

	
	
	function doContent(){
		$fio = $this->request->getValue('fio');
		$email = $this->request->getValue('email');
		$text = $this->request->getValue('text');
		$phone = $this->request->getValue('phone');
		$id_service = $this->request->getValue('id_service');
               
                
               
                
                $query = $this->conn->newStatement("INSERT INTO respond SET fio=:fio:, email=:email:, date=NOW(), text=:text:, phone=:phone:, id_service=:id_service:");
                $query->setVarchar("fio", $fio);
                $query->setVarchar("email", $email);
                $query->setVarchar("phone", $phone);
                $query->setText("text", $text);
                $query->setInteger("id_service", $id_service);
                $query->execute();
                
                $query = $this->conn->newStatement("SELECT * FROM services WHERE id=:id:");
                $query->setVarchar("id", $id_service);
                $data_service = $query->getFirstRecord();
                
                
                $form = array();
                $form['fio'] = $fio;
                $form['email'] = $email;
                $form['phone'] = $phone;
                $form['text'] = $text;
                $form['name_service'] = $data_service['name'];
                $mail = new MailUtil();
                $mail->setTo(ADMIN_EMAIL);
                $mail->setSubject('Поступила заявка на услугу '.$_SERVER['HTTP_HOST']);
                $mail->setFrom("{$_SERVER['HTTP_HOST']} <" . ADMIN_EMAIL . ">");
                $tdata = $form;
                $mail->setEmailTextTemplate('mail/service.tpl', $tdata);
                $mail->doSend();
                
                echo json_encode(array('data_respond'=>"ok"));
                die();
	}
	
}
?>