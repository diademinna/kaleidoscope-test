<?php

require_once('util/Callback.inc.php');

class ClassPath {

  protected $class_path;
  protected $class_name;

  public function __construct($class_path, $diff_class_name = '') {
    $this->class_path = $class_path;
    if ($diff_class_name) {
      $this->class_name = $diff_class_name;
    } else {
      $this->class_name = end(explode('/', $class_path));
    }
  }

  function createObject($args = array()) {
    if (!class_exists($this->class_name)) {
      include_once($this->class_path . '.class.php');
    }
    return call_user_constructor_array($this->class_name, $args);
  }
  
}
