<?php /* Smarty version Smarty3-b7, created on 2015-07-18 22:24:25
         compiled from "./templates/mail/order_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92308143855aaa7e96e2723-22568299%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3d5f7794394377e3ee2e837aea8a7be19aac903' => 
    array (
      0 => './templates/mail/order_admin.tpl',
      1 => 1437247278,
    ),
  ),
  'nocache_hash' => '92308143855aaa7e96e2723-22568299',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Поступил заказ с сайта<br/><br/>

Логин покупателя: <?php echo $_smarty_tpl->getVariable('tdata')->value['login'];?>
<br/><br />
Имя покупателя: <?php echo $_smarty_tpl->getVariable('tdata')->value['name'];?>
<br/><br />
Контактный телефон: <?php echo $_smarty_tpl->getVariable('tdata')->value['phone'];?>
<br/><br />
Комментарий: <?php echo $_smarty_tpl->getVariable('tdata')->value['text'];?>
<br/><br />
Город: <?php echo $_smarty_tpl->getVariable('tdata')->value['city'];?>
<br/><br />
Товары:<br/>
<?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tdata')->value['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
    Название продукта: <?php echo $_smarty_tpl->getVariable('cur')->value['name_product'];?>
<br/>
    Количество: <?php echo $_smarty_tpl->getVariable('cur')->value['count'];?>
<br/>
    Цена за 1 шт: <?php echo $_smarty_tpl->getVariable('cur')->value['price'];?>
 руб.<br /> <br />
<?php }} ?>
