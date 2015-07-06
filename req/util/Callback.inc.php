<?php

function call_user_constructor_array($class, $args) 
{
  if (count($args) == 0) {
    return new $class();
  } else {
    if (class_exists($class)) {
      $code = '$obj = new ' . $class . '($args[';
      // Applying intval to the keys prevents code inject on eval
      $code .= implode('],$args[', array_map('intval', array_keys($args)));
      $code .= ']);';
      eval($code);
      return $obj;
    } else {
        throw new Exception('Class not found' . $class);
    }
  }
}

 
// Fix PHP 4 bug
function get_object_class(&$entity)
{
  if (method_exists($entity, 'getClass'))
    return $entity->getClass();
  else   
    get_class($entity);
}

function ensure_class_available($class, $file = null)
{
  return true;
  if (!class_exists($class))
  {
//    if (!$file && function_exists('__autoload'))
      
  }
}
