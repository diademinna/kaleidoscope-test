<?php

class ErrorOut {
	const PROGRAMMER_EMAIL = 'rafael@aitov.info';
	
	private $sendMail = false;
	
	function __construct($work){
		$this->sendMail = $work;
	}
	
	static function getError($errno){
		$errors = array (
			E_ERROR => "Error",
	  	E_WARNING => "Warning",
	  	E_PARSE => "Parse Error",
	  	E_NOTICE => "Notice",
	  	E_CORE_ERROR => "Core Error",
	  	E_CORE_WARNING => "Core Warning",
	  	E_COMPILE_ERROR => "Compile Error",
	  	E_COMPILE_WARNING => "Compile Warning",
	  	E_USER_ERROR => "User Error",
	  	E_USER_WARNING => "User Warning",
	  	E_USER_NOTICE => "User Notice",
	  	E_STRICT => "Strict Notice",
	  	//E_RECOVERABLE_ERROR => "Recoverable Error",
	  	"~" => "Unknown error ($errno)");
  	return isset($errors[$errno])?$errors[$errno]:$errors["~"];
	}
  
	function error_handler($errno, $errstr, $errfile, $errline) {
		if($errno >= 8 && $errno != E_USER_ERROR && $errno != E_USER_WARNING) return false;
		
		$errType = $this->getError($errno);
		
		if($this->sendMail){
			$email = "{$errType}: {$errstr}\nFile: {$errfile}\nLine: {$errline}";
			$email .= "\n\nsite: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if(class_exists("User")){
				if($user = User::getInstance()){
					$email .= "\n\nuser: id=".$user->getId().", email=".$user->getEmail();
				}
			}
			if($_POST){
				ob_clean();
				ob_start();
				print_r($_POST);
				$email .= "\n\npost:\n".ob_get_contents();
				ob_end_clean();
				
			}
			if($errno == E_ERROR){
				mail(self::PROGRAMMER_EMAIL, 'FatBurningTracker.com ' . $errType, $email);
			}
			else{
				require_once('module/common/log/LogMessage.class.php');
				if(class_exists("LogMessage")){
					LogMessage::PutLogError($email);
				}
			}
			//echo $email."<br/><br/>";
		}
		else{
			echo "<div style='background-color:#faa;color:white;padding:5px;margin:10px;'>{$errType} - <b>{$errstr}</b><br/>File: <b>{$errfile}</b>, Line: <b>{$errline}</b></div>";
		}
	}
	
}