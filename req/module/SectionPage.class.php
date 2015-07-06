<?php
require_once("module/AbstractPageModule.class.php");

class SectionPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->doInit();
		
		
		/* 
		  
		   В Abstruct ДОБАВИТЬ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		
		//достаем ВСЕ одноуровневые разделы
		$query = $this->conn->newStatement("SELECT id, name, parent_id, url, flag_nosection FROM section ORDER BY parent_id ASC, pos DESC, id ASC");
		$data_section_tmp = $query->getAllRecords('id');		
		// ложим подразделы в разделы.
		foreach ($data_section_tmp as $key=>$value) {
			if(!$value['parent_id']){ // если корневой
				$data_section_all[$value['id']] = $value;
			}
			else{ // подкатегория
				$data_section_all[$value['parent_id']]['subsection'][] = $value;
			}
		}
		$this->template->assign('data_section_all', $data_section_all);
		 
		 */
	}
	
	function doContent(){
		// /section/(url_1)/(url_2)/  - так выглядит путь, когда есть подразделы.
		$url_1 = $this->request->getValue('url_1'); // URL раздела
		$url_2 = $this->request->getValue('url_2'); // URL подраздела
		
		// достаем корневой раздел.
		$query = $this->conn->newStatement("SELECT * FROM section WHERE parent_id=0 AND url=:url_1:");
		$query->setVarChar('url_1', $url_1);
		$data_section = $query->getFirstRecord();
		
		if($data_section['id'] AND !$data_section['flag_nosection']){ // ЕСТЬ ПОДРАЗДЕЛЫ
			// достаем подраздел.
			$query = $this->conn->newStatement("SELECT * FROM section WHERE parent_id=:parent_id: AND url=:url_2:");
			$query->setInteger('parent_id', $data_section['id']);
			$query->setVarChar('url_2', $url_2);
			$data_subsection = $query->getFirstRecord();
			$this->template->assign('data_subsection', $data_subsection);
			
			if($data_subsection){
				$this->setPageTitle("".($data_subsection['title']?$data_subsection['title']:$data_subsection['name'])." / {$data_section['name']}");
			
				// достаем галерею.
				$query = $this->conn->newStatement("SELECT * FROM section_photo WHERE id_section=:id_section: ORDER BY pos DESC, id DESC");
				$query->setInteger('id_section', $data_subsection['id']);
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

				$this->response->write($this->renderTemplate('section.tpl'));
			}
			else{
				$this->response->redirect('/');
			}			
		}
		elseif($data_section['id'] AND $data_section['flag_nosection']){ // ПРОСТО СТРАНИЦА
			$this->template->assign('data_section', $data_section);
			$this->setPageTitle(($data_section['title']?$data_section['title']:$data_section['name']));
			
			// достаем галерею.
			$query = $this->conn->newStatement("SELECT * FROM section_photo WHERE id_section=:id_section: ORDER BY pos DESC, id DESC");
			$query->setInteger('id_section', $data_section['id']);
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

			$this->response->write($this->renderTemplate('section.tpl'));
				
		}
		else{
			$this->response->redirect('/');
		}
		
	}
}
?>