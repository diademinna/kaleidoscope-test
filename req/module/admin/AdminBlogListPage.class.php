<?php
class AdminBlogListPage extends AbstractPageModule {

	var $mass_all_child_blog; // массив всех дочерних + ложим туда текущую.
	
	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate", "Sort");
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
		
		$page = $this->request->getValue('page')?$this->request->getValue('page'):1;
		$this->template->assign('page', $page);
		
		
		$action = $this->request->getValue('action');
		$parent_id = $this->request->getValue('parent_id')?$this->request->getValue('parent_id'):0; // родительская категория
		$this->template->assign('parent_id', $parent_id?$parent_id:"0");
		
		
		if($action == "delete"){ // УДАЛЕНИЕ РАЗДЕЛА и всех ее потомков
			
			$id = $this->request->getValue('id'); // для удаления
						
			//достаем ВСЕ разделы
			$query = $this->conn->newStatement("SELECT id, parent_id, ext FROM blog ORDER BY parent_id ASC, pos DESC, id ASC");
			$data = $query->getAllRecords('id');
			//теперь создаем массив в виде дерева
			$tree = array();
			foreach ($data as $cur) {
				$tree[(int)$cur['parent_id']][] = $cur;
			}
		
			$this->mass_all_child_blog[$id] = $id; // текущий раздел сразу добавляем в массив для удаления
			$this->FindAllChildBlog($tree, $id); // добавляем все дочерние разделы в этот массив mass_all_child_blog
			//print_r( implode(',', array_keys($this->mass_all_child_blog)) ); die();
			
			// удаляем разделы
			$query = $this->conn->newStatement("DELETE FROM blog WHERE id IN (".implode(',', array_keys($this->mass_all_child_blog) ).")");
			$query->execute();
			
			// удалить все картинки разделов
			if($this->mass_all_child_blog){
				foreach ($this->mass_all_child_blog as $cur) { // $cur - id раздела
					if($data[$cur]['ext']){
						FileSystem::deleteFile("uploaded/blog/{$cur}_sm.{$data[$cur]['ext']}");
						FileSystem::deleteFile("uploaded/blog/{$cur}.{$data[$cur]['ext']}");
					}
				}
			}
			
			
			// удаляем галереи
			if($this->mass_all_child_blog){
				// достаем все фотки галерей.
				$query = $this->conn->newStatement("SELECT * FROM blog_photo WHERE id_blog IN (".implode( ',', array_keys($this->mass_all_child_blog) ).") ORDER BY id_blog ASC");
				$data_photo = $query->getAllRecords();
								
				// удаляем записи
				if($data_photo){
					$query = $this->conn->newStatement("DELETE FROM blog_photo WHERE id_blog IN (".implode( ',', array_keys($this->mass_all_child_blog) ).") ");
					$query->execute();
				}
				
				// удаляем фотки галереи и их папки 
				if($data_photo){
					foreach($data_photo as $key=>$value){
						FileSystem::deleteFile("uploaded/blog/{$value['id_blog']}/{$value['id']}_sm.{$value['ext']}");
						FileSystem::deleteFile("uploaded/blog/{$value['id_blog']}/{$value['id']}.{$value['ext']}");
					}
										
					foreach ($data_photo as $key=>$value){
						if($value['id_blog'] != $save_id_blog){
							FileSystem::deleteFolder("uploaded/blog/{$value['id_blog']}", true);
							$save_id_blog = $value['id_blog'];
						}
					}
				}
			}
			
			
			
			// УДАЛЯЕМ ТЕГИ БЛОГОВ
			
			//достаем все теги удаляемых разделов
			$query = $this->conn->newStatement("SELECT * FROM blog_to_tag WHERE id_blog IN (".implode( ',', array_keys($this->mass_all_child_blog) ).") ORDER BY id_blog ASC");
			$data_blog_to_tag = $query->getAllRecords('id_blog_tag');
			
			// удаляем связи блогов с тегами
			if($data_blog_to_tag){
				$query = $this->conn->newStatement("DELETE FROM blog_to_tag WHERE id_blog IN (".implode( ',', array_keys($this->mass_all_child_blog) ).") ");
				$query->execute();
			}
					
			// проверяем используется ли вообще в блогах данные теги
			if($data_blog_to_tag){
				foreach($data_blog_to_tag as $key=>$value){
					$query = $this->conn->newStatement("SELECT * FROM blog_to_tag WHERE id_blog_tag=:id_blog_tag:");
					$query->setInteger('id_blog_tag', $key);
					$tag_use_in_blog = $query->getAllRecords();
					if(!$tag_use_in_blog){
						$query = $this->conn->newStatement("DELETE FROM blog_tag WHERE id=:id:");
						$query->setInteger('id', $key);
						$query->execute();
					}
				}
			}			
			
	        Useful::rebuildStaticTpl('tags'); // REBUILD STATIC
	        //$this->rebuildStaticTpl('tags'); // REBUILD STATIC
				
			$this->response->redirect("/admin/blog/list/{$parent_id}/page/{$page}/".($get_param?$get_param:""));
		}
		else { // ФОРМИРОВАНИЕ СПИСКА и ВЫВОД
			
			
			if($this->request->getValue('count_page')){
				define('COUNT_PAGE', $this->request->getValue('count_page'));
			}
			else{
				define('COUNT_PAGE', 20);
			}
			require_once 'module/common/PagerFactory.class.php';
						
			if(!$parent_id){ // главная		
				$where_cat = "parent_id=0";
			}
			else{ // подкатегория (выбрана категория)
				$where_cat = "parent_id={$parent_id}";
			}
			
			$pager = new PagerFactory();
			$sql = "SELECT * FROM blog WHERE {$where_cat} ORDER BY pos DESC, id DESC"; // достаем все КАТЕГОРИИ в этой категории
			$fromWhereCnt = "blog WHERE {$where_cat}";
			$href = "/admin/blog/list/{$parent_id}/page/".$get_param;
			
			$pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
			$data_blog = $pager->getPageData();
			
			$this->template->assign('pager_string', $pagerString);
			$this->template->assign('data_blog', $data_blog);
			
			/////////////////////////////////////////
			
			// родительская категория
			if($parent_id){
				$query = $this->conn->newStatement("SELECT * FROM blog WHERE id=:id:");
				$query->setInteger('id', $parent_id);
				$data_blog_cur = $query->getFirstRecord();			
				$this->template->assign('data_blog_cur', $data_blog_cur);
			}
			
			
			// ФОРМИРУЕМ НАВИГАЦИЮ.
//			if($parent_id){  // выбрана какая-то категория				
//				// достаем все категории
//				$query = $this->conn->newStatement("SELECT * FROM blog ORDER BY parent_id ASC, pos DESC, id ASC");
//				$data = $query->getAllRecords('id');
//				
//				// ищем для навигации родительские категории
//				$mass_navigation =array();
//				$cur_cat = $parent_id; // текущая категория для навигации
//				
//				$mass_navigation[] = $data[$cur_cat];
//				while ($data[$cur_cat]['parent_id'] AND $data[$cur_cat]['parent_id']!="0"){
//					$cur_cat = $data[$cur_cat]['parent_id'];					
//					$mass_navigation[] = $data[$cur_cat];
//				}			
//				$mass_navigation = array_reverse($mass_navigation); // сортировка в правильной последовательности				
//				$this->template->assign('mass_navigation', $mass_navigation);				
//			}
			
			$this->response->write($this->renderTemplate('admin/admin_blog_list.tpl'));
		}
	}
	
	
	
	// найти все категории являющиеся предками категории $cur_id_cat
	//  В итоге такой массив в $mass_all_child_blog
	//  Array
	//	(
	//		[53] => 53
	//		[58] => 58
	//		[62] => 62
	//	)
	function FindAllChildBlog($tree, $cur_id_cat=0) {
	    if (empty($tree[$cur_id_cat])){
	        return;
	    }	    
	    foreach ($tree[$cur_id_cat] as $k => $row) {
			$this->mass_all_child_blog[$row['id']] = $row['id'];
	        if (isset($tree[$row['id']])){  // есть ли у него (подкатегории)     	
	            $this->FindAllChildBlog($tree, $row['id']);	            
	        }	        
	    }	    
	    return;
	}
	
	
	
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
	// $parent_id - это категория в которой мы находимся.
	function ChangeCountPage($val, $get_param, $parent_id){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/blog/list/{$parent_id}/{$new_get_param}");
		
		return $objResponse;
	}
	
	// Отображать или скрыть выбранный элемент. (раздел)
	function Activate($id){
		$xajax = new xajaxResponse();
		
		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM blog WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		$query = $conn->newStatement("UPDATE blog SET active=:active: WHERE id=:id:");
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
			$query = $conn->newStatement("UPDATE blog SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}
		
		return $objResponse;
	}
	
	
}
?>