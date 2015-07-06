<?php
require_once("external/smarty/Smarty.class.php");
require_once("db/DbFactory.class.php");
require_once("http/HttpSession.class.php");
require_once("util/FileSystem.class.php");
require_once("util/Useful.class.php"); // полезные функции
require_once('user/UserAction.class.php'); //(USER если необходим разкоментировать и строку инклуда вверху.)

//*** DEVELOPER INCLUDE ***//


class AbstractPageModule {

	protected $template; // var Smarty
	protected $request;  // var HttpRequest
	protected $response; // HttpResponse
	var $conn; // коннект к БД

	//*** DEVELOPER VAR ***//
	var $user; // храниться информация о залогиненом юзере

	function AbstractPageModule(&$request, &$response) {
		$this->request =& $request;
		$this->response =& $response;

		$this->template =& new Smarty(); // initialize smarty
		$this->conn = &DbFactory::getConnection(); // коннект к БД
                
	}

	function Authenticate() {
		if (isset($_SERVER['PHP_AUTH_USER']) AND ($_SERVER['PHP_AUTH_USER'] == 'admin') AND ($_SERVER['PHP_AUTH_PW'] == 'zero')){
			return true;
		}
		else {
			header('WWW-Authenticate: Basic realm="Please use your mind.."');
			header('HTTP/1.0 401 Unauthorized');
			die('Error Authenticate!');
		}
	}

	// Код инициализации для всех модулей (вызываеть из необходимых модулей) //
	//*** DEVELOPER CODE ***//
	function doInit(){
            
		// XAJAX  - (если  используется раскоментировать)
		//$this->registerThis('func_name'); // общие xajax функции
		//$this->processRequest(); // если есть общие xajax функции или общий вызов для всех классов


		// БЛОК АВТОРИЗАЦИИ ЮЗЕРОВ (если необходим разкоментировать и строку инклуда вверху.)
		// проверка авторизации юзера
		if (!$this->user){
			$this->user = UserAction::isLogin();
		}
		$this->template->assign('user', $this->user);  // в итоге здесь либо FALSE либо данные USERa


		$MN = array('01'=>"Января", '02'=>"Февраля", '03'=>"Марта", '04'=>"Апреля", '05'=>"Мая", '06'=>"Июня", '07'=>"Июля", '08'=>"Августа", '09'=>"Сентября", '10'=>"Октября", '11'=>"Ноября", '12'=>"Декабря");
                $this->template->assign('MN', $MN);

              
                    
                if (isset($_COOKIE['user_cart']))
                {
                    $mass = unserialize($_COOKIE['user_cart']);
                    $cart = array();
                    $total_price = 0;
                    $total_count = 0;
                    foreach ($mass as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT * FROM product WHERE id=:id:");
                        $query->setInteger('id', $value['id_product']);
                        $data = $query->getFirstRecord();
                        $data['count'] = $mass[$key]['count'];
                        $cart[] = $data;
                        $total_price = $total_price + $data['price'] * $data['count'];
                        $total_count = $total_count + $data[$key]['count'];
                    }
                    $this->template->assign('cart', $cart);
                    $this->template->assign('total_price', $total_price);
                    $this->template->assign('total_count', $total_count);

                }
                
	}

	function doBeforeOutput() {
	}

	function doContent() {
	}

	function doAfterOutput() {
	}

	function renderTemplate($templateFileName) {
		return $this->template->fetch($templateFileName);
	}

	function & getTemplate() {
		return $this->template;
	}

	function setTemplate(&$template) {
		$this->template =& $template;
	}


	/* XAJAX - class ajax */
	private $xajax; // @var xajax

	/**
	 * @param string methodName
	 * @param string className
	 */
	public function register($func, $class=null){
		if(!$this->xajax) $this->init();
		$this->xajax->register(XAJAX_FUNCTION, array($func, $class?$class:$this, $func));
	}
	/**
	 * @param string $methodName1
	 * @param string $methodName2
	 * ...
	 */
	protected function registerThis(){
		if(!$this->xajax) $this->init();
		foreach (func_get_args() as $func) {
			$this->xajax->register(XAJAX_FUNCTION, array($func, $this, $func));
		}
	}
	private function init() {
		require_once("external/xajax/xajax.inc.php");
		$this->xajax = new xajax($this->request->url->getPath());
		ob_clean();
	}
	protected function processRequest(){
		$this->xajax->processRequest();
		$this->template->assign('ajaxCode', $this->xajax->getJavascript('/js/'));
	}



	// Общие фунциии разработчика  //
	//*** DEVELOPER CODE ***//

	function setPageTitle($pageTitle) {  // Установить значение тайтла (Title) страницы
		$this->template->assign('page_title', $pageTitle);
	}
	function setPageKeyWords($pageKeywords) { // Установить значение KeyWords страницы
		$this->template->assign('page_keywords', $pageKeywords);
	}
	function setPageDescription($pageDescription) { // Установить значение Description страницы
		$this->template->assign('page_description', $pageDescription);
	}


	// достаем все категории в виде дерева.
//	function GetAllCategoryInTree($active=0) {
//		if($active){
//			$to_where = " WHERE active=1 ";
//		}
//		$query = $this->conn->newStatement("SELECT * FROM category {$to_where} ORDER BY parent_id ASC, pos DESC, id ASC");
//		$data = $query->getAllRecords('id');
//
//		//теперь создаем массив в виде дерева
//		$tree = array();
//		foreach ($data as $cur) {
//			$tree[(int)$cur['parent_id']][] = $cur;
//		}
//	}

	// для админки функция изменения параметров GET
	function ParamGET($val, $get_param, $cur_param){

		if($get_param){ // надо поправить параметры.
			$temp = substr($get_param, 1);  // обрезаем первый символ
			$mass_get = explode("&", $temp); // разбиваем на отдельные параметры

			foreach($mass_get as $key=>$cur){
				// проверяем встречается ли в параметрах ТЕКУЩИЙ параметр
				$pos = strpos($cur, $cur_param);
				if ($pos === false) { // нет
				}
				else { // есть
					unset($mass_get[$key]); // удалил текущий.
				}
			}

			// создаем строку GET
			$new_get_param = "";
			if($val OR sizeof($mass_get)){
				$new_get_param = "?";

				// добавляем текущий если необходимо
				if($val){
					$new_get_param .= "{$cur_param}={$val}";
				}

				// проверяем остальные параметры
				if(sizeof($mass_get)){
					foreach($mass_get as $key=>$cur2){
						if(strlen($new_get_param)>1){
							$new_get_param .= "&";
						}
						$new_get_param .= $cur2;
					}
				}
			}
		}
		else{ // небыло параметров /  ДОБАВИТЬ
			if($val){
				 $new_get_param = "?{$cur_param}={$val}";
			}
		}
		return $new_get_param;
	}

           
        

	// Общие функции xajax  //
	//*** DEVELOPER XAJAX - FUNCTIONS ***//

	//		function aaaa($formData) {
	//			$xajax = new xajaxResponse();
	//			$conn = &DbFactory::getConnection();
	//
	//			$xajax->assign('id', 'innerHTML', $var );
	//			return $xajax;
	//		}


}
