<?php
// ПРИМЕРЫ 
//		{$number|cost}
//		БЫЛО 2222
//		СТАНЕТ 2 222
//		
//		{$number|cost:","}
//		БЫЛО 2222,52
//		СТАНЕТ 2 222,52

function smarty_modifier_cost($string, $sep_kop=FALSE){
	if(!$sep_kop){ // без копеек
		return number_format($string, 0, "", " ");
	}
	else{ // есть копейки
		return number_format($string, 2, $sep_kop, " ");
	}
}