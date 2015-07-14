<?php
class ActionsPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}

	function doContent(){
		$id = $this->request->getValue('id');
		
		if(!$id){  // Весь список
			define('COUNT_PAGE', 6);
			require_once 'module/common/PagerFactory.class.php'; 

			$pager = new PagerFactory();
			$page = $this->request->getValue ('page');
			if(!$page){
				$page=1;
			}
			$this->template->assign('page', $page);
				
			$sql = "SELECT * FROM actions WHERE active=1 AND date_end>now() AND date<now() ORDER BY date DESC, id DESC";
			$fromWhereCnt = "actions WHERE active=1";
			$href = "/actions/page/";
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			$this->template->assign('pager_string', $pagerString);
			
					
			
			$this->template->assign('data_actions', $data);
			
			$this->setPageTitle("Акции");
		}
		else{ // выбранный элемент
			$query = $this->conn->newStatement("SELECT * FROM actions WHERE id=:id: AND active=1");
			$query->setInteger('id', $id);
			$data_item = $query->getFirstRecord();
			$this->template->assign('data_item', $data_item);
                        
                        //достаем категории
                        $query = $this->conn->newStatement("SELECT act_cat.*, cat.name AS name_category, cat.id AS id_category FROM actions_category act_cat LEFT JOIN category cat ON act_cat.id_category=cat.id WHERE act_cat.id_action=:id:");
			$query->setInteger('id', $data_item['id']);
			$data_actions_category = $query->getAllRecords();
                        $this->template->assign('data_actions_category', $data_actions_category);
                        
                        
			
			$this->setPageTitle("".($data_item['title']?$data_item['title']:$data_item['name'])." / Акции");
			$query = $this->conn->newStatement("SELECT * FROM actions WHERE active=1 AND id!={$data_item['id']} ORDER BY id DESC LIMIT 3");
			$data_last_actions = $query->getAllRecords();	
                        $this->template->assign('data_last_actions', $data_last_actions);
			
		}
		
		$this->response->write($this->renderTemplate('actions.tpl'));
	}
}
?>