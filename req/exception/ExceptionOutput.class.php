<?php

class ExceptionOutput {
	
	protected $exception;
	protected $message;
	protected $title;
	protected $file;
	protected $line;
	
	protected $params;
	
	public function __construct(Exception $exception) {
		$this->exception = $exception;
		$this->message = $exception->getMessage();
		$this->title = get_class($exception);
		$this->file = $exception->getFile();
		$this->line = $exception->getLine();
		$this->params = array();
	}

	
	function getString() {
		$result = '<div style="font-family: tahoma, arial; font-size: 14px; line-height: 1.5em; ">';
		$result .= '<b style="color: #f00; font-size: 14px; ">' . $this->title . '</b><br/>';
		$result .= '<b>Message</b>: ' . $this->exception->getMessage() . '<br/>';
		$result .= '<b>File</b>: ' . $this->file . ' ';
		$result .= '<b>Line</b>: ' . $this->line . ' ';
		
		foreach ($this->params as $key => $value) {
			$result .= '<b>' . $key . '</b>:' . $value . '<br/>';
		}
		
		$result .= '<br/><a href="javascript:void(0);" onclick="javascript:';
		$result .= 'var st=document.getElementById(\'stBlock\');st.style.display=(st.style.display==\'none\')?\'block\':\'none\';">';
		$result .= 'Stack trace</a>';
		$result .= '<div id="stBlock" style="display: none; margin: 0; ">';
		$result .= $this->getStackTrace();
		$result .= '</div>';
		$result .= '</div>';
		return $result; 	
	}
	
	function getStackTrace() {
		return str_replace('#', '<br/>', trim($this->exception->getTraceAsString(), '#'));
	}
	
	public function getParams() {
	  return $this->params;
	}
	  
	public function setParams($params) {
	  $this->params = $params;
	}

	public function getFile() {
	  return $this->file;
	}
	  
	public function setFile($file) {
	  $this->file = $file;
	}
	
	public function getLine() {
	  return $this->line;
	}
	  
	public function setLine($line) {
	  $this->line = $line;
	}
	
	public function getMessage() {
	  return $this->message;
	}
	  
	public function setMessage($message) {
	  $this->message = $message;
	}
	
	public function getTitle() {
	  return $this->title;
	}
	  
	public function setTitle($title) {
	  $this->title = $title;
	}
	
	
	
}