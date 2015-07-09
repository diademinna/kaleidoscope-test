<?php
class AdminActionsListPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate");
		$this->processRequest();
                $this->template->assign('unit', "actions");
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
			
			$query = $conn->newStatement("SELECT * FROM actions WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			$query = $conn->newStatement("DELETE FROM actions WHERE id=:id:");
                        $query->setInteger('id', $id);
                        $query->execute();
                        
                        
			$query = $conn->newStatement("DELETE FROM actions_category WHERE id_action=:id_action:");
                        $query->setInteger('id_action', $id);
                        $query->execute();

			FileSystem::deleteFile("uploaded/actions/{$id}_sm.{$data['ext']}");
			FileSystem::deleteFile("uploaded/actions/{$id}.{$data['ext']}");
			
			
			$this->response->redirect("/admin/actions/list/{$page}/".($get_param?$get_param:""));
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
			$sql = "SELECT * FROM actions ORDER BY date DESC, id DESC";
			$fromWhereCnt = "actions";
			$href = "/admin/actions/list/".$get_param;
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data', $data);
									
			$this->response->write($this->renderTemplate('admin/admin_actions_list.tpl'));
		}
	}
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/actions/list/{$new_get_param}");
		
		return $objResponse;
	}
	
	// Отображать или скрыть выбранный элемент.
	function Activate($id){
		$xajax = new xajaxResponse();
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM actions WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		$query = $conn->newStatement("UPDATE actions SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();
		
		return $xajax;
	}
	
}
?>