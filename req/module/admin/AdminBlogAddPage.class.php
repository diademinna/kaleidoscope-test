<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminBlogAddPage extends FormPageModule {
		
	public function doBeforeOutput(){
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
		
		$parent_id = $this->request->getValue("parent_id");  // нужен в tpl
		$this->template->assign('parent_id', $parent_id?$parent_id:"0"); // нужен в tpl
		
		$id = $this->request->getValue("id"); // только когда редактируем
		$this->template->assign('id', $id); 
		
		if (!empty($id) AND $action == "edit"){
			$query = $this->conn->newStatement("SELECT * FROM blog WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			if($data['date'] AND $data['date']!="0000-00-00"){ // преобразование даты
				$temp = explode("-", $data['date']);
				$data['date'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
			}
			
			
			// теги
			$query = $this->conn->newStatement("
					SELECT btot.id AS id, bt.name AS tag_name
					FROM blog_to_tag btot 
					INNER JOIN blog_tag bt ON btot.id_blog_tag=bt.id
					WHERE btot.id_blog=:id_blog:
					ORDER BY btot.id ASC");
			$query->setInteger('id_blog', $id);
			$temp_tag = $query->getAllRecords();
			
			$str_tag = "";
			if($temp_tag){
				foreach ($temp_tag as $key=>$value){
					$str_tag .= $value['tag_name'].", ";
				}
				//$str_tag = substr($str_tag, 0, -2);   // удаляем последний символ
				$data['tag'] = $str_tag;
			}
						
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_blog_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$id = $this->request->getValue("id"); // только когда редактируем
		
		// преобразование даты
		if($this->formData["date"]){
			$temp = explode("-", $this->formData["date"]);
			$this->formData["date"] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
		}
		else{
			$this->formData["date"] = date('Y-m-d');  // берем текущую
		}
						
		// Обработать URL на наличие запрещенных символов.
		$this->formData['url'] = preg_replace('/[^\da-z_]+/', '', $this->formData['url']); // заменить все символы кроме чисел и a-z и _ на ''
		
		
		if (!empty($id) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE blog SET name=:name:, anons=:anons:, text=:text:, text2=:text2:, date=:date:, ext=:ext:, title=:title:, url=:url: WHERE id=:id:");
	        $query->setInteger('id', $id);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM blog WHERE parent_id=:parent_id:");
			$query_pos->setInteger("parent_id", $parent_id?$parent_id:0);
			$pos = (int)$query_pos->getOneValue();
			
			$query = $this->conn->newStatement("INSERT INTO blog SET name=:name:, anons=:anons:, text=:text:, text2=:text2:, date=:date:, title=:title:, ext=:ext:, active=:active:, pos=:pos:, parent_id=:parent_id:, url=:url:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos?$pos:1);
			$query->setInteger("parent_id", $parent_id?$parent_id:0);
		}
		
		$query->setVarChar('name', $this->formData['name']);
		$query->setText('anons', $this->formData['anons']);
		$query->setText('text', $this->formData['text']);
		$query->setText('text2', $this->formData['text2']);
		$query->setDate('date', $this->formData['date']);
		$query->setVarChar('title', $this->formData['title']);
		$query->setVarChar('url', $this->formData['url']?$this->formData['url']:NULL);
		
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
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/blog/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/blog/{$id_new}_tmp.{$image_type}");
			
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
			
			$img_position = 1; // ЖЕСТКО!!!!!!!!!!!!!!!
			// РАЗМЕРЫ КАРТИНОК ////////////////////////
			$WIDTH_PHOTO_SM = 630;
			$HEIGHT_PHOTO_SM = 392;
				
			// создание большой картинки 
			if($image_width > 1200 AND ($img_position==1 OR $img_position==3) ){ // широкая
				$tmp_img->resizeProportionally("uploaded/blog/{$id_new}.{$image_type}", 1200, 1);
			}
			elseif ($image_height > 900 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/blog/{$id_new}.{$image_type}", 900, 1);
			}
			else{
				copy("uploaded/blog/{$id_new}_tmp.{$image_type}", "uploaded/blog/{$id_new}.{$image_type}");
			}
			
			if($this->formData['type_resize'] == 1){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
				
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->ResizeFromRaf($WIDTH_PHOTO_SM, $HEIGHT_PHOTO_SM, "uploaded/blog/{$id_new}_sm.{$image_type}");
				}
				else{ // вертик.
					$tmp_img->ResizeFromRaf($HEIGHT_PHOTO_SM, $WIDTH_PHOTO_SM, "uploaded/blog/{$id_new}_sm.{$image_type}");
				}
				
				// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
				//$tmp_img->resizeProportionally("uploaded/blog/{$id_new}_sm.{$image_type}", 200, 1);
			}
			elseif ($this->formData['type_resize'] == 2){
				//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ С ПУСТЫМИ ПОЛЯМИ
				if($img_position==1 OR $img_position==3){  // гориз.
					$tmp_img->Resize($WIDTH_PHOTO_SM, $HEIGHT_PHOTO_SM, "uploaded/blog/{$id_new}_sm.{$image_type}");
				}
				else{ // вертик.
					$tmp_img->Resize($HEIGHT_PHOTO_SM, $WIDTH_PHOTO_SM, "uploaded/blog/{$id_new}_sm.{$image_type}");
				}
			}
			
			FileSystem::deleteFile("uploaded/blog/{$id_new}_tmp.{$image_type}");
			
			$query = $this->conn->newStatement('UPDATE blog SET img_position=:img_position: WHERE id=:id:');
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
			if (!empty($id) && $action == "edit"){
				$id_new = $id;	
			}
			elseif(!$id_new){ // значит знаем запись с которой работаем в данный момент.
				$id_new = $query->getInsertId();
			}
			
			$query = $this->conn->newStatement('UPDATE blog SET url=:url: WHERE id=:id:');
			$query->setInteger('id', $id_new);
			$query->setVarChar('url', $id_new);
			$query->execute();
		}
		
		
		
        // ТЕГИ ОБРАБОТКА
		
		if (!empty($id) && $action == "edit"){
			$id_new = $id;	
		}
		elseif(!$id_new){ // значит знаем запись с которой работаем в данный момент.
			$id_new = $query->getInsertId();
		}

		// теги обработка - (получаем строку тегов разделенных запятой)
		$mass_tag = explode(",", $this->formData['tag']);
		//print_r($mass_tag); die();

		if ($action == "edit") { // ЕСЛИ РЕДАКТИРОВАНИЕ смотрим бывшие теги
			$query = $this->conn->newStatement("SELECT * FROM blog_to_tag WHERE id_blog=:id_blog:");
			$query->setInteger('id_blog', $id_new);
			$data_tag_old = $query->getAllRecords('id_blog_tag');
		}

		if($mass_tag){
			foreach ($mass_tag as $key=>$value){
				$value =  trim($value);
				if($value){
					$query = $this->conn->newStatement("SELECT * FROM blog_tag WHERE name=:name:");
					$query->setVarChar('name', $value);
					$data_blog_tag = $query->getFirstRecord();

					if($data_blog_tag){  // есть уже в базе этот тег
						$id_tag = $data_blog_tag['id'];	
					}
					else{ // нет
						// добавляем новый тег
						$query = $this->conn->newStatement("INSERT INTO blog_tag SET name=:name:");
						$query->setVarChar('name', $value);
						$query->execute();
						$id_tag = $query->getInsertId();
					}

					if( $action != "edit" || ($action == "edit" && !$data_tag_old[$id_tag]['id'])){
						// делаем соединение блога и тега
						$query = $this->conn->newStatement("INSERT INTO blog_to_tag SET id_blog=:id_blog:, id_blog_tag=:id_blog_tag:");
						$query->setInteger('id_blog', $id_new);
						$query->setInteger('id_blog_tag', $id_tag);
						$query->execute();
					}

					if( $action == "edit" && $data_tag_old[$id_tag]['id'] ){
						unset($data_tag_old[$id_tag]);
					}

				}				
			} // foreach
		}

		// удаляем теги которые были удалены в процессе редактирования 
		if($action == "edit" && $data_tag_old){
			foreach ($data_tag_old as $key=>$value){
				if($key){
					$query = $this->conn->newStatement("DELETE FROM blog_to_tag WHERE id_blog=:id_blog: AND id_blog_tag=:id_blog_tag:");
					$query->setInteger('id_blog', $id_new);
					$query->setInteger('id_blog_tag', $key);
					$query->execute();

					// проверяем используется ли вообще в блогах данный тег
					$query = $this->conn->newStatement("SELECT * FROM blog_to_tag WHERE id_blog_tag=:id_blog_tag:");
					$query->setInteger('id_blog_tag', $key);
					$tag_use_in_blog = $query->getAllRecords();
					if(!$tag_use_in_blog){
						$query = $this->conn->newStatement("DELETE FROM blog_tag WHERE id=:id:");
						$query->setInteger('id', $key);
						$query->execute();
					}
				}
			}
		}
		
		Useful::rebuildStaticTpl('tags'); // REBUILD STATIC
		//$this->rebuildStaticTpl('tags'); // REBUILD STATIC
		
		
		$this->response->redirect("/admin/blog/list/{$parent_id}/page/{$this->page}/".($this->get_param?$this->get_param:"") );
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		
		$parent_id = $this->request->getValue("parent_id");  // нужен в tpl
		$this->template->assign('parent_id', $parent_id?$parent_id:"0"); // нужен в tpl
		
		$id = $this->request->getValue("id"); // только когда редактируем
		$this->template->assign('id', $id); 
		
		$this->response->write($this->renderTemplate("admin/admin_blog_add.tpl"));
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
			
			$query = $this->conn->newStatement("SELECT * FROM blog WHERE parent_id=:parent_id:");
			$query->setInteger('parent_id', $this->formData['parent_id']);
			$data = $query->getAllRecords();
			
			foreach ($data as $key=>$value){
				if( ($value['url'] == $cur_url) AND $value['id']!=$this->formData['id'] ){
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
		$query = $conn->newStatement("SELECT * FROM blog WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/blog/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/blog/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE blog SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		
		return $xajax;
	}
	
}
?>