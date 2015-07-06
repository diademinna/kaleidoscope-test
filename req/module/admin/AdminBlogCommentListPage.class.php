<?php
require_once("module/AbstractPageModule.class.php");

class AdminBlogCommentListPage extends AbstractPageModule {
	var $conn;

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis('ChangeCountPage');
		$this->processRequest();
	}

	function doContent(){		
		if($GLOBALS[_SERVER][QUERY_STRING]){
			$get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
		}
		else{
			$get_param = "";
		}
		$this->template->assign('get_param', $get_param);
		
		// достаем все блоги 1 уровня
		$query = $this->conn->newStatement("SELECT * FROM blog WHERE parent_id=0");
		$data_blog_1ur = $query->getAllRecords('id');
		$this->template->assign('data_blog_1ur', $data_blog_1ur);
		
		$page = $this->request->getValue ('page');
		if(!$page){
			$page=1;
		}
		$this->template->assign('page', $page);
			
		$id = $this->request->getValue('id');
		$action = $this->request->getValue ('action');
		
		if ($action == "delete" && !empty($id))	{
			$query = $this->conn->newStatement("DELETE FROM blog_comment WHERE id=:id:");
	        $query->setInteger('id', $id);
	        $query->execute();
	        
			$this->response->redirect("/admin/blog_comment/list/{$page}/{$get_param}");
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
			$sql = "SELECT c.*, b.url AS blog_url, b.parent_id AS blog_parent_id,  b.name AS blog_name
					FROM blog_comment c 
					LEFT JOIN blog b ON c.id_blog=b.id
					ORDER BY c.date DESC";
			$fromWhereCnt = "blog_comment";
			$href = "/admin/blog_comment/list/".$get_param;
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data', $data);
			
			$this->response->write($this->renderTemplate('admin/admin_blog_comment_list.tpl'));
		}
	}
	
	
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");		
		$objResponse->redirect("/admin/blog_comment/list/{$new_get_param}");
		
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