<?php
require_once("module/AbstractPageModule.class.php");

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class SortProductPage extends AbstractPageModule {

	
	
	function doContent(){
		
		$action_val = (int) $this->request->getValue('action_val');
		$id_category = (int) $this->request->getValue('id_category');
		$min_price = (int) $this->request->getValue('min_price');
		$max_price = (int) $this->request->getValue('max_price');
                if ($action_val == 0)
                {
                    $name_field = "id";
                    $sort_order = "DESC";
                }
                else if ($action_val == 1)
                {
                    $name_field = "price";
                    $sort_order = "ASC";
                }
                else if ($action_val == 2)
                {
                    $name_field = "price";
                    $sort_order = "DESC";
                }
                else if ($action_val == 3)
                {
                    $name_field = "name";
                    $sort_order = "ASC";
                }
                else if ($action_val == 4)
                {
                    $name_field = "name";
                    $sort_order = "DESC";
                }
                define('COUNT_PAGE', 9);
                require_once 'module/common/PagerFactory.class.php'; 
                $pager = new PagerFactory();
                $page = $this->request->getValue ('page');
                if(!$page){
                        $page = (int) $this->request->getValue('page');
                }
                $this->template->assign('page', $page);
                if (!$id_category)
                {
                    if (!$min_price && !$max_price)
                    {
                        $sql = "SELECT * FROM product WHERE active=1 ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE active=1";
                        $href = "/category/page/";
                    }
                    else
                    {
                        $sql = "SELECT * FROM product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND active=1 ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND active=1";
                        $href = "/category/page/?min_price=".$min_price."&max_price=".$max_price;
                    }
                }
                else
                {
                    $query = $this->conn->newStatement("SELECT id FROM category WHERE parent_id=:parent_id:");
                    $query->setInteger('parent_id', $id_category);
                    $data_subcategory = $query->getAllRecords();
                    $mass = "";
                    $mass = $id_category;
                    if ($data_subcategory)
                    {
                        foreach ($data_subcategory as $key=>$value)
                        {$mass=$mass.",".$value['id'];}
                    }
                    if (!$min_price && !$max_price)
                    {
                        $sql = "SELECT * FROM product WHERE active=1 AND id_category IN ($mass) ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE active=1 AND id_category IN ($mass)";
                        $href = "/category/{$id_category}/page/";
                    }
                    else
                    {
                        $sql = "SELECT * FROM product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND active=1 AND id_category IN ($mass) ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND active=1 AND id_category IN ($mass)";
                        $href = "/category/{$id_category}/page/?min_price=".$min_price."&max_price=".$max_price;
                    }
                    
                }
                $pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
                $data_product = $pager->getPageData();
                $this->template->assign('pager_string', $pagerString);
                $this->template->assign('data_product', $data_product);
                
                
                $form_data_products = $this->template->fetch('rebuild/products.tpl');
                echo json_encode(array('data_ajax_sort_products'=>$form_data_products));
                die();
	}
	
}
?>