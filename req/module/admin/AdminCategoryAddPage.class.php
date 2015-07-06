<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminCategoryAddPage extends FormPageModule {
		
	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
                $this->template->assign('unit', "category");
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$this->template->assign('parent_id', $parent_id?$parent_id:"0");
		
		$id_category = $this->request->getValue("id_category"); // только когда редактируем
		$this->template->assign('id_category', $id_category);
		
		// ФОРМИРУЕМ НАВИГАЦИЮ.
		if($id_category){  // выбрана какая-то категория				
			// достаем все категории
			$query = $this->conn->newStatement("SELECT * FROM category ORDER BY parent_id ASC, pos DESC, id ASC");
			$data = $query->getAllRecords('id');

			// ищем для навигации родительские категории
			$mass_navigation =array();
			$cur_cat = $id_category; // текущая категория для навигации
			$level = 1; // уровень каталога
			$mass_navigation[] = $data[$cur_cat];
			while ($data[$cur_cat]['parent_id'] AND $data[$cur_cat]['parent_id']!="0"){
				$cur_cat = $data[$cur_cat]['parent_id'];					
				$mass_navigation[] = $data[$cur_cat];
				$level++;
			}			
			$mass_navigation = array_reverse($mass_navigation); // сортировка в правильной последовательности				
			$this->template->assign('mass_navigation', $mass_navigation);
			$this->template->assign('level', $level);
		}
		
		
		
		if (!empty($id_category) AND $action == "edit"){
			$query = $this->conn->newStatement("SELECT * FROM category WHERE id=:id_category:");
			$query->setInteger('id_category', $id_category);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_category_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$id_category = $this->request->getValue("id_category"); // только когда редактируем
		
		if (!empty($id_category) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE category SET name=:name:, text=:text:, ext=:ext:, title=:title: WHERE id=:id_category:");
	        $query->setInteger('id_category', $id_category);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM category");
			$pos = (int)$query_pos->getOneValue();
								
			$query = $this->conn->newStatement("INSERT INTO category SET name=:name:, text=:text:, title=:title:, ext=:ext:, active=:active:, pos=:pos:, parent_id=:parent_id:, main=:main:");
			$query->setInteger('active', 1);
			$query->setInteger("pos", $pos?$pos:1);
			$query->setInteger("parent_id", $parent_id);
			$query->setInteger("main", 0);
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
			
			if (!empty($id_category) && $action == "edit"){
				$id_new = $id_category;
			}
			else{
				$id_new = $query->getInsertId();
			}
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/category/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/category/{$id_new}_tmp.{$image_type}");
			
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
				$tmp_img->resizeProportionally("uploaded/category/{$id_new}.{$image_type}", 1024, 1);
			}
			elseif ($image_height > 800 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/category/{$id_new}.{$image_type}", 800, 1);
			}
			else{
				copy("uploaded/category/{$id_new}_tmp.{$image_type}", "uploaded/category/{$id_new}.{$image_type}");
			}
			
								
			$this->formData['type_resize'] = 1;
			
                        //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ

                        if($img_position==1 OR $img_position==3){  // гориз.
                                $tmp_img->resizeProportionally("uploaded/category/{$id_new}_icon.{$image_type}", 35, 1);
                                $tmp_img->resizeProportionally("uploaded/category/{$id_new}_prev.{$image_type}", 100 ,1);
                                $tmp_img->resizeProportionally("uploaded/category/{$id_new}_sm.{$image_type}", 170, 1);
                        }
                        else{ // вертик.
                                $tmp_img->resizeProportionallyHeight("uploaded/category/{$id_new}_icon.{$image_type}", 35, 1);
                                $tmp_img->resizeProportionallyHeight("uploaded/category/{$id_new}_prev.{$image_type}", 100 ,1);
                                $tmp_img->resizeProportionallyHeight("uploaded/category/{$id_new}_sm.{$image_type}", 170, 1);
                        }
				
				// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
				//$tmp_img->resizeProportionally("uploaded/category/{$id_new}_sm.{$image_type}", 200, 1);
			
			
			
			FileSystem::deleteFile("uploaded/category/{$id_new}_tmp.{$image_type}");
			
			$query = $this->conn->newStatement('UPDATE category SET img_position=:img_position: WHERE id=:id:');
	        $query->setInteger('id', $id_new);
	        $query->setInteger('img_position', $img_position);
			$query->execute();
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
		
		$this->response->redirect("/admin/category/list/{$parent_id}/");
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_category_add.tpl"));
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
		$query = $conn->newStatement("SELECT * FROM category WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/category/{$id}_icon.{$data['ext']}");
		FileSystem::deleteFile("uploaded/category/{$id}_prev.{$data['ext']}");
		FileSystem::deleteFile("uploaded/category/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/category/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE category SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		
		return $xajax;
	}
	
}
?>