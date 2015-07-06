<?php
require_once("module/AbstractPageModule.class.php");

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class CheckEmailPage extends AbstractPageModule {

	
	
	function doContent(){
		
		$email = $this->request->getValue('email');
                $query = $this->conn->newStatement("SELECT id FROM user WHERE email=:email:");
                $query->setVarChar('email', $email);
                $data = $query->getAllRecords();
                if ($data) {
                     echo json_encode(array('data_check_email'=>'find'));
                }
                else{
                    echo json_encode(array('data_check_email'=>'ok'));
                }
                die();
	}
	
}
?>