<?php
require_once("module/AbstractPageModule.class.php");

class AdminContentListPage extends AbstractPageModule {
	
	public function doBeforeOutput() {
		$this->Authenticate();
	}
	
	public function doContent() {
		
		$id = $this->request->getValue("id");
		$action = $this->request->getValue("action");
		
		$conn = &DbFactory::getConnection();
		
		if ($action == "delete" && !empty($id)) {
			$query = $conn->newStatement("DELETE FROM content WHERE id=:id:");
	        $query->setInteger('id', $id);
	        $query->execute();
			
			$this->response->redirect("/admin/content/list/");
		}
		
		$query = $conn->newStatement("SELECT * FROM content ORDER BY id");
		$data = $query->getAllRecords();
		$this->template->assign('data', $data);
		
		$this->response->write($this->renderTemplate("admin/admin_content_list.tpl"));
	}
}
?>