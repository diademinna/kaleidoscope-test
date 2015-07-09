<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminActionsAddPage extends FormPageModule {	
	
	var $page;
	var $get_param;
	
	public function doBeforeOutput() {
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
                $this->template->assign('unit', "actions");
		
		$this->template->assign("tinymce", 1);
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
                
                $query = $this->conn->newStatement("SELECT * FROM category WHERE active=1 AND parent_id=0 ORDER BY name");
                $data_category = $query->getAllRecords();
                if ($data_category)
                {
                    foreach ($data_category as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT * FROM category WHERE parent_id=:parent_id: AND active=1 ORDER BY name");
                        $query->setInteger('parent_id', $value['id']);
                        $data_category_child = $query->getAllRecords();
                        if ($data_category_child)
                            $data_category[$key]['child'] = $data_category_child;
                       
                    }
                }
                $this->template->assign('data_category', $data_category);
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
		
                
		if (!empty($id) AND $action == "edit"){
                    $conn =& DbFactory::getConnection();
                    $query = $conn->newStatement("SELECT * FROM actions WHERE id=:id:");
                    $query->setInteger('id', $id);
                    $data = $query->getFirstRecord();

                    if($data['date'] AND $data['date']!="0000-00-00"){ // преобразование даты
                            $temp = explode("-", $data['date']);
                            $data['date'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
                    }
                    if($data['date_end'] AND $data['date_end']!="0000-00-00"){ // преобразование даты
                            $temp = explode("-", $data['date_end']);
                            $data['date_end'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
                    }
                    $query = $conn->newStatement("SELECT * FROM actions_category WHERE id_action=:id_action:");
                    $query->setInteger('id_action', $id);
                    $data_select_category = $query->getAllRecords('id_category');

                    $this->template->assign('data_select_category', $data_select_category);
                    $this->template->assign('data', $data);
		}
		$this->response->write($this->renderTemplate('admin/admin_actions_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$id = $this->request->getValue("id");
                
                	
		$conn = &DbFactory::getConnection();
		
                
                if($this->formData["date_end"]){
			$temp = explode("-", $this->formData["date_end"]);
			$this->formData["date_end"] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
		}
		// преобразование даты
		if($this->formData["date"]){
			$temp = explode("-", $this->formData["date"]);
			$this->formData["date"] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
		}
		else{
			$this->formData["date"] = date('Y-m-d');  // берем текущую
		}
		
        	
		if (!empty($id) && $action == "edit"){
			$query = $conn->newStatement("UPDATE actions SET name=:name:, anons=:anons:, text=:text:, ext=:ext:, title=:title:, date=:date:, date_end=:date_end:, text_product=:text_product: WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{
			$query = $conn->newStatement("INSERT INTO actions SET name=:name:, anons=:anons:, text=:text:, title=:title:, ext=:ext:, date=:date:, date_end=:date_end:, active=:active:, text_product=:text_product:");
			$query->setInteger('active', 1);
		}
		$query->setVarChar('name', $this->formData['name']);
		$query->setText('anons', $this->formData['anons']);
		$query->setText('text', $this->formData['text']);
		$query->setVarChar('title', $this->formData['title']);
		$query->setDate('date', $this->formData['date']);
		$query->setDate('date_end', $this->formData['date_end']);
		$query->setVarChar('text_product', $this->formData['text_product']);
                $id_new = 0;
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

                    ImageUtil::uploadImage($image['tmp_name'], "uploaded/actions/",  "{$id_new}_tmp.{$image_type}");
                    $tmp_img = new ImageUtil("uploaded/actions/{$id_new}_tmp.{$image_type}");

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
                            $tmp_img->resizeProportionally("uploaded/actions/{$id_new}.{$image_type}", 1024, 1);
                    }
                    elseif ($image_height > 800 AND $img_position==2) { // высокая
                            $tmp_img->resizeProportionallyHeight("uploaded/actions/{$id_new}.{$image_type}", 800, 1);
                    }
                    else{
                            copy("uploaded/actions/{$id_new}_tmp.{$image_type}", "uploaded/actions/{$id_new}.{$image_type}");
                    }
					
                    $this->formData['type_resize'] = 1;
                    if($this->formData['type_resize'] == 1){
                            //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
                            if($img_position==1 OR $img_position==3){  // гориз.
                                   $tmp_img->ResizeFromRaf(280, 170, "uploaded/actions/{$id_new}_sm.{$image_type}");
                            }
                            else{ // вертик.
                                    $tmp_img->ResizeFromRaf(100, 170, "uploaded/actions/{$id_new}_sm.{$image_type}");
                            }

                            // РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
                            //$tmp_img->resizeProportionally("uploaded/actions/{$id_new}_sm.{$image_type}", 200, 1);
                    }
			
			
                    FileSystem::deleteFile("uploaded/actions/{$id_new}_tmp.{$image_type}");

                    $query = $conn->newStatement('UPDATE actions SET img_position=:img_position: WHERE id=:id:');
                    $query->setInteger('id', $id_new);
                    $query->setInteger('img_position', $img_position);
                    $query->execute();
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
               // print_r($this->formData);die();
                if ($this->formData['id_category'])
                {
                    if ($action != 'edit')
                            $id_new = $query->getInsertId();
                    else
                        $id_new = $id;
                    $query = $conn->newStatement("DELETE FROM actions_category WHERE id_action=:id_action:");
                    $query->setInteger('id_action', $id_new);
                    $query->execute();
                    foreach ($this->formData['id_category'] as $key=>$value)
                    {
                        $query = $conn->newStatement("INSERT INTO actions_category SET id_action=:id_action:, id_category=:id_category:");
                        $query->setInteger('id_action', $id_new);
                        $query->setInteger('id_category', $value);
                        $query->execute();
                    }
                    
                }
		
		$this->response->redirect("/admin/actions/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_actions_add.tpl"));
	}
	
	
	function doValidation(){
		$rules = array(
			new EmptyFieldRule("name", 'Название'),			
			new EmptyFieldRule("text", 'Контент'),
			new EmptyFieldRule("text_product", 'Текст для станицы продукта'),
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
		$query = $conn->newStatement("SELECT * FROM actions WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/actions/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/actions/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE actions SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		//$xajax->redirect("/admin/actions_gallery/add/{$page}/edit/{$id}/".($get_param?$get_param:"") );
		
		return $xajax;
	}
	
}

?>