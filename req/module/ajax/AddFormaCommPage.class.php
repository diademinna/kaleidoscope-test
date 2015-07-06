<?php
class AddFormaCommPage extends AbstractPageModule{
	
	function doContent(){
		$id_blog = (int)$this->request->getValue('id_blog');
		$id_comm = (int)$this->request->getValue('id_comm');
		$mode = $this->request->getValue('mode');
		
		$this->template->assign('data_item', array('id'=>$id_blog));
		$this->template->assign('id_comm', $id_comm);
		$this->template->assign('mode',  $mode);
		
		$form_text = $this->template->fetch('ajax/add_forma_comm.tpl');
		
		echo json_encode(array('data_ajax'=>$form_text)); 
		die();		
	}
	
}
?>