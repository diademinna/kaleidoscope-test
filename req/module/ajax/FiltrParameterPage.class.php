<?php
require_once("module/AbstractPageModule.class.php");

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class FiltrParameterPage extends AbstractPageModule {

	
	
	function doContent(){
		
		$id_parameter = (int) $this->request->getValue('id_parameter');
		$id_category = (int) $this->request->getValue('id_category');
                $min_price = (int) $this->request->getValue('min_price');
		$max_price = (int) $this->request->getValue('max_price');
                
                
                if ($_COOKIE['polzunok'] == 0)
                {
                    $name_field = "id";
                    $sort_order = "DESC";
                }
                else if ($_COOKIE['polzunok'] == 1)
                {
                    $name_field = "price";
                    $sort_order = "ASC";
                }
                else if ($_COOKIE['polzunok'] == 2)
                {
                    $name_field = "price";
                    $sort_order = "DESC";
                }
                else if ($_COOKIE['polzunok'] == 3)
                {
                    $name_field = "name";
                    $sort_order = "ASC";
                }
                else if ($_COOKIE['polzunok'] == 4)
                {
                    $name_field = "name";
                    $sort_order = "DESC";
                }
                $query = $this->conn->newStatement("SELECT id FROM category WHERE parent_id=:parent_id:");
                $query->setInteger('parent_id', $id_category);
                $data_subcategory = $query->getAllRecords();
                $mass = "";
                $mass = $id_category;
                if ($data_subcategory)
                {
                    foreach ($data_subcategory as $key=>$value)
                    {
                        $mass=$mass.",".$value['id'];
                    }
                }
                
                define('COUNT_PAGE', 9);
                require_once 'module/common/PagerFactory.class.php'; 
                $pager = new PagerFactory();
                $page = $this->request->getValue ('page');
                if(!$page){
                    $page = (int) $this->request->getValue('page');
                }
                $this->template->assign('page', $page);
                
                if ($id_parameter)
                {
                    $query = $this->conn->newStatement("SELECT * FROM product_parameter WHERE id_parameter=:id_parameter:");
                    $query->setInteger('id_parameter', $id_parameter);
                    $data_product = $query->getAllRecords();
                    $mass_id_product = $data_product[0]['id_product'];
                    $count=0;
                    foreach ($data_product as $key=>$value)
                    {
                        $count++;
                        if ($count>1)
                            $mass_id_product=$mass_id_product.",".$value['id_product'];
                    }
                    if (!$mass_id_product)
                        $mass_id_product = 0;
                
                    if (!$min_price && !$max_price)
                    {
                        $sql = "SELECT * FROM product WHERE id_categry IN ({$mass}) AND id_product IN ($mass_id_product) AND active=1 ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE id_categry IN ({$mass}) AND id_product IN ($mass_id_product) AND active=1";
                        $href = "/category/{$id_category}/page/";
                    }
                    else
                    {
                        $sql = "SELECT * FROM product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND id_category IN ({$mass}) AND id IN ($mass_id_product) AND active=1 ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND id_category IN ({$mass}) AND id IN ($mass_id_product) AND active=1";
                        $href = "/category/{$id_category}/page/?min_price=".$min_price."&max_price=".$max_price;
                    }
                   
                }
                else
                {
                    if (!$min_price && !$max_price)
                    {
                        $sql = "SELECT * FROM product WHERE active=1 AND id_category IN ({$mass}) ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE active=1 AND id_category IN ({$mass})";
                        $href = "/category/{$id_category}/page/";
                    }
                    else
                    {
                        $sql = "SELECT * FROM product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND active=1 AND id_category IN ({$mass}) ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE (price BETWEEN {$min_price} AND {$max_price}) AND  active=1 AND id_category IN ({$mass})";
                        $href = "/category/{$id_category}/page/?min_price=".$min_price."&max_price=".$max_price;
                    }
                }
                $pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
                $data_product = $pager->getPageData();
                $this->template->assign('pager_string', $pagerString);
                $this->template->assign('data_product', $data_product);
                
                $mass_cookie = array();
                $mass_cookie['id_category'] =$id_category;
                $mass_cookie['id_parameter'] =$id_parameter;
                $expires = time() + 3600*24; //3600*24*365*5
                setcookie("parameters", serialize($mass_cookie), $expires, "/");
                
                
                $form_data_products = $this->template->fetch('rebuild/products.tpl');
                echo json_encode(array('data_ajax_sort_products'=>$form_data_products));
                die();
             
               
	}
	
}
?>