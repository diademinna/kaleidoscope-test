<?php
class NewsPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}

	function doContent(){
		$id = $this->request->getValue('id');
		
		if(!$id){  // Весь список
			define('COUNT_PAGE', 10);
			require_once 'module/common/PagerFactory.class.php'; 

			$pager = new PagerFactory();
			$page = $this->request->getValue ('page');
			if(!$page){
				$page=1;
			}
			$this->template->assign('page', $page);
				
			$sql = "SELECT * FROM news WHERE active=1 ORDER BY date DESC, id DESC";
			$fromWhereCnt = "news WHERE active=1";
			$href = "/news/page/";
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			$this->template->assign('pager_string', $pagerString);
			
			
			// достать галлерею если нет анонса.
			foreach ($data as $key=>$value) {				
				if(!$value['anons']){  // достать галлерею.					
					$query = $this->conn->newStatement("SELECT * FROM news_photo WHERE id_news=:id_news: ORDER BY pos DESC, id DESC");
					$query->setInteger('id_news', $value['id']);
					$data_photo = $query->getAllRecords();
					
					// сортируем фотки по гориз и вертикали.
					$data_photo_vert = array();
					foreach ($data_photo as $key_p => $value_p) {
						if($value_p['img_position'] == 2){ // вертик
							$data_photo_vert[] = $value_p;
							unset($data_photo[$key_p]);
						}
					}
					// получились здесь гориз $data_photo   //  здесь $data_photo_vert вертик	
					$data[$key]['photo_goriz'] = $data_photo;
					$data[$key]['photo_vert'] = $data_photo_vert;
				}	
			}			
			
			$this->template->assign('data_news', $data);
			
			$this->setPageTitle("Новости");
		}
		else{ // выбранный элемент
			$query = $this->conn->newStatement("SELECT * FROM news WHERE id=:id: AND active=1");
			$query->setInteger('id', $id);
			$data_item = $query->getFirstRecord();
			$this->template->assign('data_item', $data_item);
			
			$this->setPageTitle("".($data_item['title']?$data_item['title']:$data_item['name'])." / Новости");
						
			// достаем галерею.
			$query = $this->conn->newStatement("SELECT * FROM news_photo WHERE id_news=:id_news: ORDER BY pos DESC, id DESC");
			$query->setInteger('id_news', $id);
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
			
		}
		
		$this->response->write($this->renderTemplate('news.tpl'));
	}
}
?>