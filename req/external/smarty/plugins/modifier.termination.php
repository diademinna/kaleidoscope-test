<?php

// ПРИМЕРЫ 
/*
		ДОБАВЛЕНИЕ ОКОНЧАНИЙ
	    Возращается окончание
		Получилось всеголишь три формы слова. Соответсвенно будет три условия:
		1) Если число равно 1;
		2) Если число равно от 2 до 4 (включительно);
		3) Если число равно от 5 до 9 (включительно) и число равно 0.

	 * ПРИМЕР
       ресторан{$number|termination:"":"а":"ов"}   // Всего X ресторан[а][ов]
*/	

function smarty_modifier_termination($quantity, $end_1, $end_2_4, $end_5_0){
	if($quantity){
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
}