<?php
class GalleryPage extends AbstractPageModule {
	
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
				
			$sql = "SELECT * FROM gallery WHERE active=1 ORDER BY pos DESC, id DESC";
			$fromWhereCnt = "gallery WHERE active=1";
			$href = "/gallery/page/";
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data = $pager->getPageData();
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data_gallery', $data);
					
			$this->setPageTitle("Галерея");
		}
		else{ // выбранный элемент
			$query = $this->conn->newStatement("SELECT * FROM gallery WHERE id=:id: AND active=1");
			$query->setInteger('id', $id);
			$data_item = $query->getFirstRecord();
			$this->template->assign('data_item', $data_item);
			
			$this->setPageTitle("".($data_item['title']?$data_item['title']:$data_item['name'])." / Галерея");
			
			// достаем галерею.
			$query = $this->conn->newStatement("SELECT * FROM gallery_photo WHERE id_gallery=:id_gallery: ORDER BY pos DESC, id DESC");
			$query->setInteger('id_gallery', $id);
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
		
		$this->response->write($this->renderTemplate('gallery.tpl'));
	}
}
?>