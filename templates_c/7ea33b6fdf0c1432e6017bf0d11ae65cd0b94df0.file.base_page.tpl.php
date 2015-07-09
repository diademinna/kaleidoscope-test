<?php /* Smarty version Smarty3-b7, created on 2015-07-09 17:21:36
         compiled from ".\templates\common/base_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19726559e8370a4cd59-59670357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ea33b6fdf0c1432e6017bf0d11ae65cd0b94df0' => 
    array (
      0 => '.\\templates\\common/base_page.tpl',
      1 => 1436451693,
    ),
  ),
  'nocache_hash' => '19726559e8370a4cd59-59670357',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cost')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.cost.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php if ($_smarty_tpl->getVariable('page_title')->value){?><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
<?php }else{ ?> Калейдоскоп<?php }?></title>
        <link href="/js/ui/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/> 
	<link href="/css/common.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>

	<script type="text/javascript" src="/js/highslide/highslide-full.packed.js"></script>
	<script type="text/javascript" src="/js/highslide/highslide.config.js" charset="utf-8"></script>
     
        <link type="text/css" href="/css/admin/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="/js/highslide/highslide.css" />
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <!---fancybox-->
        <script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" />

	<script type="text/javascript">
		if (navigator.userAgent.indexOf ("MSIE 6") != -1 || navigator.userAgent.indexOf ("MSIE 7") != -1  || navigator.userAgent.indexOf ("MSIE 8") != -1 ){
	        window.location.href = "/index_ie/";
		}
	</script>

	<?php if ($_smarty_tpl->getVariable('ajaxCode')->value){?><?php echo $_smarty_tpl->getVariable('ajaxCode')->value;?>
<?php }?>
</head>

<body>
    <script>
    $(document).ready(function(){
        $('#close_user_cart').click(function(){
            $('#info_about_cart').hide();
        });
        
        $('.button-in-cart.product').click(function(){
            var id = ($(this).attr('id')); 
            id_product = parseInt(id.replace("product_", ""));
           
             $.ajax({
                type: "POST",
                dataType: "json",
                url: "/add_product/",
                async: false,
                data:{
                    id_product: id_product,
                    count: 1
                },
                success: function(data){
                }
             });
            $('#info_about_cart').show();
            location.reload();
            
        });
        $('.header-cart-product__remove').click(function(e){
            var id = ($(this).parent().attr('id')); 
            id_product = parseInt(id.replace("item_product_in_cart_", ""));
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/remove_product/",
                async: false,
                data:{
                    id_product: id_product
                },
                success: function(data){
                }
            });
            e.stopPropagation();
            //значения количества товаров и цены в выпадашке наверху
            var count_header = parseInt($('#total_count-cart-header').text());
            var price_header = parseInt($('#total_price-cart-header').text().replace(" ", ""));
            
            var price_product = parseInt($(this).parent().find('span.price').text().replace(" ", ""));//цена за 1 товар в позиции
            var count_product = parseInt($(this).parent().find('span.count').text()); //количество товара в позиции
            $('#total_count-cart-header').text(count_header-count_product);
            var price = parseInt(price_header-price_product*count_product);
            price = String(price);
            price = price.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
            $('#total_price-cart-header').text(price);
            $('#total_price-container_cart').text(price+'руб.');
            $(this).parent().remove();
            if (count_header == 1)
            {
                $('.header-cart__container').html('Ваша корзина пуста!');
            }
            
            
            //console.log(price_header);
            
             //новые значения
        /*  var price_add = $(this).parent().find('.container-product__price').text();
            console.log(price_add);
            price_add = price_add.replace("руб.", ""),
            price_add = parseInt(price_add.replace(" ", "")),
            
            new_price = 0;
            new_count = 0;
            new_price = price_header - price_add;
            new_count = count_header - 1;
            $('#total_price-cart-header').text(new_price);
            $('#total_count-cart-header').text(new_count);
            
            //location.reload();*/
        });
        
    });
