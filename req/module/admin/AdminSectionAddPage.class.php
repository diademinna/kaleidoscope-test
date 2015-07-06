<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminSectionAddPage extends FormPageModule {
		
	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		
		$parent_id = $this->request->getValue("parent_id");  // нужен в tpl
		$this->template->assign('parent_id', $parent_id?$parent_id:"0"); // нужен в tpl
		
		$id_section = $this->request->getValue("id_section"); // только когда редактируем
		$this->template->assign('id_section', $id_section); 
		
		if (!empty($id_section) AND $action == "edit"){
			$query = $this->conn->newStatement("SELECT * FROM section WHERE id=:id_section:");
			$query->setInteger('id_section', $id_section);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_section_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$id_section = $this->request->getValue("id_section"); // только когда редактируем
				
		// Обработать URL на наличие запрещенных символов.
		$this->formData['url'] = preg_replace('/[^\da-z_]+/', '', $this->formData['url']); // заменить все символы кроме чисел и a-z и _ на ''
		
		
		if (!empty($id_section) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE section SET name=:name:, text=:text:, ext=:ext:, title=:title:, url=:url:, flag_nosection=:flag_nosection: WHERE id=:id_section:");
	        $query->setInteger('id_section', $id_section);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM section");
			$pos = (int)$query_pos->getOneValue();
								
			$query = $this->conn->newStatement("INSERT INTO section SET name=:name:, text=:text:, title=:title:, ext=:ext:, active=:active:, pos=:pos:, parent_id=:parent_id:, url=:url:, flag_nosection=:flag_nosection:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos?$pos:1);
			$query->setInteger("parent_id", $parent_id);
		}
		
		$query->setVarChar('name', $this->formData['name']);
		$query->setText('text', $this->formData['text']);
		$query->setVarChar('title', $this->formData['title']);
		$query->setVarChar('url', $this->formData['url']?$this->formData['url']:NULL);
		$query->setInteger("flag_nosection",  $this->formData['flag_nosection']?$this->formData['flag_nosection']:NULL);
		
		$image = $this->request->getValue("image");
		if ($image['tmp_name']){ // Если картинку ЗАГРУЖАЮТ
			
			// расширение
			$image_pieces = explode(".", $image['name']);
			$image_type = $image_pieces[count($image_pieces)-1];
			$query->setVarChar('ext', $image_type);
			$query->execute();
			
			if (!empty($id_section) && $action == "edit"){
				$id_new = $id_section;
			}
			else{
				$id_new = $query->getInsertId();
			}
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/section/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/section/{$id_new}_tmp.{$image_type}");
			
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
			
			// РАЗМЕРЫ КАРТИНОК ////////////////////////
			$WIDTH_PHOTO = 280;
			$HEIGHT_PHOTO = 186;
				
			// создание большой картинки 
			if($image_width > 1024 AND ($img_position==1 OR $img_position==3) ){ // широкая
				$tmp_img->resizeProportionally("uploaded/section/{$id_new}.{$image_type}", 1024, 1);
			}
			elseif ($image_height > 800 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/section/{$id_new}.{$image_type}", 800, 1);
			}
			else{
				copy("uploaded/section/{$id_new}_tmp.{$image_type}", "uploaded/section/{$id_new}.{$image_type}");
			}
			
			if($this->formData['type_resize'] == 1){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
				
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->ResizeFromRaf($WIDTH_PHOTO, $HEIGHT_PHOTO, "uploaded/section/{$id_new}_sm.{$image_type}");
				}
				else{ // вертик.
					$tmp_img->ResizeFromRaf($HEIGHT_PHOTO, $WIDTH_PHOTO, "uploaded/section/{$id_new}_sm.{$image_type}");
				}
				
				// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
				//$tmp_img->resizeProportionally("uploaded/section/{$id_new}_sm.{$image_type}", 200, 1);
			}
			elseif ($this->formData['type_resize'] == 2){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ С ПУСТЫМИ ПОЛЯМИ
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->Resize($WIDTH_PHOTO, $HEIGHT_PHOTO, "uploaded/section/{$id_new}_sm.{$image_type}");
				}
				else{ // вертик.
					$tmp_img->Resize($HEIGHT_PHOTO, $WIDTH_PHOTO, "uploaded/section/{$id_new}_sm.{$image_type}");
				}
			}
			
			FileSystem::deleteFile("uploaded/section/{$id_new}_tmp.{$image_type}");
			
			$query = $this->conn->newStatement('UPDATE section SET img_position=:img_position: WHERE id=:id:');
	        $query->setInteger('id', $id_new);
	        $query->setInteger('img_position', $img_position);
			$query->execute();
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}		
		
		// могли не указать УРЛ. значит надо сделать его автоматом.
		if (!$this->formData['url']){
			if (!empty($id_section) && $action == "edit"){
				$id_new = $id_section;	
			}
			elseif(!$id_new){ // значит знаем запись с которой работаем в данный момент.
				$id_new = $query->getInsertId();
			}
			
			$query = $this->conn->newStatement('UPDATE section SET url=:url: WHERE id=:id:');
			$query->setInteger('id', $id_new);
			$query->setVarChar('url', $id_new);
			$query->execute();
		}
				
		
		$this->response->redirect("/admin/section/list/{$parent_id}/");
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		
		$parent_id = $this->request->getValue("parent_id");  // нужен в tpl
		$this->template->assign('parent_id', $parent_id?$parent_id:"0"); // нужен в tpl
		
		$id_section = $this->request->getValue("id_section"); // только когда редактируем
		$this->template->assign('id_section', $id_section); 
		
		$this->response->write($this->renderTemplate("admin/admin_section_add.tpl"));
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
		else {
			// ДОП проверка нет ли уже такого url в базе.
			// обработать урл
			$cur_url = preg_replace('/[^\da-z_]+/', '', $this->formData['url']); // заменить все символы кроме чисел и a-z и _ на ''
			
			$query = $this->conn->newStatement("SELECT * FROM section WHERE parent_id=:parent_id:");
			$query->setInteger('parent_id', $this->formData['parent_id']);
			$data = $query->getAllRecords();
			
			foreach ($data as $key=>$value){
				if( ($value['url'] == $cur_url) AND $value['id']!=$this->formData['id_section'] ){
					$this->template->assign('errors', array(1=>"такой URL уже есть в данном разделе"));
					return false;
				}
			}
						
		}
		return true;
	}	
	
	
	//*** DEVELOPER AJAX ***//
	
	// Удалить картинку из выбранного элемента
	function deleteImage($id){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM section WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/section/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/section/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE section SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		
		return $xajax;
	}
	
}
?>