<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminContactsAddPage extends FormPageModule {	
	
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
                $this->template->assign('unit', "contacts");
		
	}
		
	public function doFormInit(){
		
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		$conn =& DbFactory::getConnection();
		if (!empty($id) AND $action == "edit"){
			$query = $conn->newStatement("SELECT * FROM contacts WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		$this->response->write($this->renderTemplate('admin/admin_contacts_add.tpl'));
		/*
		
		
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM contacts WHERE id=1");
		$data = $query->getFirstRecord();
		$this->template->assign('data', $data);
		
		$this->response->write($this->renderTemplate('admin/admin_contacts.tpl'));*/
	}
	
	
	public function doFormValid(){
		
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
					
		if (!empty($id) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE contacts SET name_place=:name_place:, address=:address:, description=:description:, name_on_map=:name_on_map:, latitude=:latitude:, longitude=:longitude:, ext=:ext:, link_yandex=:link_yandex:, phone=:phone: WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM contacts");
			$pos = (int)$query_pos->getOneValue();
			if(!$pos){
				$pos = 1;
			}
					
			$query = $this->conn->newStatement("INSERT INTO contacts SET name_place=:name_place:, address=:address:, description=:description:, name_on_map=:name_on_map:, latitude=:latitude:, longitude=:longitude:, link_yandex=:link_yandex: ext=:ext:, phone=:phone:, active=:active:, pos=:pos:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos);

		}
		
		$query->setVarChar('name_place', $this->formData['name_place']);
		$query->setText('address', $this->formData['address']);
		$query->setVarChar('phone', $this->formData['phone']);
		$query->setVarChar('description', $this->formData['description']?$this->formData['description']:NULL);
		$query->setVarChar('name_on_map', $this->formData['name_on_map']?$this->formData['name_on_map']:NULL);
		$query->setVarChar('latitude', $this->formData['latitude']);
		$query->setVarChar('longitude', $this->formData['longitude']);
		
		if($this->formData["link_yandex"]){
			if(!strstr($this->formData["link_yandex"], "http://")){
				$this->formData["link_yandex"] = "http://{$this->formData['link_yandex']}";
			}
		}
		$query->setText('link_yandex', $this->formData['link_yandex']?$this->formData['link_yandex']:NULL);
		
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
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/contacts/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/contacts/{$id_new}_tmp.{$image_type}");
			
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
				$tmp_img->resizeProportionally("uploaded/contacts/{$id_new}.{$image_type}", 1024, 1);
			}
			elseif ($image_height > 800 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/contacts/{$id_new}.{$image_type}", 800, 1);
			}
			else{
				copy("uploaded/contacts/{$id_new}_tmp.{$image_type}", "uploaded/contacts/{$id_new}.{$image_type}");
			}
			$img_position=1;
			if($this->formData['type_resize'] == 1){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
				
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->ResizeFromRaf(314, 224, "uploaded/contacts/{$id_new}_sm.{$image_type}");
				}
				
				// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
				//$tmp_img->resizeProportionally("uploaded/contacts/{$id_new}_sm.{$image_type}", 200, 1);
			}
			elseif ($this->formData['type_resize'] == 2){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ С ПУСТЫМИ ПОЛЯМИ
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->Resize(314, 224, "uploaded/contacts/{$id_new}_sm.{$image_type}");
				}
			}
			
			FileSystem::deleteFile("uploaded/contacts/{$id_new}_tmp.{$image_type}");
			
			$query = $this->conn->newStatement('UPDATE contacts SET img_position=:img_position: WHERE id=:id:');
	        $query->setInteger('id', $id_new);
	        $query->setInteger('img_position', $img_position);
			$query->execute();
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
		
		$this->response->redirect("/admin/contacts/list/{$this->page}/".($this->get_param?$this->get_param:"") );
		/*
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
		$conn = &DbFactory::getConnection();
		
		$query = $conn->newStatement("UPDATE contacts SET name=:name:, description=:description:, title=:title:, latitude=:latitude:, longitude=:longitude:, name_on_map=:name_on_map: WHERE id=:id:");
		
		$query->setText('name', $this->formData['name']);
		$query->setText('description', $this->formData['description']);
		$query->setText('title', $this->formData['title']);
		$query->setVarChar('latitude', $this->formData['latitude']);
		$query->setVarChar('longitude', $this->formData['longitude']);
		$query->setVarChar('name_on_map', $this->formData['name_on_map']);
		$query->execute();

	    $this->template->assign("notice", "Информация была успешно сохранена");
	    
		$this->response->redirect("/admin/contacts/");*/
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_contacts_add.tpl"));
	}
	
	
	function doValidation(){
		$rules = array(
			new EmptyFieldRule("name_place", 'Название местоположения'),
			new EmptyFieldRule("address", 'Адрес'),
			new EmptyFieldRule("phone", 'Телефон'),
		);
		
		$validator = new Validator($this->formData);
		
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else return true;
	}
	function deleteImage($id){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM contacts WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/contacts/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/contacts/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE contacts SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		//$xajax->redirect("/admin/contacts/add/{$page}/edit/{$id}/".($get_param?$get_param:"") );
		
		return $xajax;
	}
	
}
?>