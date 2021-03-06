<?php
/**
* Smarty plugin
* 
* @package Smarty
* @subpackage PluginsModifier
*/

/**
* Smarty date_format modifier plugin
* 
* Type:     modifier<br>
* Name:     date_format<br>
* Purpose:  format datestamps via strftime<br>
* Input:<br>
*          - string: input date string
*          - format: strftime format for output
*          - default_date: default date if $string is empty
* 
* @link http://smarty.php.net/manual/en/language.modifier.date.format.php date_format (Smarty online manual)
* @author Monte Ohrt <monte at ohrt dot com> 
* @param string $ 
* @param string $ 
* @param string $ 
* @return string |void
* @uses smarty_make_timestamp()
*/
function smarty_modifier_date_format_months($string, $format = SMARTY_RESOURCE_DATE_FORMAT, $default_date = '',$formatter='auto')
{
    /**
    * Include the {@link shared.make_timestamp.php} plugin
    */
    
	$months = array(
		'Январь' => 'января',
		'Февраль' => 'февраля',
		'Март' => 'марта',
		'Апрель' => 'апреля',
		'Май' => 'мая',
		'Июнь' => 'июня',
		'Июль' => 'июля',
		'Август' => 'августа',
		'Сентябрь' => 'сентября',
		'Октябрь' => 'октября',
		'Ноябрь' => 'ноября',
		'Декабрь' => 'декабря'
	);


    require_once(SMARTY_PLUGINS_DIR . 'shared.make_timestamp.php');
    if ($string != '') {
        $timestamp = smarty_make_timestamp($string);
    } elseif ($default_date != '') {
        $timestamp = smarty_make_timestamp($default_date);
    } else {
        return;
    } 
    if($formatter=='strftime'||($formatter=='auto'&&strpos($format,'%')!==false)) {
        if (DS == '\\') {
            $_win_from = array('%D', '%h', '%n', '%r', '%R', '%t', '%T');
            $_win_to = array('%m/%d/%y', '%b', "\n", '%I:%M:%S %p', '%H:%M', "\t", '%H:%M:%S');
            if (strpos($format, '%e') !== false) {
                $_win_from[] = '%e';
                $_win_to[] = sprintf('%\' 2d', date('j', $timestamp));
            } 
            if (strpos($format, '%l') !== false) {
                $_win_from[] = '%l';
                $_win_to[] = sprintf('%\' 2d', date('h', $timestamp));
            } 
            $format = str_replace($_win_from, $_win_to, $format);
        } 
        $temp = strftime($format, $timestamp); //+++++        
        foreach ($months as $key=>$value) $temp = str_replace($key, $value, $temp);        
        return $temp;
    } else {
        return date($format, $timestamp);
    }
} 

?>
