<?php
//require_package("smarty");
require_once('module/AbstractPageModule.class.php');
//require_once('smarty/src/template/SmartyTemplateEngine.class.php');
class TemplateRunner extends AbstractPageModule {
  
  var $temp;
  function TemplateRunner($template, &$request, &$response){
    //parent::AbstractPageModule(&$request, &$response);  // устарело - Zero
    parent::AbstractPageModule($request, $response);
  //  $this->smarty = new SmartyTemplateEngine();
    $this->temp = $template;
  }
  
  function doCheckAccess(){
    return true;
  }
  
  function doContent(){
    $this->response->write($this->renderTemplate($this->temp));
  }
}
?>