<?php
class AdminCategoryListPage extends AbstractPageModule {

	var $mass_all_child_category; // массив всех дочерних + ложим туда текущую.
	var $mass_category; // массив всех

	function doBeforeOutput(){
		$this->Authenticate();

		$this->registerThis("ChangeCountPage", "Activate", "Sort", "ActivateProduct", "SortProduct", "ChangeFlag", "ChangeCategory", "ChangeProduct");
		$this->processRequest();
		$this->template->assign('unit', "category");
	}


	function doContent(){
		$id_category = $this->request->getValue('id_category');
		$action = $this->request->getValue ('action');

		$this->template->assign('id_category', $id_category?$id_category:"0");

		//die();
		if ($action == "delete"){ // УДАЛЕНИЕ КАТЕГОРИИ и всех ее потомков
			$id = $this->request->getValue('id'); // для удаления

			//достаем все категории
			$query = $this->conn->newStatement("SELECT * FROM category ORDER BY parent_id ASC, pos DESC, id ASC");
			$data = $query->getAllRecords('id');
			//теперь создаем массив в виде дерева
			$tree = array();
			foreach ($data as $cur) {
				$tree[(int)$cur['parent_id']][] = $cur;
			}

			$this->mass_all_child_category[$id] = $id; // текущую категорию сразу добавляем
			$this->FindAllChildCategory($tree, $id); // добавляем все дочерние категории в этот массив mass_all_child_category

			// удаляем категории
			$query = $this->conn->newStatement("DELETE FROM category WHERE id IN (".implode(',', array_keys($this->mass_all_child_category) ).")");
			$query->execute();

			// удалить все картинки категорий
			if($this->mass_all_child_category){
				foreach ($this->mass_all_child_category as $cur) { // $cur - id категори
					if($data[$cur]['ext']){
						FileSystem::deleteFile("uploaded/category/{$cur}_icon.{$data[$cur]['ext']}");
						FileSystem::deleteFile("uploaded/category/{$cur}_prev.{$data[$cur]['ext']}");
						FileSystem::deleteFile("uploaded/category/{$cur}_sm.{$data[$cur]['ext']}");
						FileSystem::deleteFile("uploaded/category/{$cur}.{$data[$cur]['ext']}");
					}
				}
			}


			// достаем все товары, которые надо удалить.
			$query = $this->conn->newStatement("SELECT id, id_category, ext FROM product WHERE id_category IN (".implode(',', array_keys($this->mass_all_child_category) ).")");
			$data_product = $query->getAllRecords('id');

			if($data_product){
                            // удаляем товары
                            $query = $this->conn->newStatement("DELETE FROM product WHERE id_category IN (".implode(',', array_keys($this->mass_all_child_category) ).")");
                            $query->execute();

                            // удалить все картинки товаров
                            foreach ($data_product as $cur) { // $cur - товар
                                if($cur['ext']){
                                    FileSystem::deleteFile("uploaded/product/{$cur['id']}_prev.{$cur['ext']}");
                                    FileSystem::deleteFile("uploaded/product/{$cur['id']}_sm.{$cur['ext']}");
                                    FileSystem::deleteFile("uploaded/product/{$cur['id']}_buy.{$cur['ext']}");
                                    FileSystem::deleteFile("uploaded/product/{$cur['id']}.{$cur['ext']}");
                                }
                                $query = $this->conn->newStatement("DELETE FROM product_info WHERE id_product=:id_product:");
                                $query->setInteger('id_product', $cur['id']);
                                $query->execute();
                                
                                $query = $this->conn->newStatement("SELECT * FROM order_product WHERE id_product=:id_product:");
                                $query->setInteger('id_product', $cur['id']);
                                $data_order = $query->getAllRecords();
                                if ($data_order)
                                {
                                    $query = $this->conn->newStatement("DELETE FROM order_product WHERE id_product=:id_product:");
                                    $query->setInteger('id_product', $cur['id']);
                                    $query->execute();
                                    foreach ($data_order as $key=>$value)
                                    {
                                        $query = $this->conn->newStatement("DELETE FROM orders WHERE id=:id:");
                                        $query->setInteger('id', $value['id_order']);
                                        $query->execute();
                                    }
                                }
                            }


				// достаем все галереи которые надо удалить
				$query = $this->conn->newStatement("SELECT id, id_product, ext FROM product_photo WHERE id_product IN (".implode(',', array_keys($data_product) ).")");
				$data_photo = $query->getAllRecords('id');


				if($data_photo){
					// удаляем картинки все галерей из базы
					$query = $this->conn->newStatement("DELETE FROM product_photo WHERE id_product IN (".implode(',', array_keys($data_product) ).")");
					$query->execute();

					// удалить все картинки галерей
					$mass_del_folder = array(); // формируем массив папок которые надо быдет удалить
					foreach ($data_photo as $cur) { // $cur - товар
						if($cur['ext']){
							FileSystem::deleteFile("uploaded/product/{$cur['id_product']}/{$cur['id']}_icon.{$cur['ext']}");
							FileSystem::deleteFile("uploaded/product/{$cur['id_product']}/{$cur['id']}_prev.{$cur['ext']}");
							FileSystem::deleteFile("uploaded/product/{$cur['id_product']}/{$cur['id']}_sm.{$cur['ext']}");
							FileSystem::deleteFile("uploaded/product/{$cur['id_product']}/{$cur['id']}.{$cur['ext']}");
							$mass_del_folder[$cur['id_product']] = $cur['id_product'];
						}
					}

					foreach ($mass_del_folder as $cur) {
						FileSystem::deleteFolder("uploaded/product/{$cur}", true);
					}
				}
			}

			$this->response->redirect("/admin/category/list/".($id_category?$id_category:'0')."/");
		} // конец удаления
		else { // ФОРМИРОВАНИЕ СПИСКА и ВЫВОД

			if(!$id_category){ // главная
				$where_cat = "parent_id=0";
				$where_prod = "id_category=0";
			}
			else{ // подкатегория (выбрана категория)
				$where_cat = "parent_id=:id_category:";
				$where_prod = "id_category=:id_category:";
			}

			// достаем все КАТЕГОРИИ в этой категории
			$query = $this->conn->newStatement("SELECT * FROM category WHERE {$where_cat} ORDER BY pos DESC, id DESC");
			$query->setInteger('id_category', $id_category);
			$data_category = $query->getAllRecords();
			$this->template->assign('data_category', $data_category);

			// достаем все ТОВАРЫ в этой категории
			$query = $this->conn->newStatement("SELECT * FROM product WHERE {$where_prod} ORDER BY pos DESC, id DESC");
			$query->setInteger('id_category', $id_category);
			$data_product = $query->getAllRecords();
			$this->template->assign('data_product', $data_product);

			


			// ФОРМИРУЕМ НАВИГАЦИЮ.
			if($id_category){  // выбрана какая-то категория
				// достаем все категории
				$query = $this->conn->newStatement("SELECT * FROM category ORDER BY parent_id ASC, pos DESC, id ASC");
				$data = $query->getAllRecords('id');

				// ищем для навигации родительские категории
				$mass_navigation =array();
				$cur_cat = $id_category; // текущая категория для навигации
				$level = 1; // уровень каталога
				$mass_navigation[] = $data[$cur_cat];
				while ($data[$cur_cat]['parent_id'] AND $data[$cur_cat]['parent_id']!="0"){
					$cur_cat = $data[$cur_cat]['parent_id'];
					$mass_navigation[] = $data[$cur_cat];
					$level++;
				}
				$mass_navigation = array_reverse($mass_navigation); // сортировка в правильной последовательности
				$this->template->assign('mass_navigation', $mass_navigation);
				$this->template->assign('level', $level);
			}



			/////////////////////////////////
			// достаем все категории для раздела "ПЕРЕНОС КАТЕГОРИЙ"
//			$query = $this->conn->newStatement("SELECT id, name, parent_id, active, pos FROM category ORDER BY parent_id ASC, pos DESC, id ASC");
//			$data = $query->getAllRecords('id');
//			//
//			//теперь создаем массив в виде дерева
//			$tree = array();
//			foreach($data as $cur){
//				$tree[(int)$cur['parent_id']][] = $cur;
//			}
//			print_r($tree); die();
//
//
//
//			$this->DoTreeCategory($tree, 84);
//
//			print_r($this->mass_all_child_category); die();
			////////////////////////////////////////

			$query = $this->conn->newStatement("SELECT * FROM category ORDER BY name ASC");
			$data = $query->getAllRecords('id');
			$this->template->assign('data_category_all', $data);

			$this->response->write($this->renderTemplate('admin/admin_category_list.tpl'));
		}
	}



