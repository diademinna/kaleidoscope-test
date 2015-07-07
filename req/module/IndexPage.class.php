<?php
class IndexPage extends AbstractPageModule {

	function doBeforeOutput(){
		//$this->registerThis('aaa');  // XAJAX - функции для этого класса
		//$this->processRequest();  // если нет общих XAJAX-функций 
		$this->doInit();
	}

	function doContent(){
               
                $query = $this->conn->newStatement("SELECT * FROM category WHERE active=1 AND main!=0 ORDER BY main ASC");
		$data_category = $query->getAllRecords();
		$this->template->assign('data_category', $data_category);
                
                
                //популярные товары
                $query = $this->conn->newStatement("SELECT pr.*, pr_info.views as views FROM product pr INNER JOIN product_info pr_info ON pr.id=pr_info.id_product WHERE pr.active=1 ORDER BY pr_info.views DESC, pr.id DESC LIMIT 9");

		$data_product_popular = $query->getAllRecords();
		$this->template->assign('data_product_popular', $data_product_popular);
                
                //часто покупаемые товары
                $query = $this->conn->newStatement("SELECT pr.*, pr_info.buys as buys FROM product pr INNER JOIN product_info pr_info ON pr.id=pr_info.id_product WHERE pr.active=1 ORDER BY pr_info.buys DESC, pr.id DESC LIMIT 5");

		$data_product_buys = $query->getAllRecords();
		$this->template->assign('data_product_buys', $data_product_buys);
                $this->response->write($this->renderTemplate('index.tpl'));
	
        }
}
?>