<?php

//E-MAIL
define("ADMIN_EMAIL", 'diademinna@yandex.ru');

// DEFINE
//define('DEFAULT_CONNECTION', 'MySql://root:@localhost/kaleidoscope-test');
define('DEFAULT_CONNECTION', 'MySql://diademinna:sapr2014aaa@diademinna.myjino.ru/diademinna_sapr');
define("HTTP_REFERER", $_SERVER['HTTP_REFERER']);
define("BASE_URL", "http://".$_SERVER['SERVER_NAME']."/");
define('CONTENT', 'templates/content/');
define('CACHE_DIR', 'var/');

// DEBUG_INFORMATION  - Раскоментировать если необходимо. + раскоментировать внизу страницы.
//define('SHOW_DEBUG_INFORMATION', 1);
//if (defined('SHOW_DEBUG_INFORMATION')) {
//	function getmicrotime() {
//		$mt = explode(" ", microtime() );
//		return ((float)$mt[0] + (float)$mt[1]);
//	}
//	$time[0] = getmicrotime();
//	$GLOBALS['test_counter'] = 0;
//	$GLOBALS['sql_list'] = "";
//}

// LOCALE
setlocale(LC_ALL, "ru_RU.utf8");
ini_set("default_charset", "UTF-8");

// INCLUDE
$include_path = "." . PATH_SEPARATOR . "req";
set_include_path($include_path . PATH_SEPARATOR . get_include_path() );
require_once("req/dispatcher/ArrayRequestDispatcher.class.php");
require_once("req/http/HttpRequest.class.php");
require_once("req/http/HttpResponse.class.php");
require_once("module/AbstractPageModule.class.php");

class SpApplication  {

	var $dispatcher;
	var $values;
	var $request;
	var $response;
	
	function SpApplication() {
		$this->request = new HttpRequest();
		$this->response = new HttpResponse();
		$this->dispatcher = new ArrayRequestDispatcher($this->request, $this->response);
		
		set_magic_quotes_runtime(0);
		$include_path = "req";
		set_include_path(get_include_path() . PATH_SEPARATOR . $include_path);		
		$GLOBALS['_application'] =& $this;
	}
	
  
	function & getInstance() {
		if (!isset($GLOBALS["_application"])) {
			$GLOBALS["_application"] = new SpApplication();
		} 
		return $GLOBALS["_application"];
	}
	
	function setValue($name, $value) {
		$this->values[$name] = $value;
	}
	
	function getValue($name) {
		return $this->values[$name];
	}
	
	function hasValue($name) {
		return isset($this->values[$name]);
	}
	
	function startUp() {
		@session_start();
	}
	
	function shutDown() {
		$this->response->flush(); // send result to client
	}
	
	function run(){
		$this->startUp();
		$module = $this->dispatcher->dispatch(); 
		$module->doBeforeOutput();
		$module->doContent();
		$module->doAfterOutput();
		$this->shutDown();
	}

	function & getRequest() {
		return $this->request;
	}
	
	function & getResponse() {
		return $this->response;
	}
}

// run application
$myApp = new SpApplication();
$myApp->run();


//if (defined('SHOW_DEBUG_INFORMATION')) {
//	$time[1] = getmicrotime();
//	$time[9] = $time[1] - $time[0];
//	print_r("<br/><br/>-------------------------<br/>");
//	print_r("<b>Time:</b> {$time[9]} <br/>");
//	print_r("<b>Queries count:</b> ".$GLOBALS['test_counter']." <br/>");
//	print_r("<b>Queries list:</b> <pre>".$GLOBALS['sql_list']."</pre><br/>");
//	print_r("<b>Memory:</b> ".round((memory_get_usage()/(1024*1024)), 3)." Mb. ");
//}

?>