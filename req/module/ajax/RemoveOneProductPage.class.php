<?php
require_once("module/AbstractPageModule.class.php");
require_once('util/MailUtil.class.php');

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class RemoveOneProductPage extends AbstractPageModule {

	function doContent(){
		$id_product = $this->request->getValue('id_product');
                $expires = time() + 3600*24*5; //3600*24*365*5
                $mass = unserialize($_COOKIE['user_cart']);
                foreach ($mass as $key=>$value)
                {
                    if ($value['id_product'] == $id_product )
                    {
                        $mass[$key]['count'] = $mass[$key]['count']-1;
                    }
                }
                setcookie("user_cart", serialize($mass), $expires, "/");
                echo json_encode(array('data_remove_product'=>"ok"));
                die();
	}
	
}
?>