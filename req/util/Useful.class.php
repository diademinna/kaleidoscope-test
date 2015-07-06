<?php
// полезные функции

class Useful {
	
	// перевернуть дату 
	// 2013-20-05 в 05-20-2013
	// или обратно
	// 05-20-2013 в 2013-20-05
	function reverseDate($date){
		$temp = explode("-", $date);
		return "{$temp[2]}-{$temp[1]}-{$temp[0]}";		
	}
	
    
	// функция преобразует вывод даты на русский. пример: rdate("N, d M", time())
	function rdate($param, $time=0) {
		if(intval($time)==0){
			$time=time();
		}
		
		$MN=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");		
		$MonthNames[] = $MN[date('n', $time)-1]; // n - номер месяца
		
		$MN=array("Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");
		$MonthNames[] = $MN[date('w', $time)]; // w- Порядковый номер дня недели
		
		$arr[]='M';
		$arr[]='N';
		if(strpos($param, 'M')===false){
			return date($param, $time); 
		}
		else{
			return date(str_replace($arr, $MonthNames, $param), $time);
		}
	}
	
	
	
	/*
		ДОБАВЛЕНИЕ ОКОНЧАНИЙ
	    Возращается окончание
		Получилось всеголишь три формы слова. Соответсвенно будет три условия:
		1) Если число равно 1;
		2) Если число равно от 2 до 4 (включительно);
		3) Если число равно от 5 до 9 (включительно) и число равно 0.
	 * 
	 * ПРИМЕР 
	   $termination = Useful::getTermination($count_rest, "", "а", "ов");  // Всего X ресторан[а][ов]
	   $good = "ресторан".$termination;
	*/	
	function getTermination($quantity, $end_1, $end_2_4, $end_5_0){  //$quantity - кол-во		
		// исключение  Если кол-во = 11,12,13,14
		if($quantity == 11 || $quantity == 12 || $quantity == 13|| $quantity == 14) {
			$term = $end_5_0;
		}
		else{
			$quantity = substr($quantity, -1); // необходимо обрезать кол-во, оставив лишь одно число справа
			//Далее сравниваем число...
			if($quantity == 1) {$term = $end_1;} // Если кол-во равно 1
			if($quantity > 1 ) {$term = $end_2_4;} // // Если кол-во больше 1
			if($quantity > 4 || $quantity == 0) {$term = $end_5_0;} // Если кол-во больше 4 или равно 0
		}		  
	   return $term;
	}
	
		
	// формируем случайный пароль
	function createRandomPassword() {
		$chars = "abcdefghijkmnpqrstuvwxyz23456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '';
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}


	// удаляем лишнее из телефона - оставляем только 10 цифр
	function getCleanTel($tel) {
		// удаляем лишнюю инфу из телефона. оставляем только 10 цифр
		$tel = str_replace("+7", "", $tel);
		return preg_replace('/[^\d]/', '', $tel);		
	}
	
	
	
	// достаем все теги (для модуля перегенерации тегов)
	function getAllTag(){

		// достаем все теги и их кол-во.
		$query = $this->conn->newStatement("
			SELECT COUNT(btot.id_blog_tag) AS count, btot.id_blog_tag AS id_blog_tag, bt.name AS tag_name
			FROM blog_to_tag btot 
			INNER JOIN blog_tag bt ON btot.id_blog_tag=bt.id	
			GROUP BY btot.id_blog_tag 
			ORDER BY bt.name ASC");
		$blog_tag = $query->getAllRecords();

		//print_r($kolvo_tags); die();

		// считаем сумму повторений тегов.
		$kolvo_tags = sizeof($blog_tag); // кол-во тегов
		$sum = 0; // сумма всех повторений.
		$max = 0; // max значение в процентах отдельного тега.
		$min = 0; // min значение в процентах отдельного тега.
		foreach ($blog_tag as $key=>$value){
			$sum = $sum + $value['count'];
		}

		// определяем мин и макс и проценты
		$first_time = 1;		
		foreach ($blog_tag as $key=>$value){
			$cur_deg = round( ($value['count'] * 100 / $sum) , 2);
			$blog_tag[$key]['deg'] = $cur_deg;

			if($first_time){  // только первый раз.
				$min = $cur_deg;
				$max = $cur_deg;
			}			

			if($cur_deg < $min){
				$min = $cur_deg;
			}			
			if($cur_deg > $max){
				$max = $cur_deg;
			}	

			$first_time = 0;
		}

		// считаем разницу процентов
		$raznica_deg = round( ($max - $min) , 2);

		// считаем шаг процента
		$intervals = 10;// всего у нас 10 позиций для шрифта
		$step_deg = round( ($raznica_deg / $intervals) , 2);


		// создаем интервалы с которыми и будем сравнивать.
		$mass_tf = array();
		$cur_deg = $min;
		for ($i=1; $i<=$intervals; $i++) {
			$mass_tf[$i]['ot'] = $cur_deg;

			$cur_deg = $cur_deg + $step_deg;
			if($i == $intervals){ // только в последний раз.
				$cur_deg = $cur_deg + 1;  // чтобы избежать погрешности, + 1
			}
			$mass_tf[$i]['do'] = $cur_deg;
		}

		// расставляем необходимые классы тегам.
		foreach($blog_tag as $key=>$value){
			for($i=1; $i<=$intervals; $i++){
				if($value['deg'] >= $mass_tf[$i]['ot'] AND $value['deg'] <= $mass_tf[$i]['do']){
					$blog_tag[$key]['tf'] = $i;
					break;
				}
			}
		}
					
		//		print_r($blog_tag); die();
		//		print_r($mass_tf); die();
		//		print_r($raznica_deg); die();
		//		print_r($min."---".$max); die();
		//		print_r($blog_tag); die();
		
		return $blog_tag;

	}
	
	
	// перегенерить статическую информацию на сайте
	function rebuildStaticTpl($tplName) {
        
		if($tplName =="tags"){// теги 
			
			$all_tags = Useful::getAllTag();
			
			$kolvo_tag = sizeof($all_tags);
			if($kolvo_tag > 20){
				$temp_tags = array_rand($all_tags, 20);  // берем рендомом несколько тегов, берет только индексы
				$array_good = array();
				foreach ($temp_tags as $key=>$value){
					$array_good[] = $all_tags[$value];
				}
				$all_tags = $array_good;
			}
			
			//print_r($all_tags);die();
			
			if ($all_tags){
				$template =& new Smarty(); // initialize smarty
				$template->assign('rand_blog_tag', $all_tags);
				FileSystem::createFolder("templates/rebuild", 0777);
				FileSystem::saveFile($template->fetch('rebuild/rebuild_'.$tplName.'.tpl'),'templates/rebuild', 'static_'.$tplName.'.tpl');
			}
		}
	}
	
	
	
	
	
  
}
