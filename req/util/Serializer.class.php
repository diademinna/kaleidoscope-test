<?php

class Serializer {
	
	protected $subject;
  protected $serialized;
  protected $classPaths = array();

  public function __construct($subject) {
    $this->subject = $subject;
  }

  public function getSubject() {
    if($this->serialized) {
      $this->_includeFiles();
      $this->subject = unserialize($this->serialized);
      $this->serialized = null;
    }
    return $this->subject;
  }

  public function getClassPaths() {
    return $this->classPaths;
  }

  public function __sleep() {
    if(is_null($this->serialized))
    {
      $this->serialized = serialize($this->subject);
      $this->_fillClassPathInfo($this->serialized);
    }
    return array('serialized', 'class_paths');
  }

  protected function _includeFiles() {
    foreach($this->classPaths as $path) {
      require_once($path);
    }
  }

  protected function _fillClassPathInfo($serialized)
  {
    $classes = self :: extractSerializedClasses($serialized);
    $this->class_paths = array();

    foreach($classes as $class) {
      $reflect = new ReflectionClass($class);
      $this->classPaths[] = $reflect->getFileName();
    }
  }

  static function extractSerializedClasses($str)
  {
    $extract_class_names_regexp = '~([\||;]O|^O):\d+:"([^"]+)":\d+:\{~';
    if(preg_match_all($extract_class_names_regexp, $str, $m))
      return array_unique($m[2]);
    else
      return array();
  }

	
}