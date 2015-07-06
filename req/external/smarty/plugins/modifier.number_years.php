<?php

// ПРИМЕРЫ 
/*
		ОПРЕДЕЛЕНИЕ ВОЗРАСТА ЮЗЕРА
	   
	 * ПРИМЕР
       {$date|number_years}   // 31 год
*/	



function smarty_modifier_number_years($userBirthday){ //	 '1982-12-08'; // День рождение юзера
    if($userBirthday){
		$birthday = strtotime($userBirthday); // Получаем unix timestamp нашего дня рождения
		
		$years = date('Y') - date('Y', $birthday); // Вычисляем возраст БЕЗ учета текущего месяца и дня
		$now = time();
		$nowBirthday = mktime(0,0,0,date('m',$birthday),date('d',$birthday),date('Y')); // Получаем день рождение пользователя в этом году
		if ($nowBirthday > $now) {
		   $years --; // Если дня рождения ещё не было то вычитаем один год
		}
		

		$lastDigit = substr($years, strlen($years)-1,1);
		$yearStr = 'лет';
		if ($lastDigit == '1' && $years != '11') {
		   $yearStr = 'год';
		} 
		elseif (  ($lastDigit == '2'|| $lastDigit == '3'|| $lastDigit == '4') && ($years != '12' && $years != '13' && $years != '14') ){
		   $yearStr = 'года';
		}
		
        return $years." ".$yearStr;
    } 
	else{
        return $date;
    } 
} 

?>