	// найти все категории являющиеся предками категории $cur_id_cat
	//  В итоге такой массив в $mass_all_child_category
	//  Array
	//	(
	//		[53] => 53
	//		[58] => 58
	//		[62] => 62
	//	)
	function FindAllChildCategory($tree, $cur_id_cat=0) {
	    if (empty($tree[$cur_id_cat])){
	        return;
	    }
	    foreach ($tree[$cur_id_cat] as $k => $row) {
			$this->mass_all_child_category[$row['id']] = $row['id'];
	        if (isset($tree[$row['id']])){  // есть ли у него (подкатегории)
	            $this->FindAllChildCategory($tree, $row['id']);
	        }
	    }
	    return;
	}




	// найти все дерево категорий - рекурсивная функция для вывода дерева
//	function DoTreeCategory($tree, $pid=0, $cur_count=0){
//	    if (empty($tree[$pid])){
//	        return;
//	    }
//	    //$cur_count++;
//
//	    /// $temp = "";  $temp_vetka = "";
//
//	    foreach($tree[$pid] as $k=>$row){
//
//    		//++++++
//			$this->mass_category[];
//
//	        if(isset($tree[$row['id']])){  // есть ли у него подкатегории
//	            $REZ_STR = $this->TreeConstruct($tree, $row['id'], $cur_count);
//	        }
//	    }
//
//	    $this->comm_count=0;
//
//	    return $temp_vetka;
//	}



