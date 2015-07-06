<?php
class CategoryPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
		$this->registerThis("SetSort");
		$this->processRequest();
	}
	
	
	function doContent(){
		$id_category = $this->request->getValue('id_category');	
		$action = $this->request->getValue('action');
               
                
                $query = $this->conn->newStatement("SELECT name, text FROM category WHERE id=:id:");
                $query->setInteger('id', $id_category);
                $data_category = $query->getFirstRecord();
                $this->template->assign('data_category', $data_category);
                /*Каталог*/
                $query = $this->conn->newStatement("SELECT * FROM category WHERE parent_id=0 AND active=1 ORDER BY pos DESC, id DESC");
                $data_catalog = $query->getAllRecords();			
               
                if ($data_catalog)
                {
                    foreach ($data_catalog as $key=>$value)
                    {
                        $query = $this->conn->newStatement("SELECT * FROM category WHERE parent_id=:parent_id: AND active=1 ORDER BY pos DESC, id DESC");
                        $query->setInteger('parent_id', $value['id']);
                        $data_subcatalog1 = $query->getAllRecords();
                        if ($data_subcatalog1)
                        {
                            $data_catalog[$key]['subcatalog1'] = $data_subcatalog1;
                        }
                    }
                }
                $this->template->assign('data_catalog', $data_catalog);
                // ФОРМИРУЕМ НАВИГАЦИЮ.
		if($id_category){ // выбрана какая-то категория	
                    // достаем все категории
                    $query = $this->conn->newStatement("SELECT * FROM category WHERE active=1 ORDER BY parent_id ASC, pos DESC, id ASC");
                    $data = $query->getAllRecords('id');

                    // ищем для навигации родительские категории
                    $mass_navigation =array();
                    $cur_cat = $id_category; // текущая категория для навигации

                    $mass_navigation[] = $data[$cur_cat];
                    while ($data[$cur_cat]['parent_id'] AND $data[$cur_cat]['parent_id']!="0"){
                            $cur_cat = $data[$cur_cat]['parent_id'];					
                            $mass_navigation[] = $data[$cur_cat];
                    }
                    $mass_navigation = array_reverse($mass_navigation); // сортировка в правильной последовательности
                    $this->template->assign('mass_navigation', $mass_navigation);
		}
                
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
                if (!$id_category)
                {
                    define('COUNT_PAGE', 9);
                    require_once 'module/common/PagerFactory.class.php'; 

                    $pager = new PagerFactory();
                    $page = $this->request->getValue ('page');
                    if(!$page){
                            $page=1;
                    }
                    $this->template->assign('page', $page);
                    if (!$_GET['max_price'])
                    {
                        $sql = "SELECT * FROM product WHERE active=1 ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE active=1";
                        $href = "/category/page/";
                    }
                    else
                    {
                        $sql = "SELECT * FROM product WHERE (price BETWEEN {$_GET['min_price']} AND {$_GET['max_price']}) AND active=1 ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE (price BETWEEN {$_GET['min_price']} AND {$_GET['max_price']}) AND active=1";
                        $href = "/category/page/?min_price=".$_GET['min_price']."&max_price=".$_GET['max_price'];
                        $this->template->assign('cur_min_price', $_GET['min_price']);
                        $this->template->assign('cur_max_price', $_GET['max_price']);
                    }
                    $pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
                    $data_product = $pager->getPageData();
                    $query = $this->conn->newStatement("SELECT price FROM product WHERE active=1");
                    $data_product_all = $query->getAllRecords();
                    $max_price = $data_product_all[0]['price'];
                    foreach ($data_product_all as $key=>$value)
                    {
                        if ($value['price'] > $max_price)
                            $max_price = $value['price']; 
                    }
                    $this->template->assign('max_price', $max_price);
                    $this->template->assign('min_price', 0);
                    $this->template->assign('pager_string', $pagerString);
                }
                else
                {
                    define('COUNT_PAGE', 9);
                    require_once 'module/common/PagerFactory.class.php'; 

                    $pager = new PagerFactory();
                    $page = $this->request->getValue ('page');
                    if(!$page){
                            $page=1;
                    }
                    $this->template->assign('page', $page);
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
                    if (!$_GET["max_price"])
                    {
                        $sql = "SELECT * FROM product WHERE active=1 AND id_category IN ($mass) ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE active=1 AND id_category IN ($mass)";
                        $href = "/category/{$id_category}/page/";
                    }
                    else
                    {
                        $sql = "SELECT * FROM product WHERE (price BETWEEN {$_GET['min_price']} AND {$_GET['max_price']}) AND active=1 AND id_category IN ($mass) ORDER BY {$name_field} {$sort_order}";
                        $fromWhereCnt = "product WHERE (price BETWEEN {$_GET['min_price']} AND {$_GET['max_price']}) AND active=1 AND id_category IN ($mass)";
                        $href = "/category/{$id_category}/page/?min_price=".$_GET['min_price']."&max_price=".$_GET['max_price'];
                        $this->template->assign('cur_min_price', $_GET['min_price']);
                        $this->template->assign('cur_max_price', $_GET['max_price']);
                    
                    }
                    $pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
                    $data_product = $pager->getPageData();
                    $this->template->assign('pager_string', $pagerString);
                    $query = $this->conn->newStatement("SELECT price FROM product WHERE active=1 AND id_category IN ($mass)");
                    $data_product_all = $query->getAllRecords();
                    $max_price = $data_product_all[0]['price'];
                    foreach ($data_product_all as $key=>$value)
                    {
                        if ($value['price'] > $max_price)
                            $max_price = $value['price']; 
                    }
                    $this->template->assign('max_price', $max_price);
                    $this->template->assign('min_price', 0);
                }
                $this->template->assign('val_sort_order', $_COOKIE['polzunok']);
                $this->template->assign('data_product', $data_product);
		$this->template->assign('id_category', $id_category?$id_category:"0");
		$this->setPageTitle("Каталог");
		$this->response->write($this->renderTemplate('category.tpl'));
	}
	
	//*** DEVELOPER AJAX ***//
	function SetSort($action_val) {
		$xajax = new xajaxResponse();
		$expires = time() + 3600*24; //3600*24*365*5
                setcookie("polzunok", $action_val, $expires, "/");
		return $xajax;
	}
	
}
?>