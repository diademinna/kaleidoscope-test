<?php

require_once('proxy/Proxy.class.php');
require_once('util/ClassPath.class.php');

class ProxyActiveRecord extends Proxy
{
  protected $id;
  protected $class;
  
  public function __construct($id, $class) {
  	$this->id = $id;
  	$this->class = $class;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    parent :: __call('setId', array($id));
  }
  
  public function getClass() {
    return $this->class;
  }
    
  public function setClass($class) {
    $this->class = $class;
  }
  
  protected function _createOriginalObject()
  {
  	$classPath = new ClassPath($this->class);
  	$object = $classPath->createObject();
  	$object->loadById($this->id);
  	return $object;
  }
}