	//*** DEVELOPER AJAX ***//

	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$xajax = new xajaxResponse();

		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$xajax->redirect("/admin/category/list/{$new_get_param}");

		return $xajax;
	}

	// Отображать или скрыть выбранный элемент. (категории)
	function Activate($id){
		$xajax = new xajaxResponse();

		$conn =& DbFactory::getConnection();

		$query = $conn->newStatement("SELECT * FROM category WHERE id={$id}");
		$data = $query->getFirstRecord();

		$query = $conn->newStatement("UPDATE category SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();


		if($data['active']==1){
			//достаем все категории
			$query = $conn->newStatement("SELECT * FROM category ORDER BY parent_id ASC, pos DESC, id ASC");
			$data = $query->getAllRecords('id');
			//теперь создаем массив в виде дерева
			$tree = array();
			foreach($data as $cur){
				$tree[(int)$cur['parent_id']][] = $cur;
			}

			$this->mass_all_child_category[$id] = $id; // текущую категорию сразу добавляем
			$this->FindAllChildCategory($tree, $id); // добавляем все дочерние категории в этот массив mass_all_child_category

			if(count($this->mass_all_child_category)>1){ // иначе она уже сброшена
				// сбрасываем категории
				$query = $this->conn->newStatement("UPDATE category SET active=0 WHERE id IN (".implode(',', array_keys($this->mass_all_child_category) ).")");
				$query->execute();
			}

			// достаем все товары, которые надо сбросить.
			$query = $this->conn->newStatement("SELECT id, id_category, ext FROM product WHERE id_category IN (".implode(',', array_keys($this->mass_all_child_category) ).")");
			$data_product = $query->getAllRecords('id');

			if($data_product){
				// удаляем товары
				$query = $this->conn->newStatement("UPDATE product SET active=0 WHERE id_category IN (".implode(',', array_keys($this->mass_all_child_category) ).")");
				$query->execute();
			}

		}

		return $xajax;
	}

	// Сортировка с помощью плагина Sortable (категории)
	function Sort($mass_sort, $min_pos=1){ //  $min_pos - минимальное значение позиции на странице.
		$xajax = new xajaxResponse();
		$conn = &DbFactory::getConnection();

		$mass_sort = str_replace('item_', "", $mass_sort);
		$mass_sort = array_reverse($mass_sort); // сортировка в обратном порядке.

		foreach ($mass_sort as $key => $value) {
			$query = $conn->newStatement("UPDATE category SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}

		return $xajax;
	}


	// Отображать или скрыть выбранный товар.
	function ActivateProduct($id){
		$xajax = new xajaxResponse();

		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM product WHERE id={$id}");
		$data = $query->getFirstRecord();

		$query = $conn->newStatement("UPDATE product SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();

		return $xajax;
	}

	// Сортировка с помощью плагина Sortable
	function SortProduct($mass_sort, $min_pos=1){ //  $min_pos - минимальное значение позиции на странице.
		$xajax = new xajaxResponse();
		$conn = &DbFactory::getConnection();

		$mass_sort = str_replace('item_', "", $mass_sort);
		$mass_sort = array_reverse($mass_sort); // сортировка в обратном порядке.

		foreach ($mass_sort as $key => $value) {
			$query = $conn->newStatement("UPDATE product SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}

		return $xajax;
	}


	// изменить значение флага (активен/неактивен)
	function ChangeFlag($flag_num, $id) {
		$xajax = new xajaxResponse();

		$conn = &DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM product WHERE id={$id}");
		$data = $query->getFirstRecord();

		$cur_flag = "flag_{$flag_num}";

		$query = $conn->newStatement("UPDATE product SET {$cur_flag}=:flag: WHERE id=:id:");
        $query->setInteger('id', $id);
		$query->setInteger("flag", $data[$cur_flag]==1?0:1);
        $query->execute();

		return $xajax;
	}



	// ПЕРЕНОС КАТЕГОРИЙ В ДРУГУЮ КАТЕГОРИЮ.
	// [checkbox_choose] => Array(
    //       [13] => 1
    //       [14] => 1
    // )
	// [select_category] => 2
	public function changeCategory($formData){
		$xajax = new xajaxResponse();
		$conn = &DbFactory::getConnection();

		//print_r($formData);die();
		// проверяем выбрана ли категория для переноса
		if(!$formData['select_category'] AND (string)$formData['select_category']!='0'){
			$xajax->call("alert('Не выбрана категория.')");
			return $xajax;
		}

		// не переносим ли мы выбранную категории в нее же.
		if($formData['checkbox_choose'][$formData['select_category']]){
			$xajax->call("alert('Нельзя перенести выбранную категорию в ту же самую.')");
			return $xajax;
		}

		// проверяем не содержит ли выбранная "принимающая" категория товары
		$query = $conn->newStatement("SELECT id FROM product WHERE id_category=:id_category:");
		$query->setInteger('id_category', $formData['select_category']);
		$data = $query->getAllRecords();
		if($data){
			$xajax->call("alert('Нельзя перенести выбранные вами категории в категорию, которая содержит товары. В одной категории не могут одновременно быть и товары и категории.')");
			return $xajax;
		}


		// проверяем не переносим ли мы категории в их же потомков.
		//
		//достаем все категории
		$query = $this->conn->newStatement("SELECT * FROM category ORDER BY parent_id ASC, pos DESC, id ASC");
		$data = $query->getAllRecords('id');
		//теперь создаем массив в виде дерева
		$tree = array();
		foreach ($data as $cur) {
			$tree[(int)$cur['parent_id']][] = $cur;
		}

		foreach($formData['checkbox_choose'] as $key => $value){
			// надо достать всех ее предков
			$this->mass_all_child_category = array();
			$this->FindAllChildCategory($tree, $key); // добавляем все дочерние категории в этот массив mass_all_child_category
			if($this->mass_all_child_category[$formData['select_category']]){
				$xajax->call("alert('Нельзя перенести выбранную категорию в ее подкатегорию.')");
				return $xajax;
			}
		}


		// ПЕПЕРЬ ПЕРЕНОСИМ!
		$to_where = implode(',',array_keys($formData['checkbox_choose']));
		$query = $conn->newStatement("UPDATE category SET parent_id=:parent_id: WHERE id IN ({$to_where})");
		$query->setInteger('parent_id', $formData['select_category']);
		$query->execute();

		$xajax->redirect("/admin/category/list/{$formData['select_category']}/");

		return $xajax;
	}



	// ПЕРЕНОС ТОВАРОВ В ДРУГУЮ КАТЕГОРИЮ.
	// [checkbox_choose] => Array(
    //       [13] => 1
    //       [14] => 1
    // )
	// [select_category] => 2
	public function changeProduct($formData){
		$xajax = new xajaxResponse();
		$conn = &DbFactory::getConnection();

		//print_r($formData);die();
		// проверяем выбрана ли категория для переноса
		if(!$formData['select_category'] AND (string)$formData['select_category']!='0'){
			$xajax->call("alert('Не выбрана категория.')");
			return $xajax;
		}

		// не переносим ли мы выбранные товары в ту же самую категорию.
		// // ПОДУМАЙ!!!!!!!!!!!!!!!!
//		if($formData['checkbox_choose'][$formData['select_category']]){
//			$xajax->call("alert('Нельзя перенести выбранные товары в ту же самую категорию.')");
//			return $xajax;
//		}

		// проверяем не содержит ли выбранная "принимающая" категория категории
		$query = $conn->newStatement("SELECT id FROM category WHERE parent_id=:parent_id:");
		$query->setInteger('parent_id', $formData['select_category']);
		$data = $query->getAllRecords();
		if($data){
			$xajax->call("alert('Нельзя перенести выбранные вами товары в категорию, которая содержит категории. В одной категории не могут одновременно быть и товары и категории.')");
			return $xajax;
		}


		// ПЕПЕРЬ ПЕРЕНОСИМ!
		$to_where = implode(',',array_keys($formData['checkbox_choose']));
		$query = $conn->newStatement("UPDATE product SET id_category=:id_category: WHERE id IN ({$to_where})");
		$query->setInteger('id_category', $formData['select_category']);
		$query->execute();

		$xajax->redirect("/admin/category/list/{$formData['select_category']}/");

		return $xajax;
	}


}
?>
