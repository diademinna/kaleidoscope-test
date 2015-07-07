<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminParameterAddPage extends FormPageModule {
		
	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
                $this->template->assign('unit', "parameter");
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$this->template->assign('parent_id', $parent_id?$parent_id:"0");
		
		$id_parameter = $this->request->getValue("id_parameter"); // только когда редактируем
		$this->template->assign('id_parameter', $id_parameter);
                
		
		// ФОРМИРУЕМ НАВИГАЦИЮ.
		if($id_parameter){  // выбрана какая-то категория				
			// достаем все категории
			$query = $this->conn->newStatement("SELECT * FROM parameter ORDER BY parent_id ASC, id ASC");
			$data = $query->getAllRecords('id');

			// ищем для навигации родительские категории
			$mass_navigation =array();
			$cur_cat = $id_parameter; // текущая категория для навигации
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
		
		
		
		if (!empty($id_parameter) AND $action == "edit"){
			$query = $this->conn->newStatement("SELECT * FROM parameter WHERE id=:id_parameter:");
			$query->setInteger('id_parameter', $id_parameter);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_parameter_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$id_parameter = $this->request->getValue("id_parameter"); // только когда редактируем
		
		if (!empty($id_parameter) && $action == "edit"){
			$query = $this->conn->newStatement("UPDATE parameter SET name=:name:, ext=:ext: WHERE id=:id_parameter:");
	        $query->setInteger('id_parameter', $id_parameter);
		}
		else{
			
								
                    $query = $this->conn->newStatement("INSERT INTO parameter SET name=:name:, ext=:ext:, parent_id=:parent_id:");
                    $query->setInteger("parent_id", $parent_id);
		}
		
		$query->setVarChar('name', $this->formData['name']);
		
		$image = $this->request->getValue("image");
		if ($image['tmp_name']){ // Если картинку ЗАГРУЖАЮТ
			
			// расширение
			$image_pieces = explode(".", $image['name']);
			$image_type = $image_pieces[count($image_pieces)-1];
			$query->setVarChar('ext', $image_type);
			$query->execute();
			
			if (!empty($id_parameter) && $action == "edit"){
				$id_new = $id_parameter;
			}
			else{
				$id_new = $query->getInsertId();
			}
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/parameter/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/parameter/{$id_new}_tmp.{$image_type}");
			
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
				$tmp_img->resizeProportionally("uploaded/parameter/{$id_new}.{$image_type}", 1024, 1);
			}
			elseif ($image_height > 800 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/parameter/{$id_new}.{$image_type}", 800, 1);
			}
			else{
				copy("uploaded/parameter/{$id_new}_tmp.{$image_type}", "uploaded/parameter/{$id_new}.{$image_type}");
			}
			
								
			$this->formData['type_resize'] = 1;
			
                        //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ

                        if($img_position==1 OR $img_position==3){  // гориз.
                               
                                $tmp_img->resizeProportionally("uploaded/parameter/{$id_new}_sm.{$image_type}", 25, 1);
                        }
                        else{ // вертик.
                               
                                $tmp_img->resizeProportionallyHeight("uploaded/parameter/{$id_new}_sm.{$image_type}", 25, 1);
                        }
				
				// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
				//$tmp_img->resizeProportionally("uploaded/parameter/{$id_new}_sm.{$image_type}", 200, 1);
			
			
			
			FileSystem::deleteFile("uploaded/parameter/{$id_new}_tmp.{$image_type}");
			
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
		
		$this->response->redirect("/admin/parameter/list/{$parent_id}/");
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_parameter_add.tpl"));
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
		$query = $conn->newStatement("SELECT * FROM parameter WHERE id={$id}");
		$data = $query->getFirstRecord();
		FileSystem::deleteFile("uploaded/parameter/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/parameter/{$id}.{$data['ext']}");
		
		$xajax->remove("photo");
		
		return $xajax;
	}
	
}
?>