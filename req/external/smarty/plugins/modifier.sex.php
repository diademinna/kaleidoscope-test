<?php

function smarty_modifier_sex($string, $end_male = '', $end_female = 'а', $end_unknown = '(а)') {
  switch ($string) {
	case '1': $result = &$end_male;break;
	case '2': $result = &$end_female;break;
	default: $result = &$end_unknown;break;
  }
  return $result;
}