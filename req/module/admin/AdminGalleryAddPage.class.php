<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminGalleryAddPage extends FormPageModule {	
	
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
			$query = $this->conn->newStatement("SELECT * FROM gallery WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		$this->response->write($this->renderTemplate('admin/admin_gallery_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
					
		if (!empty($id) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE gallery SET name=:name:, text=:text:, ext=:ext:, title=:title: WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM gallery");
			$pos = (int)$query_pos->getOneValue();
			if(!$pos){
				$pos = 1;
			}
					
			$query = $this->conn->newStatement("INSERT INTO gallery SET name=:name:, text=:text:, title=:title:, ext=:ext:, active=:active:, pos=:pos:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos);

		}
		
		$query->setVarChar('name', $this->formData['name']);
		$query->setText('text', $this->formData['text']);
		$query->setVarChar('title', $this->formData['title']);
		
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
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/gallery/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/gallery/{$id_new}_tmp.{$image_type}");
			
			$image_width = $tmp_img->getWidth();
			$image_height = $tmp_img->getHeight();
			
			if($image_width > $image_height){ // horizontal
				$img_position = 1;
			}
			elseif($image_width < $image_height){ // vertical
				$img_position = 2;
			}
			elseif($image_width == $image_height){ // square
				$img_position = 3;
			}
				
			// создание большой картинки 
			if($image_width > 1024 AND ($img_position==1 OR $img_position==3) ){ // широкая
				$tmp_img->resizeProportionally("uploaded/gallery/{$id_new}.{$image_type}", 1024, 1);
			}
			elseif ($image_height > 800 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/gallery/{$id_new}.{$image_type}", 800, 1);
			}
			else{
				copy("uploaded/gallery/{$id_new}_tmp.{$image_type}", "uploaded/gallery/{$id_new}.{$image_type}");
			}
			
			if($this->formData['type_resize'] == 1){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
				
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->ResizeFromRaf(200, 120, "uploaded/gallery/{$id_new}_sm.{$image_type}");
				}
				else{ // вертик.
					$tmp_img->ResizeFromRaf(120, 200, "uploaded/gallery/{$id_new}_sm.{$image_type}");
				}
				
				// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
				//$tmp_img->resizeProportionally("uploaded/gallery/{$id_new}_sm.{$image_type}", 200, 1);
			}
			elseif ($this->formData['type_resize'] == 2){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ С ПУСТЫМИ ПОЛЯМИ
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->Resize(200, 120, "uploaded/gallery/{$id_new}_sm.{$image_type}");
				}
				else{ // вертик.
					$tmp_img->Resize(120, 200, "uploaded/gallery/{$id_new}_sm.{$image_type}");
				}
			}
			
			FileSystem::deleteFile("uploaded/gallery/{$id_new}_tmp.{$image_type}");
			
			$query = $this->conn->newStatement('UPDATE gallery SET img_position=:img_position: WHERE id=:id:');
	        $query->setInteger('id', $id_new);
	        $query->setInteger('img_position', $img_position);
			$query->execute();
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
		
		$this->response->redirect("/admin/gallery/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_gallery_add.tpl"));
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
		$query = $conn->newStatement("SELECT * FROM gallery WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/gallery/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/gallery/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE gallery SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		//$xajax->redirect("/admin/gallery/add/{$page}/edit/{$id}/".($get_param?$get_param:"") );
		
		return $xajax;
	}
	
}

?>