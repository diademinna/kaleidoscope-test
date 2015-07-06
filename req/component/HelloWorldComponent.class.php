<?php

require_once('component/AbstractComponent.class.php');

class HelloWorldComponent extends AbstractComponent {
  
  function doContent() {
    
  	$this->response->write('<b>Year! Hello, world, мать твою!! Работает!!!</b>');
  	
  }
  
}