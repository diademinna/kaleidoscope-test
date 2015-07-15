<?php
require_once('module/FormPageModule.class.php');
require_once('validator/Validator.class.php');
require_once('util/MailUtil.class.php');
require_once("util/ImageUtil.class.php");

class ReviewPage extends FormPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
		
		
		$page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $page);
		
		define('COUNT_PAGE', 10);
		require_once 'module/common/PagerFactory.class.php';
		$pager = new PagerFactory();
		$sql = "SELECT * FROM review WHERE active=1 ORDER BY id DESC";
		$fromWhereCnt = "review WHERE active=1";
		$href = "/review/";
		
		$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
		$data = $pager->getPageData();
		
		$this->template->assign('pager_string', $pagerString);
		$this->template->assign('data_review', $data);
		
		$this->setPageTitle("Отзывы");
	}

	function doFormInit(){		
		$this->response->write($this->renderTemplate('review.tpl'));
	}
	
	function doFormValid(){
		//print_r($this->formData);die();
		$mail = new MailUtil();
		$mail->setTo(ADMIN_EMAIL);
		$mail->setSubject('Поступил новый отзыв');
		if($this->formData['email']){
			$email = $this->formData['email'];
		}
		else {
			$email = "{$_SERVER['HTTP_HOST']} <".ADMIN_EMAIL.">";
		}
		$mail->setFrom($email);		
		$tdata = array(
                    'text' => $this->formData['text'],
                    'fio' => $this->formData['fio'],
                    'email' => $this->formData['email'],
                );
		
		$mail->setEmailTextTemplate('mail/review_mail.tpl',$tdata);
		if (!$mail->doSend()){
			$this->template->assign('errors', array("Не возможно отправить Ваше сообщение. Попробуйте позже."));
		}
		else{
			$this->template->assign('notes', array('Спасибо! Ваш отзыв принят. После проверки модератором, он появится на сайте.'));
		}
		
			
		$query = $this->conn->newStatement("INSERT INTO review SET text=:text:, fio=:fio:, email=:email:,  date=now(), ext=:ext:");		
		$query->setText('text', $this->formData['text']);
		$query->setVarChar('fio', $this->formData['fio']);
		$query->setVarChar('email', $this->formData['email']);
		$image = $this->request->getValue("image");
		if ($image['tmp_name']){ // Если картинку ЗАГРУЖАЮТ
			
                    // расширение
                    $image_pieces = explode(".", $image['name']);
                    $image_type = $image_pieces[count($image_pieces)-1];
                    $query->setVarChar('ext', $image_type);
                    $query->execute();

                  
                    $id_new = $query->getInsertId();

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
                   
                    //  РЕСАЙЗИТЬ по ОПРЕДЕЛЕННЫМ РАЗМЕРАМ
                    if($img_position==1 OR $img_position==3){  // гориз.
                           $tmp_img->ResizeFromRaf(130, 130, "uploaded/review/{$id_new}_sm.{$image_type}");
                    }
                    else{ // вертик.
                            $tmp_img->ResizeFromRaf(130, 130, "uploaded/review/{$id_new}_sm.{$image_type}");
                    }    
			
                    FileSystem::deleteFile("uploaded/review/{$id_new}_tmp.{$image_type}");
		
		}
		else{ // Если картинку не загружают
			$query->setVarChar('ext', $this->formData['ext']?$this->formData['ext']:NULL);
			$query->execute();
		}
				
		$this->response->write($this->renderTemplate('review.tpl'));
	}
	
	function doFormInValid(){		
		$this->template->assign('data_form', $this->formData);				
		$this->response->write($this->renderTemplate('review.tpl'));
	}
	
	
	function doValidation() {
		$rules = array(
			new EmptyFieldRule("fio", 'ФИО'),
			new EmptyFieldRule("text", 'Сообщение'),
			//new EmptyFieldRule("email", "Эл. почта"),
            //new WrongEmailFormatRule("email", "Эл. почта"),
			
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