<?php

abstract class Proxy 
{
  protected $is_resolved = false;
  protected $original;

  abstract protected function _createOriginalObject();

  public function resolve() {
    if($this->is_resolved) {
      return $this->original;
    }

    $this->original = $this->_createOriginalObject();
    $this->is_resolved = true;

    return $this->original;
  }

  public function __call($method, $args = array()) {
    $this->resolve();
    if(method_exists($this->original, $method)) {
      return call_user_func_array(array($this->original, $method), $args);
    }
  }

   public function __get($attr) {
     $this->resolve();
     return $this->original->$attr;
   }

   public function __set($attr, $val) {
     $this->resolve();
     $this->original->$attr = $val;
   }
}

