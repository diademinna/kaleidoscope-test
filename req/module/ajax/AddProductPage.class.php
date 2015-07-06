<?php
require_once("module/AbstractPageModule.class.php");
require_once('util/MailUtil.class.php');

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class AddProductPage extends AbstractPageModule {

	
	
	function doContent(){
		$id_product = $this->request->getValue('id_product');
                $expires = time() + 3600*24*5; //3600*24*365*5
                if (isset($_COOKIE['user_cart']))
                {
                    $mass = unserialize($_COOKIE['user_cart']);
                    $find = 0;
                    foreach ($mass as $key=>$value)
                    {
                        if ($value['id_product'] == $id_product)
                        {
                            $mass[$key]['count'] = $mass[$key]['count']+1;
                            $find = 1;
                        }
                    }
                    if ($find == 0)
                    {
                        $new_mass = array();
                        $new_mass['id_product'] = $id_product;
                        $new_mass['count'] = 1;
                        $mass[]=$new_mass;
                    }
                    setcookie("user_cart", serialize($mass), $expires, "/");
                }
                else
                {
                    $mass = array();
                    $mass[0]['id_product'] = $id_product;
                    $mass[0]['count'] = 1;
                    setcookie("user_cart", serialize($mass), $expires, "/");
                }
                echo json_encode(array('data_add_product'=>"ok"));
                die();
	}
	
}
?>