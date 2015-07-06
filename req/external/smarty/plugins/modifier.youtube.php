<?php

// ПРИМЕРЫ 
/*
		ВОЗВРАЩАЕТ ID Видео с YouTube

	 * ПРИМЕР
	   $youtube_link = http://www.youtube.com/watch?gl=RU&v=2bfP3TZHUzY&hl=ru
       {$youtube_link|youtube}
	   вернет 2bfP3TZHUzY
*/	

function smarty_modifier_youtube($link){
	if($link){
		$query_string = array();
		parse_str(parse_url($link, PHP_URL_QUERY), $query_string);
		return $query_string["v"];
	}
}