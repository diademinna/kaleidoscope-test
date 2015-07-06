<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminProductParamAddPage extends FormPageModule {
		
	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
                $this->template->assign('unit', "product_param");
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$this->template->assign('parent_id', $parent_id?$parent_id:"0");
		
		$id_product_param = $this->request->getValue("id_product_param"); // только когда редактируем
		$this->template->assign('id_product_param', $id_product_param);
		
		// ФОРМИРУЕМ НАВИГАЦИЮ.
		if($id_product_param){  // выбрана какая-то категория				
                    // достаем все категории
                    $query = $this->conn->newStatement("SELECT * FROM product_param ORDER BY parent_id ASC, id ASC");
                    $data = $query->getAllRecords('id');

                    // ищем для навигации родительские категории
                    $mass_navigation =array();
                    $cur_cat = $id_product_param; // текущая категория для навигации
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
		
		
		
		if (!empty($id_product_param) AND $action == "edit"){
                    $query = $this->conn->newStatement("SELECT * FROM product_param WHERE id=:id_product_param:");
                    $query->setInteger('id_product_param', $id_product_param);
                    $data = $query->getFirstRecord();
                    $this->template->assign('data', $data);
                    
		}
		
		$this->response->write($this->renderTemplate('admin/admin_product_param_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$id_product_param = $this->request->getValue("id_product_param"); // только когда редактируем
		
		if (!empty($id_product_param) && $action == "edit"){
                    $query = $this->conn->newStatement("UPDATE product_param SET name=:name:, ext=:ext: WHERE id=:id_product_param:");
                    $query->setInteger('id_product_param', $id_product_param);
		}
		else{
                    $query = $this->conn->newStatement("INSERT INTO product_param SET name=:name:,  ext=:ext:, parent_id=:parent_id:");

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

                    if (!empty($id_product_param) && $action == "edit"){
                            $id_new = $id_product_param;
                    }
                    else{
                            $id_new = $query->getInsertId();
                    }

                    ImageUtil::uploadImage($image['tmp_name'], "uploaded/product_param/",  "{$id_new}_tmp.{$image_type}");
                    $tmp_img = new ImageUtil("uploaded/product_param/{$id_new}_tmp.{$image_type}");

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
                        $tmp_img->resizeProportionally("uploaded/product_param/{$id_new}.{$image_type}", 1024, 1);
                    }
                    elseif ($image_height > 800 AND $img_position==2) { // высокая
                        $tmp_img->resizeProportionallyHeight("uploaded/product_param/{$id_new}.{$image_type}", 800, 1);
                    }
                    else{
                        copy("uploaded/product_param/{$id_new}_tmp.{$image_type}", "uploaded/product_param/{$id_new}.{$image_type}");
                    }


                    $this->formData['type_resize'] = 1;

                    //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ

                    if($img_position==1 OR $img_position==3){  // гориз.
                           
                        $tmp_img->resizeProportionally("uploaded/product_param/{$id_new}_sm.{$image_type}", 15, 1);
                    }
                    else{ // вертик.
                           
                        $tmp_img->resizeProportionallyHeight("uploaded/product_param/{$id_new}_sm.{$image_type}", 15, 1);
                    }

                    
			
                    FileSystem::deleteFile("uploaded/product_param/{$id_new}_tmp.{$image_type}");
			
		
		}
		else{ // Если картинку не загружают
                    $query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
                    $query->execute();
		}
		
		$this->response->redirect("/admin/product_param/list/{$parent_id}/");
	}
	
	
	public function doFormInvalid(){
            $this->template->assign('data', $this->formData);
            $this->response->write($this->renderTemplate("admin/admin_product_param_add.tpl"));
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
            $query = $conn->newStatement("SELECT * FROM product_param WHERE id={$id}");
            $data = $query->getFirstRecord();

            FileSystem::deleteFile("uploaded/product_param/{$id}_sm.{$data['ext']}");
            FileSystem::deleteFile("uploaded/product_param/{$id}.{$data['ext']}");

            $xajax->remove("photo");

            return $xajax;
	}
	
}
?>