</script>
    <div class="wraper">
        <header>
            <div class="header-topbar">
                <div class="container">
                    <div id="info_about_cart" style="position: fixed; top:0; right:0; background-color: #ffffff; padding:25px 20px;border: 1px solid #e9e8dd; display: none; z-index:25; text-align: center;">
                        Товар добавлен в корзину
                        <br /><br />
                        <div class="header-cart-actions__button">
                            <span id='close_user_cart' class="header-cart-actions__button__link" style="cursor: pointer;">Продолжить</span>
                        </div>
                        <div class="header-cart-actions__button">
                            <a class="header-cart-actions__button__link" href="/cart/">В корзину</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <ul class="header-action">
                        <li class="header-action__item">
                            <?php if (!$_smarty_tpl->getVariable('user')->value){?>
                                <a class="header-action__link" href="/login/">Войти</a>
                            <?php }else{ ?>
                                Добро пожаловать, <?php echo $_smarty_tpl->getVariable('user')->value['name'];?>

                            <?php }?>
                        </li>
                        <?php if ($_smarty_tpl->getVariable('user')->value){?>
                            <li class="header-action__item"><a class="header-action__link" href="/user/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
/">Редактировать профиль</a></li>
                            <li class="header-action__item"><a class="header-action__link" href="/change_password/">Сменить пароль</a></li>
                            <li class="header-action__item"><a class="header-action__link" href="/logout/">Выйти</a></li>
                        <?php }else{ ?>
                            <li class="header-action__item"><a class="header-action__link" href="/registration/">Регистрация</a></li>
                        <?php }?>
                    </ul>
                    <div class="header-cart">
                    <div class="header-cart__heading" data-toggle="dropdown" >
                        <i class="icon-basket"></i>
                        <span id="header-cart_top"> Моя корзина: <span id="total_count-cart-header"><?php if ($_smarty_tpl->getVariable('cart')->value){?><?php echo count($_smarty_tpl->getVariable('cart')->value);?>
<?php }else{ ?>0<?php }?></span> продукта (-ов) - <span id="total_price-cart-header"><?php if ($_smarty_tpl->getVariable('cart')->value){?><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('total_price')->value);?>
<?php }else{ ?>0<?php }?></span> руб.</span>
                        <i class="icon-down-open"></i>
                    </div>
                    <div class="header-cart__content">
                        <div class="header-cart__container"> 
                            
                            <?php if ($_smarty_tpl->getVariable('cart')->value){?>
                            Добавленные товары
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cart')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                            <div class="header-cart-product" id="item_product_in_cart_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
                              <div class="header-cart-product__remove"><i style="cursor: pointer; font-size: 18px;" class="fa fa-times" title="Убрать из корзины"></i></div>
                              <div class="header-cart-product__img"><a href="#"><img width="50px" src="/uploaded/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
" /></a></div>
                              <div class="header-cart-product-description">
                                <div class="header-cart-product-description__name"><a href="/product/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a></div>
                              <div class="header-cart-product-description__params">
                                  - розовый <br />
                                  - дорогая упаковка
                                </div>
                                <div class="header-cart-product-description__count">
                                  x <span class="count"><?php echo $_smarty_tpl->getVariable('cur')->value['count'];?>
</span> <span class="price"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['price']);?>
 руб.</span>
                                </div>
                              </div>
                              <div class="clear"></div>
                            </div>
                            <?php }} ?>
                             
                            <div class="header-cart-total">
                                <table class="header-cart-total__item">
                                  <tr>
                                    <td class="name">Общая стоимость:</td>
                                    <td><span id="total_price-container_cart"><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('total_price')->value);?>
 руб.</span></td>
                                  </tr>
                                </table>
                            </div>
                            <div class="clear"></div>
                            <div class="header-cart-actions">
                              <div class="header-cart-actions__button"><a class="header-cart-actions__button__link" href="/cart/">Обзор корзины</a></div>
                              <div class="header-cart-actions__button"><a class="header-cart-actions__button__link" href="#">Оформить заказ</a></div>
                            </div>
                            <?php }else{ ?>
                                Ваша корзина пуста!
                            <?php }?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="header__logo">
              <a href="/"><img src="/img/logo.png" alt="Калейдоскоп"  title="Калейдоскоп"/></a>
            </div>
            <div class="header-contacts">
              <div class="header-contacts__item">Адрес: <span>г. Пенза, 1-й Онежский проезд, д.6</span></div>
              <div class="header-contacts__item">Телефон: <span>8 935 455 25 26</span></div>
            </div>
            <div class="header-search">
              <form>
                <button class="header-search__button"><i class="icon-search"></i></button>
                <input class="header-search__input" type="text" name="seach_phrase" placeholder="Поиск...">
              </form>
            </div>
            <div class="clear"></div>
        </div>
        <div class="container">
            <ul class="header-menu">
                <li class="header-menu__item catalog">
                    <a class="header-menu_link" href="/category/">Каталог <!--<i class="icon-down-open"></i>--></a>
                        <!--<ul class="header_catalog_category">
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                <li class="header_catalog__main_category">
                                <a class="header-catalog_name_link" href="#"><div style="background: url('/uploaded/category/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
_icon.<?php echo $_smarty_tpl->getVariable('cur')->value['ext'];?>
') no-repeat transparent 0 0;" class="header-catalog_name"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</div></a>
                                <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                                <ul class="header-subcategory">
                                    <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                    <li class="header-subcategory__item"><a class="header-subcategory__link" href="#"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</a></li>
                                    <?php }} ?>
                                </ul>
                                <?php }?>
                            </li>
                            <?php }} ?>
                        </ul>-->
                </li>
                <li class="header-menu__item"><a class="header-menu_link" href="/actions/">Акции</a></li>
                <li class="header-menu__item"><a class="header-menu_link" href="#">Доставка</a></li>
                <li class="header-menu__item"><a class="header-menu_link" href="#">Способы оплаты</a></li>
                <li class="header-menu__item"><a class="header-menu_link" href="#">Контакты</a></li>
                <li class="header-menu__item"><a class="header-menu_link" href="#">Отзывы</a></li>
                <div class="clear"></div>
            </ul>
        </div>
    </header>
