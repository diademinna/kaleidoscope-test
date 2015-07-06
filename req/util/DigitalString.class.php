<?php
// Число прописью!
// КЛАСС переводит цифры в их буквенный эквивалент

// СПОСОБ ПРИМЕНЕНИЯ! 
//		require_once("util/DigitalString.class.php");
//		$obj_ds = new DigitalString;
//		$dig_string = $obj_ds->written_number(1000258);
//		print_r($dig_string);die();


class DigitalString {

	var $N0 = 'ноль';		
	var $Ne0 = array(
	             0 => array('','один','два','три','четыре','пять','шесть',
	                        'семь','восемь','девять','десять','одиннадцать',
	                        'двенадцать','тринадцать','четырнадцать','пятнадцать',
	                        'шестнадцать','семнадцать','восемнадцать','девятнадцать'),
	             1 => array('','одна','две','три','четыре','пять','шесть',
	                        'семь','восемь','девять','десять','одиннадцать',
	                        'двенадцать','тринадцать','четырнадцать','пятнадцать',
	                        'шестнадцать','семнадцать','восемнадцать','девятнадцать')
	             );	
	var $Ne1 = array('','десять','двадцать','тридцать','сорок','пятьдесят', 'шестьдесят','семьдесят','восемьдесят','девяносто');	
	var $Ne2 = array('','сто','двести','триста','четыреста','пятьсот', 'шестьсот','семьсот','восемьсот','девятьсот');	
	var $Ne3 = array(1 => 'тысяча', 2 => 'тысячи', 5 => 'тысяч');	
	var $Ne6 = array(1 => 'миллион', 2 => 'миллиона', 5 => 'миллионов');

	
//	public function __construct() {
//       // if (!empty($N0)) $this->N0 = $N0;
//        
//    } 
    
	
	
	function written_number($i, $female=false) {
	  if ( ($i<0) || ($i>=1e9) || !is_int($i) ) {
	    return false; // Аргумент должен быть неотрицательным целым числом, не превышающим 1 миллион
	  }
	  if($i==0) {
	    return $this->N0;
	  }
	  else {	  	
	    return preg_replace( array('/s+/','/\s$/'), array(' ',''), DigitalString::num1e9($i, $female));
	    //return DigitalString::num1e9($i, $female);
	  }
	}
	
	function num_125($n) {
	  /* форма склонения слова, существительное с числительным склоняется
	   одним из трех способов: 1 миллион, 2 миллиона, 5 миллионов */
	  $n100 = $n % 100;
	  $n10 = $n % 10;
	  if( ($n100 > 10) && ($n100 < 20) ) {
	    return 5;
	  }
	  elseif( $n10 == 1) {
	    return 1;
	  }
	  elseif( ($n10 >= 2) && ($n10 <= 4) ) {
	    return 2;
	  }
	  else {
	    return 5;
	  }
	}
	
	function num1e9($i, $female) {
	  if($i<1e6) {
	  	
	    return DigitalString::num1e6($i, $female);
	  }
	  else {
	    return DigitalString::num1000(intval($i/1e6), false) . ' ' .
	      $this->Ne6[$this->num_125(intval($i/1e6))] . ' ' . DigitalString::num1e6($i%1e6, $female);
	  }
	}
	
	function num1e6($i, $female) {
	  if($i<1000) {	  	
	    return DigitalString::num1000($i, $female);
	  }
	  else {
	    return DigitalString::num1000(intval($i/1000), true) . ' ' .
	      $this->Ne3[$this->num_125(intval($i/1000))] . ' ' . DigitalString::num1000($i%1000, $female);
	  }
	}
	
	function num1000($i, $female) {
	  if( $i<100) {
	  	
	    return DigitalString::num100($i, $female);
	  }
	  else {	  	
	    return $this->Ne2[intval($i/100)] . (($i%100)?(' '. DigitalString::num100($i%100, $female)):'');
	  }
	}
	
	function num100($i, $female) {
	  $gender = $female?1:0;
	  if ($i<20) {
	    return $this->Ne0[$gender][$i];
	  }
	  else {
	    return $this->Ne1[intval($i/10)] . (($i%10)?(' ' . $this->Ne0[$gender][$i%10]):'');
	  }
	}
	
	
	
  
}
