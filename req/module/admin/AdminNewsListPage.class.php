<?php
class AdminNewsListPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate");
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
			
			$query = $conn->newStatement("SELECT * FROM news WHERE id=:id:");
			$query->setInteger('id', $id);
			$data = $query->getFirstRecord();
			
			$query = $conn->newStatement("DELETE FROM news WHERE id=:id:");
                        $query->setInteger('id', $id);
                        $query->execute();

			FileSystem::deleteFile("uploaded/news/{$id}_sm.{$data['ext']}");
			FileSystem::deleteFile("uploaded/news/{$id}.{$data['ext']}");
			
			
			///////////// удаление галлереи /////////////////////
			$query = $conn->newStatement("SELECT * FROM news_photo WHERE id_news=:id_news: ORDER BY id ASC");
			$query->setInteger('id_news', $id);
			$data_photo = $query->getAllRecords();
			
			$query = $conn->newStatement("DELETE FROM news_photo WHERE id_news=:id_news:");
                        $query->setInteger('id_news', $id);
                        $query->execute();

                        foreach ($data_photo as $key=>$value){
                                FileSystem::deleteFile("uploaded/news/{$id}/{$value['id']}_sm.{$value['ext']}");
                                        FileSystem::deleteFile("uploaded/news/{$id}/{$value['id']}.{$value['ext']}");
                        }
			
			
			$this->response->redirect("/admin/news/list/{$page}/".($get_param?$get_param:""));
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
			$sql = "SELECT * FROM news ORDER BY date DESC, id DESC";
			$fromWhereCnt = "news";
			$href = "/admin/news/list/".$get_param;
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data', $data);
									
			$this->response->write($this->renderTemplate('admin/admin_news_list.tpl'));
		}
	}
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/news/list/{$new_get_param}");
		
		return $objResponse;
	}
	
	// Отображать или скрыть выбранный элемент.
	function Activate($id){
		$xajax = new xajaxResponse();
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM news WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		$query = $conn->newStatement("UPDATE news SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();
		
		return $xajax;
	}
	
}
?>