</div>






	<!--  ЛОГИНИЗАЦИЯ -->
	<!--<div class="login_block">
		<?php if (!$_smarty_tpl->getVariable('user')->value){?>
			<div id="login_block_enter">
				<form enctype="multipart/form-data" method="post" action="/login/">
					<img alt="ВХОД" src="/img/blank.gif" id="login_enter">
						<div class="otstup">
							<div class="input_bgr"><input type="text" value="Логин" onblur="if(this.value==''){this.value='Логин'}" onfocus="if(this.value=='Логин'){this.value=''}" name="login"></div>
							<div class="input_bgr" style="margin-top: 6px;float:left;margin-right: 5px;"><input type="password" value="Пароль" onblur="if(this.value==''){this.value='Пароль'}" onfocus="if(this.value=='Пароль'){this.value=''}" name="password" class="bgr_input"></div>
							<div class="login_enter" style="margin-top: 7px;"><input type="image" src="/img/login_enter.png"></div>
						</div>
						<div class="clear"></div>

							<div class="login_remember"><input type="checkbox" name="remember" id="remember" checked> <label for="remember">Запомнить меня</label></div>
							<div class="login_links"><a href="/registration/">Регистрация</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/restore_password/">Забыли пароль?</a> </div>
						<input type="hidden" name="submitted" value="1" />
				</form>
			</div>
		<?php }else{ ?>
			<div id="login_block_exit">
				<img alt="ВЫХОД" src="/img/blank.gif" id="login_exit">

				<div class="login_user">
						<div style="float:left;"><img src="<?php if ($_smarty_tpl->getVariable('user')->value['avatar']){?>/uploaded/user/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('user')->value['avatar'];?>
<?php }else{ ?>/img/no_avatar.png<?php }?>" /></div>

					<div class="name">
						<?php if ($_smarty_tpl->getVariable('user')->value['avatar']){?><a href="/user_info/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
/"><img align="left" src="/uploaded/user/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('user')->value['avatar'];?>
" style="border:1px solid #A0A0AF;" /></a><?php }else{ ?><a href="/user_info/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
/"><img align="left" src="/img/no_avatar.jpg" /></a><?php }?>
						Добро пожаловать,
						<a href="/user_info/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
/"><strong><?php echo $_smarty_tpl->getVariable('user')->value['login'];?>
</strong></a>
					</div>
					<div class="logout"><a title="Выйти" href="/logout/">Выйти</a> <a class="kabinet" href="/user_info/<?php echo $_smarty_tpl->getVariable('user')->value['id'];?>
/">Личный кабинет</a></div>

				</div>
			</div>
		<?php }?>
	</div>-->




<div class="container">
	<?php echo $_smarty_tpl->smarty->_smarty_vars['capture']['content'];?>

</div>
<footer>
  <div class="footer-bgr_white">
    <div class="container">
    <div class="footer-logo"><a href="/"><img src="/img/logo.png" alt="Калейдоскоп" title="Калейдоскоп" /></a></div>
    <ul class="footer-container-menu">
      <li class="footer-menu">
        <div class="footer-menu__name">Информация</div>
        <ul class="footer-submenu">
          <li class="footer-submenu__item"><a class="footer-submenu__link" href="#">Доставка</a></li>
          <li class="footer-submenu__item"><a class="footer-submenu__link" href="#">Защита покупателя</a></li>
          <li class="footer-submenu__item"><a class="footer-submenu__link" href="#">Способы оплаты</a></li>
        </ul>
      </li>
      <li class="footer-menu">
        <div class="footer-menu__name">Покупателям</div>
        <ul class="footer-submenu">
          <li class="footer-submenu__item"><a class="footer-submenu__link" href="#">Акции</a></li>
        </ul>
      </li>
      <li class="footer-menu">
        <div class="footer-menu__name">Контакты</div>
        <ul class="footer-submenu">
          <li class="footer-submenu__item"><a class="footer-submenu__link" href="mailto:email@yandex.ru">email@yandex.ru</a></li>
          <li class="footer-submenu__item">8 (800) 100-20-30</li>
          <li class="footer-submenu__item">8 (800) 100-20-30</li>
        </ul>
      </li>
      <li class="footer-menu">
        <div class="footer-menu__name">Наши адреса</div>
        <ul class="footer-submenu">
          <li class="footer-submenu__item">г. Пенза, 1-й Онежский проезд, д.6</li>
          <li class="footer-submenu__item">г. Пенза, 1-й Онежский проезд, д.6</li>
        </ul>
      </li>
    </ul>
    <div class="clear"></div>
    </div>
  </div>
  <div class="footer-bottom bgr-dark_red ">Интернет-магазин "Калейдоскоп"  © 2015<?php $_smarty_tpl->assign("footer_cur_year",smarty_modifier_date_format(time(),"%Y"),null,null);?><?php if ($_smarty_tpl->getVariable('footer_cur_year')->value!='2015'){?>-<?php echo $_smarty_tpl->getVariable('footer_cur_year')->value;?>
<?php }?> </div>
</footer>


</body>
</html>
