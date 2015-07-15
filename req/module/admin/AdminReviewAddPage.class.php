<?php
require_once("module/FormPageModule.class.php");
require_once("validator/Validator.class.php");
require_once("util/ImageUtil.class.php");

class AdminReviewAddPage extends FormPageModule{
	
	var $page;
	var $get_param;

	public function doBeforeOutput(){
		$this->Authenticate();
		
		$this->template->assign("tinymce", 1);
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$this->get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		$this->template->assign('get_param', $this->get_param);
		
		$this->page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $this->page);
                $this->template->assign('unit', "review");
		
	}
	
	public function doFormInit() {
		$action = $this->request->getValue('action');
		$id = $this->request->getValue('id');		
				
		if (!empty($id) AND $action == "edit") {
			$query = $this->conn->newStatement("SELECT * FROM review WHERE id=:id:");
			$query->setInteger("id", $id);
			$data = $query->getFirstRecord();
			
			if($data['date'] AND $data['date']!="0000-00-00"){ // преобразование даты
				$temp = explode("-", $data['date']);
				$data['date'] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
			}
			
			$this->template->assign('data', $data);
		}
		
		$this->response->write($this->renderTemplate('admin/admin_review_add.tpl'));
	}
  
	 
	public function doFormValid(){
		$action = $this->request->getValue("action");
		$id = $this->request->getValue('id');
		
		
		// преобразование даты
		if($this->formData["date"]){
			$temp = explode("-", $this->formData["date"]);
			$this->formData["date"] = "{$temp[2]}-{$temp[1]}-{$temp[0]}";
		}
		else{
			$this->formData["date"] = date('Y-m-d');  // берем текущую
		}
		
				
		if (!empty($id) AND $action == 'edit') {
			 $query = $this->conn->newStatement("UPDATE review SET fio=:fio:, text=:text:, email=:email:, date=:date:, ext=:ext: WHERE id=:id:");
			 $query->setInteger('id', $id); 
		}
		else{
			
			$query = $this->conn->newStatement("INSERT INTO review SET fio=:fio:, text=:text:, email=:email:, date=:date:,  ext=:ext:, active=:active:");
			$query->setInteger('active', 1);
		}
		
		$query->setVarChar("fio", $this->request->getValue('fio'));
		$query->setText("text", $this->request->getValue('text'));
		$query->setVarChar("email", $this->request->getValue('email'));
		$query->setDate("date", $this->formData['date']);
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

                    ImageUtil::uploadImage($image['tmp_name'], "uploaded/review/",  "{$id_new}_tmp.{$image_type}");
                    $tmp_img = new ImageUtil("uploaded/review/{$id_new}_tmp.{$image_type}");

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
                            $tmp_img->resizeProportionally("uploaded/review/{$id_new}.{$image_type}", 1024, 1);
                    }
                    elseif ($image_height > 800 AND $img_position==2) { // высокая
                            $tmp_img->resizeProportionallyHeight("uploaded/review/{$id_new}.{$image_type}", 800, 1);
                    }
                    else{
                            copy("uploaded/review/{$id_new}_tmp.{$image_type}", "uploaded/review/{$id_new}.{$image_type}");
                    }
					
                    $this->formData['type_resize'] = 1;
                    if($this->formData['type_resize'] == 1){
                            //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
                            if($img_position==1 OR $img_position==3){  // гориз.
                                   $tmp_img->ResizeFromRaf(130, 130, "uploaded/review/{$id_new}_sm.{$image_type}");
                            }
                            else{ // вертик.
                                    $tmp_img->ResizeFromRaf(130, 130, "uploaded/review/{$id_new}_sm.{$image_type}");
                            }

                            // РЕCАЙЗИТЬ ПРОПОРЦИОНАЛЬНО ШИРИНЕ!
                            //$tmp_img->resizeProportionally("uploaded/review/{$id_new}_sm.{$image_type}", 200, 1);
                    }
			
			
                    FileSystem::deleteFile("uploaded/review/{$id_new}_tmp.{$image_type}");
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
		
		$this->response->redirect("/admin/review/list/{$this->page}/".($this->get_param?$this->get_param:"") );
	}	
	
	public function doFormInValid(){
		$this->template->assign('data', $this->formData);
		$this->response->write($this->renderTemplate('admin/admin_review_add.tpl'));
	}
	
	function doValidation(){
		$rules = array(
			new EmptyFieldRule("fio", 'ФИО'),
			new EmptyFieldRule("text", 'Сообщение')			
		);
		$validator = new Validator($this->formData);
		
		if (!$validator->validate($rules)) {
			$this->template->assign('errors', $validator->getErrorList());
			return false;
		}
		else return true;
	}
}

?>