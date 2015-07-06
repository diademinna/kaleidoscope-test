<?php

require_once('db/DbTable.class.php');

class DbTree {
  
  var $dbTable;
  var $rootId;
  
  var $treeFields = array(
    'id' => 'id',
    'root_id' => 'root_id',
    'parent_id' => 'parent_id',
    'path' => 'path',
    'ident' => 'ident',
    'level' => 'level' ,
    'priority' => 'priority'   
  );
  
  function DbTree($tableName, $rootId = 1) {
    
  	$this->dbTable =& new DbTable($tableName);
  	$this->rootId = $rootId;
  	
  }
  
  function getNode($id) {
  	return $this->dbTable->selectById($id);
  }
  
  function isNodeExists($id) {
  	if($this->dbTable->selectById($id))
  	   return true;
  	return false;     
  }
  
  function insertRootNode($imp_values) {
  	$values[$this->treeFields['path']] = '/';
  	$values[$this->treeFields['parent_id']] = 0;
  	$values[$this->treeFields['root_id']] = $this->rootId;
    $values[$this->treeFields['ident']] = $imp_values['ident'];
    $values[$this->treeFields['priority']] = $imp_values['priority'];
    $values[$this->treeFields['level']] = 0;
  	$new_id = $this->dbTable->insert($values);
  	
  	if ($new_id) {
  	  $updateValues = array($this->treeFields['path'] => $new_id);
  	  $this->dbTable->updateById($updateValues, $new_id);
  	  return true;
  	} else {
  	  return false;
  	}
  }
  
  function insertChildNode($values) {
  	$parent_id = $values[$this->treeFields['parent_id']];
  	
  	$parent_node = $this->getNode($parent_id);
  	$parent_path = $parent_node['path'];
  	
  	$values[$this->treeFields['path']] = '/';
  	$values[$this->treeFields['level']] = $parent_node[$this->treeFields['level']] + 1;
  	$values[$this->treeFields['root_id']] = $this->rootId;

  	$new_id = $this->dbTable->insert($values);
  	if ($new_id) {
  	  $updateValues = array($this->treeFields['path'] => $parent_path . '/' . $new_id);
  	  $this->dbTable->updateById($updateValues, $new_id);
  	}
  }
  
  function updateIdent($id, $newIdent) {
  	$updateValues = array($this->treeFields['ident'] => $newIdent);
  	return $this->dbTable->updateById($updateValues, $id);
  }
  
  function moveNode($id, $new_parent_id) {
  	// change parent_id u $id
  	// change pathes & level
  	$parent = $this->getNode($new_parent_id);
  	$updateValues[$this->treeFields['parent_id']] = $parent['id'];
  	$updateValues[$this->treeFields['path']] = $parent['path']."/".$id;
  	$updateValues[$this->treeFields['level']] = $parent['level'] + 1;
  	$this->dbTable->updateById($updateValues,$id);
    $node = $this->getNode($id); 
  	return $this->_refreshNode($node);
  }
  
  function getNodeByPath($path) {
   $tok = strtok($path,"/");
   do
     { $str = $tok;   
     $tok = strtok("/");
     }
   while($tok)   ;
   return $this->getNode($str); 
     
  }
  
  function getSubBranch($id, $depth = -1, $includeParent = false) {
  	$parentNode = $this->getNode($id);  
    $result = array();
    if ($parentNode) 
    {
      if ($depth != -1) $depth += $parentNode['level'];      
      if ($includeParent) $result[] = $parentNode;      
      $this->_getBranchRecursive($id, $depth, $result);
    }
    return $result;
  }
  
  function _refreshNode($node, $parent = false)
  {
    if (!$parent) 
      $parent = $this->getParent($node['id']);
    
    $children = $this->getChildren($node['id']);
    $updateValues[$this->treeFields['level']] = $parent['level'] + 1;
    $updateValues[$this->treeFields['path']] = $parent['path'] . '/' . $node['id'];
     $this->dbTable->updateById($updateValues,$node['id']) ;
    $this->dbTable->updateById($updateValues,$node['id']);
       foreach ($children as $child)
    if (!$this->_refreshNode($child, $this->getParent($child['id']))) return false;
     return true;
  }
 function getChildren($id)
  {
    $query = $this->treeFields['parent_id'] . "=" . $id;
    return $this->dbTable->select($query);
  } 
function getParent($id)
  {
    if (!($node = $this->getNode($id))) return false;
    return $this->getNode($node['parent_id']);    
  }
function updatePriority($id,$newPriority)
  {
    $updateValues = array($this->treeFields['priority'] => $newPriority);
  	return $this->dbTable->updateById($updateValues, $id);
    
  }
function getNodeByIdent($ident)
{
  $where = $this->treeFields['ident'] . "='" . $ident. "'";
  return $this->dbTable->selectFirst($where);
  
  
}
function _getBranchRecursive($parentId, $levelLimit, &$result)
  {
    $children = $this->getChildren($parentId);
    foreach ($children as $child)
    {
      $result[] = $child;
      if ($levelLimit == -1 || $child['level'] < $levelLimit)
      {
        $this->_getBranchRecursive($child['id'], $levelLimit, $result);
      }
    }
  }
function deleteNode($id, $deleteSubNodes = false)
  { $fl = $this->getChildren($id);
    if ((!$deleteSubNodes) && !empty($fl)) return false;
    
    if ($deleteSubNodes)
    {
      $children = $this->getChildren($id);
      foreach ($children as $child)
        $this->deleteNode($child['id'], true);
    }
    
     return $this->dbTable->deleteById($id,true);
  }
function getParents($id)
  {
    $parents = array();
    $node = $this->getNode($id);
    $path = explode('/',$node['path']);
    array_pop($path);
    foreach ($path as $current)
    {
      $parents[] = $this->getNode($current);
    }
    
  return $parents;
  }
  
 function getRootNode()
 {  
   $where = $this->treeFields['level'] . " = '0' and " . $this->treeFields['root_id'] . " = '" . $this->rootId . "'";
   return  $this->dbTable->selectFirst($where);
 }
}