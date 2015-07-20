<?php
require_once("module/AbstractPageModule.class.php");
require_once('util/MailUtil.class.php');

// Это фактически код из BlogPage 
// Вызываем после добавления комента
class AddOrderPage extends AbstractPageModule {

	
	
	function doContent(){
		$name = $this->request->getValue('name');
		$last_name = $this->request->getValue('last_name');
		$email = $this->request->getValue('email');
		$login = $this->request->getValue('login');
		$phone = $this->request->getValue('phone');
		$text = $this->request->getValue('text');
		$city = $this->request->getValue('city');
		 setcookie("user_cart", "", time()-3600, "/");
                $mass_user_cart = unserialize($_COOKIE['user_cart']);
                if ($login)
                {
                    $query = $this->conn->newStatement("SELECT * FROM user WHERE login=:login:");
                    $query->setVarchar("login", $login);
                    $data_user = $query->getFirstRecord();
                    
                    $query = $this->conn->newStatement("INSERT INTO orders SET login=:login:, phone=:phone:, date=NOW(), text=:text:, id_user=:id_user:");
                    $query->setVarchar("login", $login);
                    $query->setVarchar("phone", $phone);
                    $query->setText("text", $text);
                    $query->setInteger("id_user", $data_user['id']);
                    $query->execute();

                    $insertId = $query->getInsertId();
                    foreach ($mass_user_cart as $key=>$value)
                    {
                        $query = $this->conn->newStatement("INSERT INTO order_product SET id_order=:id_order:, id_product=:id_product:, count=:count:");
                        $query->setVarchar("id_order", $insertId);
                        $query->setVarchar("id_product", $value['id_product']);
                        $query->setVarchar("count", $value['count']);
                        $query->execute();
                    }
                }
                else
                {
                    /*генерация пароля*/
                    $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";// Символы, которые будут использоваться в пароле.
                    $max=10; // Количество символов в пароле.
                    $size=StrLen($chars)-1; // Определяем количество символов в $chars
                    $password=null; // Определяем пустую переменную, в которую и будем записывать символы.
                    while($max--) // Создаём пароль. 
                        $password.=$chars[rand(0,$size)]; 
                     /*-генерация пароля-*/
                    $query = $this->conn->newStatement("INSERT INTO user SET name=:name:, last_name=:last_name:, email=:email:, phone=:phone:, login=:login:, password=:password:, date=now(), activate=:activate:");
                    $query->setVarchar("name", $name);
                    $query->setVarchar("last_name", $last_name);
                    $query->setVarchar("login", $email);
                    $query->setVarchar("email", $email);
                    $query->setVarchar("phone", $phone);
                    $query->setVarchar("password", md5($password) );
                    $query->setInteger("activate", 1);
                    $query->setVarChar("city", $city);
                    $query->execute();
                    
                    $insertId = $query->getInsertId();
        
                    $form = array();
                    $form['login'] = $email;
                    $form['password'] = $password;
                    $form['servak'] = $_SERVER['HTTP_HOST'];
                    $mail = new MailUtil();
                    $mail->setTo($email);
                    $mail->setSubject('Вы зарегистрированы на сайте '.$_SERVER['HTTP_HOST']);
                    $mail->setFrom("{$_SERVER['HTTP_HOST']} <" . ADMIN_EMAIL . ">");
                    $tdata = $form;
                    $mail->setEmailTextTemplate('mail/registration_confirm_cart.tpl', $tdata);
                    $mail->doSend();
                    
                    
                    
                    $query = $this->conn->newStatement("INSERT INTO orders SET login=:login:, phone=:phone:, date=NOW(), text=:text:, id_user=:id_user:");
                    $query->setVarchar("login", $email);
                    $query->setVarchar("phone", $phone);
                    $query->setText("text", $text);
                    $query->setInteger("id_user", $insertId);
                    $query->execute();

                    $insertIdOrder = $query->getInsertId();
                    foreach ($mass_user_cart as $key=>$value)
                    {
                        $query = $this->conn->newStatement("INSERT INTO order_product SET id_order=:id_order:, id_product=:id_product:, count=:count:");
                        $query->setVarchar("id_order", $insertIdOrder);
                        $query->setVarchar("id_product", $value['id_product']);
                        $query->setVarchar("count", $value['count']);
                        $query->execute();
                    }
                }
                foreach ($mass_user_cart as $key=>$value )
                {
                    $query = $this->conn->newStatement('SELECT * FROM product_info WHERE id_product=:id_product:');
                    $query->setInteger('id_product', $value['id_product']);
                    $data = $query->getFirstRecord();
                    $query = $this->conn->newStatement('UPDATE product_info SET buys=:buys: WHERE id_product=:id_product:');
                    if ($data['buys'])
                    {           
                        $query->setInteger('buys',$data['buys'] + 1);
                    }
                    else {
                        $query->setInteger('buys', 1);
                    }
                    $query->setInteger('id_product', $value['id_product']);
                    $query->execute();
                    
                    $query = $this->conn->newStatement('SELECT name, price FROM product WHERE id=:id:');
                    $query->setInteger('id', $value['id_product']);
                    $data_name_product = $query->getFirstRecord();
                    $mass_user_cart[$key]['name_product'] = $data_name_product['name'];
                    $mass_user_cart[$key]['price'] = $data_name_product['price'];
                    
                }
                $form = array();
                $form['login'] = $login;
                $form['password'] = $password;
                $form['servak'] = $_SERVER['HTTP_HOST'];
                $form['products'] = $mass_user_cart;
                $form['text'] = $text;
                $form['phone'] = $phone;
                $form['city'] = $city;
                if ($login)
                {
                    $form['name'] = $data_user['name']."  ".$data_user['last_name'];
                }
                else
                {
                    $form['name'] = $name."  ".$last_name;
                }
                $mail = new MailUtil();
                $mail->setTo(ADMIN_EMAIL);
                $mail->setSubject('Заказ с сайта');
                $mail->setFrom("{$_SERVER['HTTP_HOST']} <" . ADMIN_EMAIL . ">");
                $tdata = $form;
                $mail->setEmailTextTemplate('mail/order_admin.tpl', $tdata);
                $mail->doSend();

               
                
                
                
                
                
                echo json_encode(array('data_reg_user'=>$str_id_product));
                die();
	}
	
}
?>