<?php
class AdminParameterListPage extends AbstractPageModule {

	var $mass_all_child_parameter; // массив всех дочерних + ложим туда текущую.
	var $mass_parameter; // массив всех

	function doBeforeOutput(){
		$this->Authenticate();

		$this->registerThis("ChangeCountPage", "Activate", "Sort", "ActivateProduct", "SortProduct", "ChangeFlag", "ChangeCategory", "ChangeProduct");
		$this->processRequest();
		$this->template->assign('unit', "parameter");
	}


	function doContent(){
		$id_parameter = $this->request->getValue('id_parameter');
		$action = $this->request->getValue ('action');

		$this->template->assign('id_parameter', $id_parameter?$id_parameter:"0");

		//die();
		if ($action == "delete"){ // УДАЛЕНИЕ КАТЕГОРИИ и всех ее потомков
                    $id = $this->request->getValue('id'); // для удаления

                    //достаем все категории
                    $query = $this->conn->newStatement("SELECT * FROM parameter ORDER BY parent_id ASC, id ASC");
                    $data = $query->getAllRecords('id');
                    //теперь создаем массив в виде дерева
                    $tree = array();
                    foreach ($data as $cur) {
                            $tree[(int)$cur['parent_id']][] = $cur;
                    }

                    $this->mass_all_child_parameter[$id] = $id; // текущую категорию сразу добавляем
                    $this->FindAllChildCategory($tree, $id); // добавляем все дочерние категории в этот массив mass_all_child_parameter

                    // удаляем категории
                    $query = $this->conn->newStatement("DELETE FROM parameter WHERE id IN (".implode(',', array_keys($this->mass_all_child_parameter) ).")");
                    $query->execute();
                     $query = $this->conn->newStatement("DELETE FROM product_parameter WHERE id_parameter IN (".implode(',', array_keys($this->mass_all_child_parameter) ).")");
                    $query->execute();

                    // удалить все картинки категорий
                    if($this->mass_all_child_parameter){
                        foreach ($this->mass_all_child_parameter as $cur) { // $cur - id категори
                            if($data[$cur]['ext']){
                                FileSystem::deleteFile("uploaded/parameter/{$cur}_sm.{$data[$cur]['ext']}");
                                FileSystem::deleteFile("uploaded/parameter/{$cur}.{$data[$cur]['ext']}");
                            }
                        }
                    }

                    $this->response->redirect("/admin/parameter/list/".($id_parameter?$id_parameter:'0')."/");
		} // конец удаления
		else { // ФОРМИРОВАНИЕ СПИСКА и ВЫВОД

                    if(!$id_parameter){ // главная
                            $where_cat = "parent_id=0";
                            $where_prod = "id_parameter=0";
                    }
                    else{ // подкатегория (выбрана категория)
                            $where_cat = "parent_id=:id_parameter:";
                            $where_prod = "id_parameter=:id_parameter:";
                    }

                    
                    // достаем все КАТЕГОРИИ в этой категории
                    $query = $this->conn->newStatement("SELECT * FROM parameter WHERE {$where_cat} ORDER BY id DESC");
                    $query->setInteger('id_parameter', $id_parameter);
                    $data_parameter = $query->getAllRecords();
                    foreach ($data_parameter as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT * FROM parameter WHERE parent_id=:parent_id:");
                        $query->setInteger('parent_id', $value['id']);
                        $data_parameter_child = $query->getAllRecords();
                        if ($data_parameter_child)
                        {
                            $data_parameter[$key]['parameter_child']=$data_parameter_child;
                        }
                    }
                    $this->template->assign('data_parameter', $data_parameter);



                    // ФОРМИРУЕМ НАВИГАЦИЮ.
                    if($id_parameter){  // выбрана какая-то категория
                            // достаем все категории
                            $query = $this->conn->newStatement("SELECT * FROM parameter ORDER BY parent_id ASC, id ASC");
                            $data = $query->getAllRecords('id');

                            // ищем для навигации родительские категории
                            $mass_navigation =array();
                            $cur_cat = $id_parameter; // текущая категория для навигации
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

			

			$query = $this->conn->newStatement("SELECT * FROM parameter ORDER BY name ASC");
			$data = $query->getAllRecords('id');
			$this->template->assign('data_parameter_all', $data);

			$this->response->write($this->renderTemplate('admin/admin_parameter_list.tpl'));
		}
	}



	function FindAllChildCategory($tree, $cur_id_cat=0) {
	    if (empty($tree[$cur_id_cat])){
	        return;
	    }
	    foreach ($tree[$cur_id_cat] as $k => $row) {
			$this->mass_all_child_parameter[$row['id']] = $row['id'];
	        if (isset($tree[$row['id']])){  // есть ли у него (подкатегории)
	            $this->FindAllChildCategory($tree, $row['id']);
	        }
	    }
	    return;
	}




	//*** DEVELOPER AJAX ***//

	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$xajax = new xajaxResponse();

		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$xajax->redirect("/admin/parameter/list/{$new_get_param}");

		return $xajax;
	}

	// Отображать или скрыть выбранный элемент. (категории)
	function Activate($id){
		$xajax = new xajaxResponse();

		$conn =& DbFactory::getConnection();

		$query = $conn->newStatement("SELECT * FROM parameter WHERE id={$id}");
		$data = $query->getFirstRecord();

		$query = $conn->newStatement("UPDATE parameter SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();


		if($data['active']==1){
                    //достаем все категории
                    $query = $conn->newStatement("SELECT * FROM parameter ORDER BY parent_id ASC, pos DESC, id ASC");
                    $data = $query->getAllRecords('id');
                    //теперь создаем массив в виде дерева
                    $tree = array();
                    foreach($data as $cur){
                            $tree[(int)$cur['parent_id']][] = $cur;
                    }

                    $this->mass_all_child_parameter[$id] = $id; // текущую категорию сразу добавляем
                    $this->FindAllChildCategory($tree, $id); // добавляем все дочерние категории в этот массив mass_all_child_parameter

                    if(count($this->mass_all_child_parameter)>1){ // иначе она уже сброшена
                            // сбрасываем категории
                            $query = $this->conn->newStatement("UPDATE parameter SET active=0 WHERE id IN (".implode(',', array_keys($this->mass_all_child_parameter) ).")");
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
			$query = $conn->newStatement("UPDATE parameter SET pos=:pos: WHERE id=:id:");
	        $query->setInteger('pos', $min_pos);
	        $query->setInteger('id', $value);
	        $query->execute();
			$min_pos++;
		}

		return $xajax;
        }


}
?>
