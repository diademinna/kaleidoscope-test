<?php
class ProductPage extends AbstractPageModule {
	
	function doBeforeOutput(){
		$this->doInit();
	}
		
	function doContent(){			
		$id_product = $this->request->getValue('id_product');
		$this->template->assign('id_product', $id_product);
		
		// достаем ТОВАР
		$query = $this->conn->newStatement("SELECT * FROM product WHERE id=:id_product:");
		$query->setInteger('id_product', $id_product);
		$data_product = $query->getFirstRecord();
                
                $query = $this->conn->newStatement("SELECT cat.name, param.name AS name_filtr FROM category cat LEFT JOIN parameter param ON cat.id_parameter=param.id WHERE cat.id=:id:");
		$query->setInteger('id', $data_product['id_category']);
		$data_name_filtr = $query->getFirstRecord();
                
                ///значения фильтра
                $query = $this->conn->newStatement("SELECT pr_param.*, param.name AS name_parameter, param.ext AS ext FROM product_parameter pr_param LEFT JOIN parameter param ON pr_param.id_parameter=param.id WHERE pr_param.id_product=:id_product:");
		$query->setInteger('id_product', $id_product);
		$data_filtr = $query->getAllRecords();
                if ($data_filtr)
                {
                    $data_product['filtr'] = $data_filtr;
                }
                $data_product['name_filtr'] = $data_name_filtr;
		$this->template->assign('data_product', $data_product);
                
                
                
                 ///определение ip-адреса пользователя
                if (!empty($_SERVER['HTTP_CLIENT_IP']))
                {
                  $ip=$_SERVER['HTTP_CLIENT_IP'];
                }
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //переменная окружения
                {
                  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else
                {
                  $ip=$_SERVER['REMOTE_ADDR'];///IP-адрес, с которого пользователь просматривает текущую страницу. 
                }
              
                $query = $this->conn->newStatement('SELECT * FROM product_info WHERE id_product=:id_product:');
                $query->setInteger('id_product', $id_product);
                $data = $query->getFirstRecord();
                $query = $this->conn->newStatement('UPDATE product_info SET views=:views: WHERE id_product=:id_product:');
                if ($data['views']){                
                    $query->setInteger('views',$data['views'] + 1);
                }
                else {
                    $query->setInteger('views', 1);
                }
                $query->setInteger('id_product', $id_product);
                $query->execute();
             
                
               
		
		// достаем галерею категории
		$query = $this->conn->newStatement("SELECT * FROM product_photo WHERE id_product=:id_product: ORDER BY pos DESC, id DESC");
		$query->setInteger('id_product', $id_product);
		$data_product_photo = $query->getAllRecords();
		$this->template->assign('data_product_photo', $data_product_photo);
		
		
		$id_category = $data_product['id_category'];		
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
	
		$this->setPageTitle("".($data_product['title']?$data_product['title']:$data_product['name'])."");
		
		$this->response->write($this->renderTemplate('product.tpl'));
	}
	
	//*** DEVELOPER AJAX ***//
	
}
?>