<?php
// Только первая буква большая
// ПРИМЕРЫ 
//		{$var|capitalize_first}
//		БЫЛО  ИНОПЛАНТЯНЕ НИ ПРИ ЧЕМ
//		СТАНЕТ Иноплантяне ни при чем

function smarty_modifier_capitalize_first($name){
	$first = mb_substr($name, 0, 1, 'UTF-8');//первая буква
	$last = mb_substr($name,1);//все кроме первой буквы
	$first = mb_strtoupper($first, 'UTF-8');
	$last = mb_strtolower($last, 'UTF-8');
	return $first.$last;	
}