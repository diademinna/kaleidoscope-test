<?php
class AdminSectionListPage extends AbstractPageModule {

	var $mass_all_child_section; // массив всех дочерних + ложим туда текущую.
	
	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate", "Sort");
		$this->processRequest();
	}
	
	
	function doContent(){		
		$action = $this->request->getValue('action');
		
		$id_section = $this->request->getValue('id_section');
		$this->template->assign('id_section', $id_section?$id_section:"0");
		
		//die();
		if ($action == "delete"){ // УДАЛЕНИЕ РАЗДЕЛА и всех ее потомков
			
			$id = $this->request->getValue('id'); // для удаления
						
			//достаем ВСЕ разделы
			$query = $this->conn->newStatement("SELECT * FROM section ORDER BY parent_id ASC, pos DESC, id ASC");
			$data = $query->getAllRecords('id');
			//теперь создаем массив в виде дерева
			$tree = array();
			foreach ($data as $cur) {
				$tree[(int)$cur['parent_id']][] = $cur;
			}
		
			$this->mass_all_child_section[$id] = $id; // текущий раздел сразу добавляем в массив для удаления
			$this->FindAllChildSection($tree, $id); // добавляем все дочерние разделы в этот массив mass_all_child_section
			
			// удаляем разделы
			$query = $this->conn->newStatement("DELETE FROM section WHERE id IN (".implode(',', array_keys($this->mass_all_child_section) ).")");
			$query->execute();
			
			// удалить все картинки разделов
			if($this->mass_all_child_section){
				foreach ($this->mass_all_child_section as $cur) { // $cur - id раздела
					if($data[$cur]['ext']){
						FileSystem::deleteFile("uploaded/section/{$cur}_sm.{$data[$cur]['ext']}");
						FileSystem::deleteFile("uploaded/section/{$cur}.{$data[$cur]['ext']}");
					}
				}
			}
			
			
			// удаляем галереи
			if($this->mass_all_child_section){
				// достаем все фотки галерей.
				$query = $this->conn->newStatement("SELECT * FROM section_photo WHERE id_section IN (".implode(',', array_keys($this->mass_all_child_section) ).") ORDER BY id_section ASC");
				$data_photo = $query->getAllRecords();
								
				// удаляем записи
				if($data_photo){
					$query = $this->conn->newStatement("DELETE FROM section_photo WHERE id_section IN (".implode(',', array_keys($this->mass_all_child_section) ).") ");
					$query->execute();
				}
				
				// удаляем фотки галереи и их папки 
				if($data_photo){
					foreach($data_photo as $key=>$value){
						FileSystem::deleteFile("uploaded/section/{$value['id_section']}/{$value['id']}_sm.{$value['ext']}");
						FileSystem::deleteFile("uploaded/section/{$value['id_section']}/{$value['id']}.{$value['ext']}");
					}
										
					foreach ($data_photo as $key=>$value){
						if($value['id_section'] != $save_id_section){
							FileSystem::deleteFolder("uploaded/section/{$value['id_section']}", true);
							$save_id_section = $value['id_section'];
						}
					}					
				}
			}
				
			$this->response->redirect("/admin/section/list/".($id_section?$id_section:'0')."/");
		}
		else { // ФОРМИРОВАНИЕ СПИСКА и ВЫВОД
			
			if(!$id_section){ // главная		
				$where_cat = "parent_id=0";
			}
			else{ // подкатегория (выбрана категория)
				$where_cat = "parent_id=:id_section:";
			}
			
			// достаем все КАТЕГОРИИ в этой категории
			$query = $this->conn->newStatement("SELECT * FROM section WHERE {$where_cat} ORDER BY pos DESC, id DESC");
			$query->setInteger('id_section', $id_section);
			$data_section = $query->getAllRecords();			
			$this->template->assign('data_section', $data_section);
			
			
			// родительская категория
			if($id_section){
				$query = $this->conn->newStatement("SELECT * FROM section WHERE id=:id:");
				$query->setInteger('id', $id_section);
				$data_section_cur = $query->getFirstRecord();			
				$this->template->assign('data_section_cur', $data_section_cur);
			}
			
			
			// ФОРМИРУЕМ НАВИГАЦИЮ.
//			if($id_section){  // выбрана какая-то категория				
//				// достаем все категории
//				$query = $this->conn->newStatement("SELECT * FROM section ORDER BY parent_id ASC, pos DESC, id ASC");
//				$data = $query->getAllRecords('id');
//				
//				// ищем для навигации родительские категории
//				$mass_navigation =array();
//				$cur_cat = $id_section; // текущая категория для навигации
//				
//				$mass_navigation[] = $data[$cur_cat];
//				while ($data[$cur_cat]['parent_id'] AND $data[$cur_cat]['parent_id']!="0"){
//					$cur_cat = $data[$cur_cat]['parent_id'];					
//					$mass_navigation[] = $data[$cur_cat];
//				}			
//				$mass_navigation = array_reverse($mass_navigation); // сортировка в правильной последовательности				
//				$this->template->assign('mass_navigation', $mass_navigation);				
//			}
			
			$this->response->write($this->renderTemplate('admin/admin_section_list.tpl'));
		}
	}
	
	
	
	// найти все категории являющиеся предками категории $cur_id_cat
	//  В итоге такой массив в $mass_all_child_section
	//  Array
	//	(
	//		[53] => 53
	//		[58] => 58
	//		[62] => 62
	//	)
	function FindAllChildSection($tree, $cur_id_cat=0) {
	    if (empty($tree[$cur_id_cat])){
	        return;
	    }	    
	    foreach ($tree[$cur_id_cat] as $k => $row) {
			$this->mass_all_child_section[$row['id']] = $row['id'];
	        if (isset($tree[$row['id']])){  // есть ли у него (подкатегории)     	
	            $this->FindAllChildSection($tree, $row['id']);	            
	        }	        
	    }	    
	    return;
	}
	
	
	
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
//	function ChangeCountPage($val, $get_param){
//		$objResponse = new xajaxResponse();
//		
//		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
//		$objResponse->redirect("/admin/section/list/{$new_get_param}");
//		
//		return $objResponse;
//	}
	
	// Отображать или скрыть выбранный элемент. (раздел)
	function Activate($id){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM section WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		$query = $conn->newStatement("UPDATE section SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();
		
		return $xajax;
	}
	
	// Сортировка с помощью плагина Sortable (категории)
	function Sort($mass_sort, $min_pos=1){ //  $min_pos - минимальное значение позиции на странице.
		$objResponse = new xajaxResponse();
		$conn = &DbFactory::getConnection();
				
		$mass_sort = str_replace('item_', "", $mass_sort);
		$mass_sort = array_reverse($mass_sort); // сортировка в обратном порядке.
		
		foreach ($mass_sort as $key => $value) {
			$query = $conn->newStatement("UPDATE section SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}
		
		return $objResponse;
	}
	
	
}
?>