<?php
class AdminPopularProductListPage extends AbstractPageModule {

	function doBeforeOutput(){
		$this->Authenticate();
		
		$this->registerThis("ChangeCountPage", "Activate");
		$this->processRequest();
                $this->template->assign('unit', "popular_product");
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
		
		$id = $this->request->getValue('id');
		$action = $this->request->getValue ('action');
			
               

                
                $query = $this->conn->newStatement("SELECT pr.*, pr_info.views AS views FROM product pr LEFT JOIN product_info pr_info ON pr.id=pr_info.id_product WHERE pr_info.views!=0 ORDER BY pr_info.views DESC");
                $data = $query->getAllRecords();

                $this->template->assign('data', $data);

                $this->response->write($this->renderTemplate('admin/admin_popular_product_list.tpl'));
	    
	}
	
	//*** DEVELOPER AJAX ***//
	
	// Функция вызывается при смене количества отображаемых элементов на странице
	function ChangeCountPage($val, $get_param){
		$objResponse = new xajaxResponse();
		
		$new_get_param = $this->ParamGET($val, $get_param, "count_page");
		$objResponse->redirect("/admin/product/list/{$new_get_param}");
		
		return $objResponse;
	}
	
	// Отображать или скрыть выбранный элемент.
	
	
}
?>