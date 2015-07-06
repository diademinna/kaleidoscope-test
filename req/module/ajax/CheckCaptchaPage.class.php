<?php
require_once("module/AbstractPageModule.class.php");

class CheckCaptchaPage extends AbstractPageModule {
	
	function doContent(){
		
		$text_kcaptcha = $this->request->getValue('text_kcaptcha');
		

		if( isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $text_kcaptcha ){
			echo json_encode(array('data_ajax'=>'ok'));
		}
		else{
			echo json_encode(array('data_ajax'=>'error'));
		}



		die();
	}
}
?>