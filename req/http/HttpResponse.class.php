<?php

/**
 * Http response class
 *
 * @author voyachek
 * @package core
 */

class HttpResponse {
  
  var $redirected;   
  var $content;
  
  function HttpResponse() {
    $this->redirected = false;
    $this->content = '';
  }
  
  function & getInstance() {
  	if (!isset($GLOBALS['HttpResponseInstance'])) {
  	  $GLOBALS['HttpResponseInstance'] = new HttpResponse();
  	}
  	return $GLOBALS['HttpResponseInstance'];
  }
  
  /**
   * Send http response header
   *
   * @param unknown_type $text
   */
  function sendHeader($text) {
    header($text);
  }
  
  /**
   * Send redirect header
   *
   * @param string $url Target URL
   */
  function redirect($url) {
    header('Location: ' . $url);
    $this->redirected = true;
  }
  
  /**
   * Return true if redirect headed was sent.
   *
   * @return bool
   */
  function isRedirected() {
  	return $this->redirected;
  }
  
  function clearContent() {
  	$this->content = '';
  }
  
  /**
   * Append text to output buffer
   * 
   * @param string $text
   */
  function write($text) {
    $this->content .= $text;
  }
  
  /**
   * Echo content to client and clear output buffer
   */
  function flush() {
    echo $this->content;
    flush();
    
    $this->content = '';
  }
  
  
  
  function getHTML()
  {
  	return $this->content;
  }
}
