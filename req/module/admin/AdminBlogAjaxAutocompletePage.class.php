<?php
class AdminBlogAjaxAutocompletePage extends AbstractPageModule {
	
		function doContent(){
			// автокомлит для поля клиент. при добавлении плетежа

			$name =  mysql_real_escape_string(trim(htmlspecialchars($_GET['term'])));

			//print_r($name);die();
			// обязательно нужно поле label
			$query = $this->conn->newStatement("SELECT id, name AS label FROM blog_tag WHERE name LIKE :name:");
			$query->setVarChar('name','%'.$name.'%');
			$data = $query->getAllRecords();

			echo json_encode($data); 
			die();		
		}
}
?>