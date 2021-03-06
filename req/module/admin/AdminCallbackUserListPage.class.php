<?php
class AdminCallbackUserListPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage");
		$this->processRequest();
	}

	function doContent(){
		$conn = &DbFactory::getConnection();
		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		else{
			$get_param = "";
		}
		$this->template->assign('get_param', $get_param);
				
		$page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $page);
		
		$id = $this->request->getValue('id');
		$action = $this->request->getValue ('action');
		
		if ($action == "delete" && !empty($id))	{
			
			$query = $conn->newStatement("DELETE FROM callback_user WHERE id=:id:");
	        $query->setInteger('id', $id);
	        $query->execute();
	        
			$this->response->redirect("/admin/callback_user/list/{$page}/".($get_param?$get_param:""));
		}
		else {
			
			if($this->request->getValue('count_page')){
				define('COUNT_PAGE', $this->request->getValue('count_page'));
			}
			else{
				define('COUNT_PAGE', 20);
			}
			require_once 'module/common/PagerFactory.class.php';
			
			$pager = new PagerFactory();
			$sql = "SELECT * FROM callback_user ORDER BY date DESC, id DESC";
			$fromWhereCnt = "callback_user";
			$href = "/admin/callback_user/list/".$get_param;			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data', $data);
			
						
			$this->response->write($this->renderTemplate('admin/admin_callback_user_list.tpl'));
		}
	}
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/callback_user/list/{$new_get_param}");
		
		return $objResponse;
	}
}
?>