<?php
require_once("module/AbstractPageModule.class.php");
require_once('util/MailUtil.class.php');

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class AddReviewPage extends AbstractPageModule {

	
	
	function doContent(){
		$fio = $this->request->getValue('fio');
		$email = $this->request->getValue('email');
		$text = $this->request->getValue('text');
               
                $query = $this->conn->newStatement("INSERT INTO review SET fio=:fio:, email=:email:, date=NOW(), text=:text:");
                $query->setVarchar("fio", $fio);
                $query->setVarchar("email", $email);
                $query->setText("text", $text);
                $query->execute();
                
                echo json_encode(array('data_review'=>"ok"));
                die();
	}
	
}
?>