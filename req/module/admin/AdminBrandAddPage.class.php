<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminBrandAddPage extends FormPageModule {	
	
	var $page;
	var $get_param;
	
	public function doBeforeOutput() {	
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		if (!empty($id) AND $action == "edit"){
			$query = $this->conn->newStatement("SELECT * FROM brand WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		$this->response->write($this->renderTemplate('admin/admin_brand_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
					
		if (!empty($id) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE brand SET name=:name:, text=:text:, ext=:ext: WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM brand");
			$pos = (int)$query_pos->getOneValue();
			if(!$pos){
				$pos = 1;
			}
					
			$query = $this->conn->newStatement("INSERT INTO brand SET name=:name:, text=:text:, ext=:ext:, active=:active:, pos=:pos:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos);

		}
		
		$query->setVarChar('name', $this->formData['name']);
		$query->setText('text', $this->formData['text']);		
		
		$image = $this->request->getValue("image");
		if ($image['tmp_name']){ // Если картинку ЗАГРУЖАЮТ
			
			// расширение
			$image_pieces = explode(".", $image['name']);
			$image_type = $image_pieces[count($image_pieces)-1];
			$query->setVarChar('ext', $image_type);
			$query->execute();
			
			if (!empty($id) && $action == "edit"){
				$id_new = $id;
			}
			else{
				$id_new = $query->getInsertId();
			}
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/brand/",  "{$id_new}.{$image_type}");
			
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
		
		$this->response->redirect("/admin/brand/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_brand_add.tpl"));
	}
	
	
	function doValidation(){		
		$rules = array(
			new EmptyFieldRule("name", 'Название'),
		);
		
		$validator = new Validator($this->formData);
		
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else return true;
	}
	
	
	
	//*** DEVELOPER AJAX ***//
	
	// Удалить картинку из выбранного элемента
	function deleteImage($id){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM brand WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/brand/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/brand/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE brand SET ext=NULL WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		
		return $xajax;
	}
	
}

?>