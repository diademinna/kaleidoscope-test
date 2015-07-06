<?php
require_once("util/ImageUtil.class.php");

class AdminBlogPhotoAddPage extends AbstractPageModule {	
	
	var $page;
	var $get_param;
	
	public function doBeforeOutput() {
		if(!$this->request->getValue("swfupload")){
			$this->Authenticate();
		}
		$this->registerThis('reSaveName', 'deleteImage', "Sort");
		$this->processRequest();		
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
	}	
	
	public function doContent() {
		$id_blog = $this->request->getValue("id_blog");
		$this->template->assign("id_blog", $id_blog);
		
		$parent_id = $this->request->getValue("parent_id");
		$this->template->assign("parent_id", $parent_id);
		
		$flag_swfupload = $this->request->getValue("swfupload");
		
		if (!empty($id_blog) AND !$flag_swfupload){
			$conn = &DbFactory::getConnection();
			$query = $conn->newStatement("SELECT * FROM blog_photo WHERE id_blog=:id: ORDER BY pos DESC, id DESC");
			$query->setInteger('id', $id_blog);
			$data_photo = $query->getAllRecords();
			
			$this->template->assign("data_photo", $data_photo);
		}
		
		
		if($flag_swfupload){ // значит заливаем картинки мультизагрузкой
				if (isset($_POST["PHPSESSID"])) {
					session_id($_POST["PHPSESSID"]);
				}
				session_start();

				if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
					$this->showError();
				} 
				else {
					$id = (int)$_POST['id_from_swfupload'];  // к какой записи относится данная картинка
					$type_resize = (int)$_POST['type_resize'];
					$name_img = $_POST['name_img'];					
					
					$image = &$_FILES["Filedata"];	
					FileSystem::createFolder("uploaded/blog/{$id}", 0777);
					//if ($image['tmp_name']){ // Если картинку ЕСТЬ

						// расширение
						$image_pieces = explode(".", $image['name']);
						$image_type = $image_pieces[count($image_pieces)-1];

						$conn = &DbFactory::getConnection();
						
						$query_pos = $conn->newStatement("SELECT MAX(pos)+1 FROM blog_photo");
						$pos = (int)$query_pos->getOneValue();
						if(!$pos){
							$pos = 1;
						}
						
						$query = $conn->newStatement('INSERT INTO blog_photo SET id_blog=:id_blog:, ext=:ext:, name=:name:, pos=:pos:');
						$query->setVarChar('ext', $image_type);
						$query->setVarChar('name', $name_img?$name_img:"");
						$query->setInteger('id_blog', $id);
						$query->setInteger("pos", $pos);
						$query->execute();
						$id_new = $query->getInsertId();
						
						////
						ImageUtil::uploadImage($image['tmp_name'], "uploaded/blog/{$id}/",  "{$id_new}_tmp.{$image_type}");
						$tmp_img = new ImageUtil("uploaded/blog/{$id}/{$id_new}_tmp.{$image_type}");

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
						$WIDTH_PHOTO_SM = 188;
						$HEIGHT_PHOTO_SM = 140;

						// создание большой картинки 
						if($image_width > 1200 AND ($img_position==1 OR $img_position==3) ){ // широкая
							$tmp_img->resizeProportionally("uploaded/blog/{$id}/{$id_new}.{$image_type}", 1200, 1);
						}
						elseif ($image_height > 900 AND $img_position==2) { // высокая
							$tmp_img->resizeProportionallyHeight("uploaded/blog/{$id}/{$id_new}.{$image_type}", 900, 1);
						}
						else{
							copy("uploaded/blog/{$id}/{$id_new}_tmp.{$image_type}", "uploaded/blog/{$id}/{$id_new}.{$image_type}");
						}


						if($type_resize == 1){
							//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
							if($img_position==1 OR $img_position==3){  // гориз.
								$tmp_img->ResizeFromRaf($WIDTH_PHOTO_SM, $HEIGHT_PHOTO_SM, "uploaded/blog/{$id}/{$id_new}_sm.{$image_type}");
							}
							else{ // вертик.
								$tmp_img->ResizeFromRaf($HEIGHT_PHOTO_SM, $WIDTH_PHOTO_SM, "uploaded/blog/{$id}/{$id_new}_sm.{$image_type}");
							}

							// РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
							//$tmp_img->resizeProportionally("uploaded/blog/{$id}/{$id_new}_sm.{$image_type}", 200, 1);
						}
						elseif ($type_resize == 2){
							//  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ С ПУСТЫМИ ПОЛЯМИ
							if($img_position==1 OR $img_position==3){  // гориз.
								$tmp_img->Resize($WIDTH_PHOTO_SM, $HEIGHT_PHOTO_SM, "uploaded/blog/{$id}/{$id_new}_sm.{$image_type}");
							}
							else{ // вертик.
								$tmp_img->Resize($HEIGHT_PHOTO_SM, $WIDTH_PHOTO_SM, "uploaded/blog/{$id}/{$id_new}_sm.{$image_type}");
							}
						}			

						FileSystem::deleteFile("uploaded/blog/{$id}/{$id_new}_tmp.{$image_type}");

						$query = $conn->newStatement('UPDATE blog_photo SET img_position=:img_position: WHERE id=:id:');
						$query->setInteger('id', $id_new);
						$query->setInteger('img_position', $img_position);
						$query->execute();
						
						echo "файл загружен";
					}
				//}
		}

				
		$this->response->write($this->renderTemplate("admin/admin_blog_photo_add.tpl"));
	}
	
	function showError() {
		header("HTTP/1.1 500 File Upload Error");
		exit("0");
	}
	
	
	//*** DEVELOPER AJAX ***//
	
	// Удалить картинку из выбранного элемента
	function deleteImage($id_blog, $id_image){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM blog_photo WHERE id={$id_image}");
		$data = $query->getFirstRecord();
		
		FileSystem::deleteFile("uploaded/blog/{$id_blog}/{$id_image}_sm.{$data['ext']}");
		FileSystem::deleteFile("uploaded/blog/{$id_blog}/{$id_image}.{$data['ext']}");
		
		$query = $conn->newStatement("DELETE FROM blog_photo WHERE id={$id_image}");
		$query->execute();				
		
		$xajax->remove("form_item_".$id_image);
		$xajax->remove("item_".$id_image);
		
		return $xajax;
	}
	
	
	// Пересохранить название картинки 
	function reSaveName($formData, $id){
		$objResponse = new xajaxResponse();
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("UPDATE blog_photo SET name=:name: WHERE id=:id:");
		$query->setVarChar("name", $formData);
		$query->setInteger("id", $id);
		$query->execute();
		
		$objResponse->script('alert("Название изображения сохранено!");');

		return $objResponse;
	}
	
	// Сортировка с помощью плагина Sortable
	function Sort($mass_sort, $min_pos=1){ //  $min_pos - минимальное значение позиции на странице.
		$objResponse = new xajaxResponse();
		$conn = &DbFactory::getConnection();
		
		$mass_sort = str_replace('item_', "", $mass_sort);
		$mass_sort = array_reverse($mass_sort); // сортировка в обратном порядке.
		
		//print_r($mass_sort);die();
		foreach ($mass_sort as $key => $value) {
			$query = $conn->newStatement("UPDATE blog_photo SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}
		
		return $objResponse;
	}
	
	
	
}
?>