<?php
class ArticlePage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}

	function doContent(){
		
		$id = $this->request->getValue('id');
		
		if(!$id){  // Весь список
			define('COUNT_PAGE', 20);
			require_once 'module/common/PagerFactory.class.php'; 

			$pager = new PagerFactory();
			$page = $this->request->getValue ('page');
			if(!$page){
				$page=1;
			}
			$this->template->assign('page', $page);
				
			$sql = "SELECT * FROM article WHERE active=1 ORDER BY pos DESC";
			$fromWhereCnt = "article WHERE active=1";
			$href = "/article/page/";
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data_article', $data);
					
			$this->setPageTitle("Статьи");
		}
		else{ // выбранный элемент
			$query = $this->conn->newStatement("SELECT * FROM article WHERE id=:id: AND active=1");
			$query->setInteger('id', $id);
			$data_item = $query->getFirstRecord();
			$this->template->assign('data_item', $data_item);
			
			
			// достаем галерею.
			$query = $this->conn->newStatement("SELECT * FROM article_photo WHERE id_article=:id_article: ORDER BY id ASC");
			$query->setInteger('id_article', $id);
			$data_photo = $query->getAllRecords();
			
			// сортируем фотки по гориз и вертикали.
			$data_photo_vert = array();
			foreach ($data_photo as $key => $value) {
				if($value['img_position'] == 2){ // вертик
					$data_photo_vert[] = $value;
					unset($data_photo[$key]);
				}
			}
			
			$this->template->assign('data_photo_goriz', $data_photo);
			$this->template->assign('data_photo_vert', $data_photo_vert);
			
			$this->setPageTitle("".($data_item['title']?$data_item['title']:$data_item['name'])." / Статьи");
		}
		
		$this->response->write($this->renderTemplate('article.tpl'));
	}
}
?>