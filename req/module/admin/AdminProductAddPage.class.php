<?php

require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminProductAddPage extends FormPageModule {
		
	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("deleteImage");
		$this->processRequest();
		
		$this->template->assign("tinymce", 1);
                $this->template->assign('unit', "product");
                
                if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
                 $query = $this->conn->newStatement("SELECT id, name, main FROM category WHERE active=1 AND parent_id=0 ORDER BY name");
	        $data_category = $query->getAllRecords();
                if ($data_category)
                {
                    foreach ($data_category as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT id, name, main FROM category WHERE active=1 AND parent_id=:id: ORDER BY name");
                        $query->setInteger('id', $value['id']);
                        $data_sub_category = $query->getAllRecords();
                        if ($data_sub_category){
                            $data_category[$key]['subcategory'] = $data_sub_category;
                        }
                    }
                }
                $this->template->assign('data_category', $data_category);
		
		
	}
	
	
	public function doFormInit(){
		$action = $this->request->getValue("action");
		
		$id = $this->request->getValue("id"); // только когда редактируем
		
		if(!empty($id) AND $action == "edit"){
			$query = $this->conn->newStatement("SELECT * FROM product WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			$this->template->assign('data', $data);
		}
		$this->response->write($this->renderTemplate('admin/admin_product_add.tpl'));
	}
	
	
	public function doFormValid() {
		$action = $this->request->getValue("action");
		$parent_id = $this->request->getValue("parent_id"); 
		$id = $this->request->getValue("id"); // только когда редактируем
		
		$this->formData['cost'] = trim($this->formData['cost']);
		$this->formData['cost'] = str_replace(" ", "", $this->formData['cost']);
  
		if(!empty($id) && $action == "edit"){
			$query = $this->conn->newStatement("
				UPDATE product SET 
					name=:name:,
                                        id_category=:id_category:,
					price=:price:,
					old_price=:old_price:,
					text=:text:,
					ext=:ext:, 
					title=:title: 
				WHERE id=:id:
			");
	        $query->setInteger('id', $id);
		}
		else{
			$query_pos = $this->conn->newStatement("SELECT MAX(pos)+1 FROM product");
			$pos = (int)$query_pos->getOneValue();
								
			$query = $this->conn->newStatement("
				INSERT INTO product SET 			
					id_category=:id_category:,
					name=:name:,
					price=:price:,
					old_price=:old_price:,
					code=:code:,
					text=:text:, 			 
					ext=:ext:,
					title=:title:,
					active=:active:,
					pos=:pos:
			");
			$query->setInteger('active', 1);			
			$query->setInteger("pos", $pos?$pos:1);			
		}
		
                $query->setInteger("id_category", $this->formData['id_category']);
		$query->setVarChar('name', $this->formData['name']);
		$query->setFloat('price', $this->formData['price']?$this->formData['price']:NULL);
		$query->setFloat('old_price', $this->formData['old_price']?$this->formData['old_price']:NULL);
		$query->setVarChar('code', $this->formData['code']);
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
			
			ImageUtil::uploadImage($image['tmp_name'], "uploaded/product/",  "{$id_new}_tmp.{$image_type}");
			$tmp_img = new ImageUtil("uploaded/product/{$id_new}_tmp.{$image_type}");
			
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
				$tmp_img->resizeProportionally("uploaded/product/{$id_new}.{$image_type}", 1024, 1);
			}
			elseif ($image_height > 800 AND $img_position==2) { // высокая
				$tmp_img->resizeProportionallyHeight("uploaded/product/{$id_new}.{$image_type}", 800, 1);
			}
			else{
				copy("uploaded/product/{$id_new}_tmp.{$image_type}", "uploaded/product/{$id_new}.{$image_type}");
			}
			$this->formData['type_resize'] = 1;
			if($this->formData['type_resize'] == 1){
                            //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ

                            if($img_position==1 OR $img_position==3){  // гориз.
                                $tmp_img->resizeProportionally("uploaded/product/{$id_new}_sm.{$image_type}", 165, 1);
                                $tmp_img->resizeProportionally("uploaded/product/{$id_new}_prev.{$image_type}", 270, 1);
                                $tmp_img->resizeProportionally("uploaded/product/{$id_new}_buy.{$image_type}", 100, 1);
                            }
                            else{ // вертик.
                                 $tmp_img->resizeProportionallyHeight("uploaded/product/{$id_new}_sm.{$image_type}", 165, 1);
                                 $tmp_img->resizeProportionallyHeight("uploaded/product/{$id_new}_prev.{$image_type}", 270, 1);
                                 $tmp_img->resizeProportionallyHeight("uploaded/product/{$id_new}_buy.{$image_type}", 100, 1);
                            }
				
				
			}
			
			FileSystem::deleteFile("uploaded/product/{$id_new}_tmp.{$image_type}");
			
			$query = $this->conn->newStatement('UPDATE product SET img_position=:img_position: WHERE id=:id:');
	        $query->setInteger('id', $id_new);
	        $query->setInteger('img_position', $img_position);
                $query->execute();
                
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
                      
                        $query->execute();
                        if ($action != 'edit')
                            $id_new = $query->getInsertId();
		}
                if ($action != "edit")
                {
                    $query = $this->conn->newStatement('INSERT INTO product_info SET views=:views:, buys=:buys:, id_product=:id_product:');
                    $query->setInteger('views', 0);
                    $query->setInteger('buys', 0);
                    $query->setInteger('id_product', $id_new);
                    $query->execute();
                    
                    $query = $this->conn->newStatement("UPDATE product SET code=:code: WHERE id=:id:");
                    $query->setInteger('id', $id_new);
                    $query->setInteger('code', $this->formData['id_category'].$id_new);
                    $query->execute();
                }
		
		$this->response->redirect("/admin/product/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}
	
	
	public function doFormInvalid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate("admin/admin_product_add.tpl"));
	}
	
	
	function doValidation(){		
		$rules = array(
			new EmptyFieldRule("name", 'Название'),
			new EmptyFieldRule("id_category", 'Категория'),
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
		$query = $conn->newStatement("SELECT * FROM product WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/product/{$id}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/product/{$id}_prev.{$data['ext']}");
		FileSystem::deleteFile("uploaded/product/{$id}_buy.{$data['ext']}");
		FileSystem::deleteFile("uploaded/product/{$id}.{$data['ext']}");
		
		$query = $conn->newStatement("UPDATE product SET ext=NULL, img_position=0 WHERE id={$id}");
		$query->execute();
		
		$xajax->remove("photo");
		
		return $xajax;
	}
	
}
?>