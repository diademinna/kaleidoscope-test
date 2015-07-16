<?php
require_once("module/FormPageModule.class.php");
require_once("module/common/Pager.class.php");
require_once('validator/Validator.class.php');

class SearchPage extends FormPageModule{
	function doBeforeOutput(){
            $this->doInit();
            $this->setPageTitle("Поиск");
	}
	function doFormInit() {
            $this->response->write($this->renderTemplate('search.tpl'));
	}
	function doFormValid() {
		
		/* НАСТРОЙКИ */
		$search_array = array(
                    /*array(
                        'sql' => '
                                SELECT b.*, bp.url AS url_parent
                                FROM blog b
                                INNER JOIN blog bp ON b.parent_id=bp.id
                                WHERE (b.name LIKE :s: OR b.text LIKE :s: OR b.text2 LIKE :s: OR b.anons LIKE :s:) AND b.parent_id>0', //запрос
                        'route' => '/blog/[url_parent]/[url]/', //вид ссылки/[id] - равно полю из базы
                        'result_name' => 'name', //какое поле использовать для заголовка в результатах
                        'result_text' => array('text', 'text2', 'anons')//из каких полей выводить текст в результатах(в порядке значимости)
                    ),*/
                    array(
                            'sql' => 'SELECT * FROM category WHERE active=1 AND (text LIKE :s: OR name LIKE :s:)',  // категории
                            'route' => '/category/[id]/',
                            'result_name' => 'name',
                            'result_text' => array('text')
                    ),
                    array(
                            'sql' => 'SELECT * FROM product WHERE active=1 AND (text LIKE :s: OR name LIKE :s:)',  // продукты
                            'route' => '/product/[id]/',
                            'result_name' => 'name',
                            'result_text' => array('text')
                    ),
                    array(
                            'sql' => 'SELECT * FROM review WHERE active=1 AND text LIKE :s:',  // отзывы
                            'route' => '/review/[id]/',
                            'result_name' => 'name',
                            'result_text' => array('text')
                    ),
                    array(
                            'sql' => 'SELECT * FROM actions WHERE active=1 AND (text LIKE :s: OR name LIKE :s: OR anons LIKE :s:)',  // акции
                            'route' => '/actions/[id]/',
                            'result_name' => 'name',
                            'result_text' => array('text', 'anons')
                    ),
                    array(
                            'sql' => 'SELECT * FROM portfolio WHERE active=1 AND (text LIKE :s: OR name LIKE :s: OR anons LIKE :s:)',  // портфолио
                            'route' => '/portfolio/[id]/',
                            'result_name' => 'name',
                            'result_text' => array('text', 'anons')
                    ),
                   /* array(
                            'sql' => 'SELECT * FROM pages WHERE text LIKE :s: AND id=3',  // услуги
                            'route' => '/about/',
                            'result_name' => 'name',
                            'result_text' => array('text')
                    )*/
		);
		/* НАСТРОЙКИ конец */
		

		$search = trim($this->request->getValue('submitted'));
		$search = mb_substr($search, 0, 64);//обрезаем строку
		$search = addslashes(htmlspecialchars($search));
		$search = preg_quote($search);
		if(mb_strlen($search) < 3 ){     //проверяем длину поскового запроса
			$this->template->assign('error', 'Слишком короткий запрос');
		}
		else{
			$result = array();
			$search_result = array();
			foreach($search_array as $cur_sql){
					$sql = $cur_sql['sql'];
					$query = $this->conn->newStatement($sql);
					$query->setVarChar('s', "%{$search}%");
					$data_bd = $query->getAllRecords();
					
					preg_match_all('~\[(\w+)?\]~is', $cur_sql['route'], $route);//обрабатывает route
										
					//print_r($route); die();
//					Array(
//							[0] => Array
//								(
//									[0] => [url_parent]
//									[1] => [url]
//								)
//
//							[1] => Array
//								(
//									[0] => url_parent
//									[1] => url
//								)
//
//						)
					
					if($data_bd){
						foreach ($data_bd as $key=>$cur_res){
							$result_route = $cur_sql['route'];
							
							//заменяем ссылки на данные из базы
							if($route[1]){
								foreach ($route[1] as $r_r){
									//генерируем ссылку
									$result_route = str_replace("[{$r_r}]", $cur_res[$r_r] , $result_route); // значением из БД заменяем в $cur_sql['route'] необходимое поле.
								}
							}
							if($result_route){
								$result[$key]['route'] = $result_route;//добавляем в массив готовую ссылку
							}
							else{
								$result[$key]['route'] = $cur_sql['route'];//добавляем в массив готовую ссылку
							}
							
							$cur_res[$cur_sql['result_name']] = preg_replace('~('.$search.')~ui', "<span class='search-res'>\\0</span>", $cur_res[$cur_sql['result_name']]);//добавляем span найденному
							$result[$key]['result_name'] = $cur_res[$cur_sql['result_name']];//добавляем в массив готовую ссылку
							$result[$key]['result_text'] = SearchPage::getText($search, $cur_res, $cur_sql['result_text']);//получаем текст для вывода
							//print_r ($result[$key]['result_text']);
						}
						$search_result = array_merge($search_result, $result);
						$result = array(); // очищаем найденные строки для след. таблиц БД
					}

			}
			//print_r($result);

			$this->template->assign('result', $search_result);
		}
		$this->response->write($this->renderTemplate('search.tpl'));
		
	}
	function getText($search, $base_result, $text_array){

		foreach ($text_array as $ta){
			$res = strip_tags($base_result[$ta]);
			$pos = mb_stripos($res, $search);

			if($pos !== false){
				//позиция найдена, обрабатываем
				$base_count = mb_strlen($res);
				$finish = $base_count - 300;
				if($pos < 200){ //позиция
					$de = mb_substr($res, 0, 300);
				}elseif($finish < $pos){
						$de = mb_substr($res, $base_count - 300);
				}else{
					$finish = $pos + 100;
					$de = mb_substr($res, $pos-200, 300);
				}

					$de  = preg_replace('~('.$search.')~ui', "<span class='search-res'>\\0</span>", $de);//добавляем span найденной строке
					return $de ." ...  <br />";
			}
			elseif($pos === false){
				//если позиция не найдена, то складываем все результаты в массив
				$de_arr[] = $res;
			}
		}
		$de_len = 0;
		//ищем из массива самую длинную строку для вывода
		foreach($de_arr as $da){
			$de_len_new = mb_strlen($da);
			if($de_len_new > $de_len){
				$res = $da;
				$de_len = $de_len_new;
			}
		}
		$de = mb_substr($res, 0, 300);//отрезаем 300 символов от начала строки
		$de  = preg_replace('~'.$search.'~ui', "<span class='search-res'>\\0</span>", $de);//добавляем span найденной строке
		return $de ." ...  <br />";
	}
		
	function doValidation() {
		return true;
	}



}

?>
