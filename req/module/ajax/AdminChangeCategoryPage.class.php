<?php
require_once("module/AbstractPageModule.class.php");

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class AdminChangeCategoryPage extends AbstractPageModule {

	
	
	function doContent(){
		
		$id_category = (int) $this->request->getValue('id_category');
                
                $query = $this->conn->newStatement("SELECT * FROM category WHERE id=:id:");
                $query->setInteger("id", $id_category);
	        $data_category = $query->getFirstRecord();
                
                $query = $this->conn->newStatement("SELECT * FROM parameter WHERE parent_id=:parent_id:");
                $query->setInteger("parent_id", $data_category['id_parameter']);
	        $data_filtr = $query->getAllRecords();
                    
               
                $this->template->assign('data_filtr', $data_filtr);
                $form_data_filtr = $this->template->fetch('rebuild/admin_parameters.tpl');
                echo json_encode(array('data_ajax_filtr'=>$form_data_filtr));
                die();
	}
	
}
?>