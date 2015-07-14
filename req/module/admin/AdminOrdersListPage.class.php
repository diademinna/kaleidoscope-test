<?php
require_once("module/AbstractPageModule.class.php");

class AdminOrdersListPage extends AbstractPageModule {
	var $conn;

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis('ChangeCountPage');
		$this->processRequest();
                $this->template->assign('unit', "orders");
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
		
		
		$page = $this->request->getValue ('page');
		if(!$page){
			$page=1;
		}
		$this->template->assign('page', $page);
			
		$id = $this->request->getValue('id');
		$action = $this->request->getValue ('action');
		
		if ($action == "delete" && !empty($id))	{
			$query = $conn->newStatement("DELETE FROM user WHERE id=:id:");
                        $query->setInteger('id', $id);
                        $query->execute();
	        
			$this->response->redirect("/admin/user/list/{$page}/{$get_param}");
		}
		else {
                    if($this->request->getValue('count_page')){
                            define('COUNT_PAGE', $this->request->getValue('count_page'));
                    }
                    else{
                            define('COUNT_PAGE', 20);
                    }
                    require_once 'module/common/PagerFactory.class.php';
                    $pager = new PagerFactory();			
                    $sql = "SELECT us.name, us.last_name, us.city, us.address, us.login, us.name_company, ord.* FROM orders ord INNER JOIN user us ON us.id=ord.id_user ORDER BY ord.date DESC";
                    $fromWhereCnt = "orders";
                    $href = "/admin/user/list/".$get_param;

                    $pagerString = $pager->getPagerString($page, $sql, $fromWhereCnt, $href);
                    $data = $pager->getPageData();
                    foreach ($data as $key=>$value)
                    {
                        $query = $conn->newStatement("SELECT ord_pr.*, pr.id_category AS id_category, pr.price AS price_product, pr.ext as img_ext, pr.name AS name_product FROM order_product ord_pr INNER JOIN product pr ON ord_pr.id_product=pr.id WHERE ord_pr.id_order=:id_order:");
                        $query->setInteger('id_order', $value['id']);
                        $data_product = $query->getAllRecords();
                        if ($data_product)
                        {
                            $data[$key]['order_product'] = $data_product;
                            $total_summa = 0;
                            foreach ($data_product as $key2=>$value2)
                            {
                                $total_summa = $total_summa + $value2['price_product']*$value2['count'];
                                
                                $query = $this->conn->newStatement("SELECT act_cat.*, act.date AS date_begin, act.date_end AS date_end, act.id AS id_action, act.text_product AS text_product,  act.name AS name_action FROM actions_category act_cat LEFT JOIN actions act ON act_cat.id_action=act.id WHERE act_cat.id_category=:id_category: AND act.date<now() AND act.date_end>now()");
                                $query->setInteger('id_category', $value2['id_category']);
                                $data_action = $query->getFirstRecord();
                                if ($data_action)
                                {
                                    $data[$key]['order_product'][$key2]['actions'] = 1;
                                    $data[$key]['order_product'][$key2]['name_action'] = $data_action['name_action'];
                                    $data[$key]['order_product'][$key2]['id_action'] = $data_action['id_action'];
                                }
                            }
                            $data[$key]['total_summa'] = $total_summa;
                        }
                    }

                    $this->template->assign('pager_string', $pagerString);
                    $this->template->assign('data', $data);

                    $this->response->write($this->renderTemplate('admin/admin_orders_list.tpl'));
		}
	}
	
	
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");		
		$objResponse->redirect("/admin/orders/list/{$new_get_param}");
		
		return $objResponse;
	}

	
}
?>