<?php

/**
 * Simple Module for sending emails to out users
 * Last revision: 2006-06-17
 */
class MailUtil
{
	var $mmTo;
	var $mmSubj;
	var $mmText;
	var $mmHeaders;

	function  __construct() {
		$this->mmHeaders = "Content-Type: text/html; charset=windows-1251;\n";
	}

	function setEmailText($text)
	{
		$this->mmText = $text;
	}

	function setEmailTextTemplate($template, $templatedata='')
	{
		$oSmarty = new Smarty();
		$oSmarty->assign('tdata',$templatedata);
		$this->mmText = $oSmarty->fetch($template);
	}

	function setFrom($mail_from)
	{
		$this->mmHeaders .= "From:" . $mail_from . ";\n";
	}

	function setTo($to)
	{
		$this->mmTo = $to;
	}

	function setSubject($subj)
	{
		$this->mmSubj = $subj;
	}

	function doSend()
	{
		$theme = "=?windows-1251?Q?".str_replace("%","=",rawurlencode(iconv('UTF-8', 'windows-1251',$this->mmSubj)))."?=";
		return mail($this->mmTo, $theme, iconv('UTF-8', 'windows-1251',$this->mmText), $this->mmHeaders);
	}

} 