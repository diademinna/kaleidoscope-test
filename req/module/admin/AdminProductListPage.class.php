<?php
class AdminProductListPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate");
		$this->processRequest();
                $this->template->assign('unit', "product");
	}
	
	function doContent(){	
            
                $conn = &DbFactory::getConnection();
                if($GLOBALS[_SERVER][QUERY_STRING]){
                        $get_param = "?".$GLOBALS[_SERVER][QUERY_STRING];
                }
                else{
                        $get_param = "";
                }
                $this->template->assign('get_param', $get_param);

                $page = $this->request->getValue('page')?$this->request->getValue('page'):1;
                $this->template->assign('page', $page);

                $action = $this->request->getValue ('action');
		
		if ($action == "delete"){			
                    $id = $this->request->getValue('id'); // для удаления

                    $query = $this->conn->newStatement("SELECT * FROM product WHERE id=:id:");
                    $query->setInteger('id', $id);
                    $data_product = $query->getFirstRecord();

                    $query = $this->conn->newStatement("DELETE FROM product WHERE id=:id:");
                    $query->setInteger('id', $id);
                    $query->execute();
                    $query = $this->conn->newStatement("DELETE FROM product_info WHERE id_product=:id_product:");
                    $query->setInteger('id_product', $id);
                    $query->execute();
                    
                    $query = $this->conn->newStatement("SELECT * FROM order_product WHERE id_product=:id_product:");
                    $query->setInteger('id_product', $id);
                    $data_order = $query->getAllRecords();
                    if ($data_order)
                    {
                        $query = $this->conn->newStatement("DELETE FROM order_product WHERE id_product=:id_product:");
                        $query->setInteger('id_product', $id);
                        $query->execute();
                        foreach ($data_order as $key=>$value)
                        {
                            $query = $this->conn->newStatement("DELETE FROM orders WHERE id=:id:");
                            $query->setInteger('id', $value['id_order']);
                            $query->execute();
                        }
                    }

                    FileSystem::deleteFile("uploaded/product/{$id}_sm.{$data_product['ext']}");
                    FileSystem::deleteFile("uploaded/product/{$id}_prev.{$data_product['ext']}");
                    FileSystem::deleteFile("uploaded/product/{$id}_buy.{$data_product['ext']}");
                    FileSystem::deleteFile("uploaded/product/{$id}.{$data_product['ext']}");
								
                    // удаляем галерею
                    $query = $this->conn->newStatement("SELECT * FROM product_photo WHERE id_product=:id_product: ORDER BY id ASC");
                    $query->setInteger('id_product', $id);
                    $data_photo = $query->getAllRecords();

                    $query = $this->conn->newStatement("DELETE FROM product_photo WHERE id_product=:id_product:");
                    $query->setInteger('id_product', $id);
                    $query->execute();

                    foreach ($data_photo as $key=>$value){
                        FileSystem::deleteFile("uploaded/product/{$id}/{$value['id']}_prev.{$value['ext']}");
                        FileSystem::deleteFile("uploaded/product/{$id}/{$value['id']}_sm.{$value['ext']}");
                        FileSystem::deleteFile("uploaded/product/{$id}/{$value['id']}.{$value['ext']}");
                    }
                    FileSystem::deleteFolder("uploaded/product/{$id}", true);
                    $this->response->redirect("/admin/product/list/{$page}/".($get_param?$get_param:""));
                           
		}
                else
                {
                    
                   if($this->request->getValue('count_page')){
                            define('COUNT_PAGE', $this->request->getValue('count_page'));
                    }
                    else{
                            define('COUNT_PAGE', 20);
                    }
                    require_once 'module/common/PagerFactory.class.php';

                    $pager = new PagerFactory();
                    $sql = "SELECT * FROM product ORDER BY id DESC";
                    $fromWhereCnt = "product";
                    $href = "/admin/product/list/".$get_param;

                    $pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
                    $data_product = $pager->getPageData();

                    $this->template->assign('pager_string', $pagerString);
                    $this->template->assign('data_product', $data_product);

                    $this->response->write($this->renderTemplate('admin/admin_product_block.tpl'));
                }
	}
        // Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/product/list/{$new_get_param}");
		
		return $objResponse;
	}
	
	// Отображать или скрыть выбранный элемент.
	function Activate($id){
		$xajax = new xajaxResponse();
		
		$conn =& DbFactory::getConnection();
		$query = $conn->newStatement("SELECT * FROM product WHERE id={$id}");
		$data = $query->getFirstRecord();
		
		$query = $conn->newStatement("UPDATE product SET active=:active: WHERE id=:id:");
		$query->setInteger("active", $data['active']==1?0:1);
		$query->setInteger("id", $id);
		$query->execute();
		
		return $xajax;
	}
}
?>