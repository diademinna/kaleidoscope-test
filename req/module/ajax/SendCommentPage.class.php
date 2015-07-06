<?php
require_once("module/AbstractPageModule.class.php");

class SendCommentPage extends AbstractPageModule {
	
	function doContent(){
		
		if( $this->request->getValue('name') AND $this->request->getValue('text') AND $this->request->getValue('id_blog') ){ // AND $this->user['id'] 
			
			$text = str_replace("\n", "<br />", $this->request->getValue('text'));
			$query = $this->conn->newStatement('INSERT INTO blog_comment SET id_blog=:id_blog:, parent_id=:parent_id:,  id_user=:id_user:, name=:name:, text=:text:, date=now()');
			$query->setInteger('id_blog', $this->request->getValue('id_blog'));
			$query->setInteger('parent_id', $this->request->getValue('id_comm')?$this->request->getValue('id_comm'):0);
			$query->setInteger('id_user', $this->user['id']?$this->user['id']:NULL);
			$query->setVarChar('name', $this->request->getValue('name'));
	        $query->setText('text', $text);
			$query->execute();
			$id_new = $query->getInsertId();
			
			echo json_encode(array('data_ajax'=>$id_new));
		}
		else{
			echo json_encode(array('data_ajax'=>'error'));
		}
		
		die();
	}
}
?>