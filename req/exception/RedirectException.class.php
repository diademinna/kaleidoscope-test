<?php

class RedirectException extends Exception {
	
	protected $url;
	
	public function __construct($url) {
	  $this->url = $url;
	}
	
	public function getUrl() {
	  return $this->url;
	}
	  
	public function setUrl($url) {
	  $this->url = $url;
	}
	
}