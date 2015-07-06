<?php
class CartPage extends AbstractPageModule {

    function doBeforeOutput(){
            $this->doInit();
    }

    function doContent(){
        /*    $query = $this->conn->newStatement("SELECT * FROM content WHERE url=:url:");
            $query->setVarChar('url', $url);
            $data = $query->getFirstRecord();
            $this->template->assign("data", $data);

            $this->setPageTitle("".($data['title']?$data['title']:$data['name'])."");*/

            $this->response->write($this->renderTemplate('user/cart.tpl'));
            
           
    }
}
?>