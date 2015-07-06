<?php
require_once("module/AbstractPageModule.class.php");

class AdminUserListPage extends AbstractPageModule {
	var $conn;

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis('ChangeCountPage');
		$this->processRequest();
                $this->template->assign('unit', "user");
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
		
		//$category = $this->request->getValue("category");
			
		// достаем категории
//		$query = $conn->newStatement("SELECT * FROM category ORDER BY id ASC");
//		$data_category = $query->getAllRecords();
//		$this->template->assign('data_category', $data_category);
		
		$page = $this->request->getValue ('page');
		if(!$page){
			$page=1;
		}
		$this->template->assign('page', $page);
			
		$id = $this->request->getValue('id');
		$action = $this->request->getValue ('action');
		
		if ($action == "delete" && !empty($id))	{
			$query = $conn->newStatement("DELETE FROM user WHERE id=:id:");
	        $query->setInteger('id', $id);
	        $query->execute();
	        
			$this->response->redirect("/admin/user/list/{$page}/{$get_param}");
		}
		else {
			if($this->request->getValue('count_page')){
				define('COUNT_PAGE', $this->request->getValue('count_page'));
			}
			else{
				define('COUNT_PAGE', 20);
			}
			require_once 'module/common/PagerFactory.class.php';
			
//			if($category){
//				$where = "WHERE id_category=".$category;
//			}
//			else{
//				$where="";
//			}
			$where="";
			
			$pager = new PagerFactory();			
			$sql = "SELECT * FROM user {$where} ORDER BY id ASC";
			$fromWhereCnt = "user {$where}";
			$href = "/admin/user/list/".$get_param;
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data', $data);
			
			$this->response->write($this->renderTemplate('admin/admin_user_list.tpl'));
		}
	}
	
	
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");		
		$objResponse->redirect("/admin/user/list/{$new_get_param}");
		
		return $objResponse;
	}

	
	
/*
	
	function ChangeCategory($val, $get_param){
		$objResponse = new xajaxResponse();		
		
		$new_get_param = $this->ParamGET($val, $get_param, "category");
		
		$objResponse->redirect("/material/list/{$new_get_param}");
		
		return $objResponse;
	}
	
	
*/
	
}
?>