<?php
class AdminPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
	}

	function doContent()	{
            
            
                $query = $this->conn->newStatement("SELECT * FROM orders WHERE date>=CURDATE()");
                $data_order_admin = $query->getAllRecords();
                $this->template->assign('data_order_admin', $data_order_admin);
                
                $query = $this->conn->newStatement("SELECT * FROM user WHERE date>=CURDATE()");
                $data_users_admin = $query->getAllRecords();
                $this->template->assign('data_users_admin', $data_users_admin);
                
                $query = $this->conn->newStatement("SELECT * FROM respond WHERE date>=CURDATE()");
                $data_respond_admin = $query->getAllRecords();
                $this->template->assign('data_respond_admin', $data_respond_admin);
                
                
		$this->response->write($this->renderTemplate('admin/index.tpl'));
	}

}

?>