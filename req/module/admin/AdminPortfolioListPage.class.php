<?php
class AdminPortfolioListPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate", "Sort");
		$this->processRequest();
                $this->template->assign('unit', "portfolio");
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
			
			$query = $conn->newStatement("SELECT * FROM portfolio WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			$query = $conn->newStatement("DELETE FROM portfolio WHERE id=:id:");
	        $query->setInteger('id', $id);
	        $query->execute();
	        
			FileSystem::deleteFile("uploaded/portfolio/{$id}_sm.{$data['ext']}");
			FileSystem::deleteFile("uploaded/portfolio/{$id}.{$data['ext']}");
			
			
			///////////// удаление галлереи /////////////////////
			$query = $conn->newStatement("SELECT * FROM portfolio_photo WHERE id_portfolio=:id_portfolio: ORDER BY id ASC");
			$query->setInteger('id_portfolio', $id);
			$data_photo = $query->getAllRecords();
			
			$query = $conn->newStatement("DELETE FROM portfolio_photo WHERE id_portfolio=:id_portfolio:");
	        $query->setInteger('id_portfolio', $id);
	        $query->execute();
	        
	        foreach ($data_photo as $key=>$value){
	        	FileSystem::deleteFile("uploaded/portfolio/{$id}/{$value['id']}_sm.{$value['ext']}");
				FileSystem::deleteFile("uploaded/portfolio/{$id}/{$value['id']}.{$value['ext']}");
	        }
			
			$this->response->redirect("/admin/portfolio/list/{$page}/".($get_param?$get_param:""));
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
			$sql = "SELECT * FROM portfolio ORDER BY pos DESC, id DESC";
			$fromWhereCnt = "portfolio";
			$href = "/admin/portfolio/list/".$get_param;
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data', $data);
									
			$this->response->write($this->renderTemplate('admin/admin_portfolio_list.tpl'));
		}
	}
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/portfolio/list/{$new_get_param}");
		
		return $objResponse;
	}
	
	// Отображать или скрыть выбранный элемент.
	function Activate($id){
		$xajax = new xajaxResponse();
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM portfolio WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		$query = $conn->newStatement("UPDATE portfolio SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();
		
		return $xajax;
	}
	
	// Сортировка с помощью плагина Sortable
	function Sort($mass_sort, $min_pos=1){ //  $min_pos - минимальное значение позиции на странице.
		$objResponse = new xajaxResponse();
		$conn = &DbFactory::getConnection();
		
		$mass_sort = str_replace('item_', "", $mass_sort);
		$mass_sort = array_reverse($mass_sort); // сортировка в обратном порядке.
		
		foreach ($mass_sort as $key => $value) {
			$query = $conn->newStatement("UPDATE portfolio SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}
		
		return $objResponse;
	}
	
	
}
?>