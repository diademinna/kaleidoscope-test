<?php
require_once("external/kcaptcha/kcaptcha.php");

class Captcha extends AbstractPageModule {
	
    function doContent() {
    	//print_r(111);die();
        $captcha = new KCAPTCHA();
        HttpSession::getInstance()->set('captcha_keystring',$captcha->getKeyString());
    }
    
}