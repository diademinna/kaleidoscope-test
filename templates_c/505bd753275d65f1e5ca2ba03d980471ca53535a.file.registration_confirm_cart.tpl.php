<?php /* Smarty version Smarty3-b7, created on 2015-07-03 23:05:54
         compiled from ".\templates\mail/registration_confirm_cart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170355596eb222101d7-22724777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '505bd753275d65f1e5ca2ba03d980471ca53535a' => 
    array (
      0 => '.\\templates\\mail/registration_confirm_cart.tpl',
      1 => 1435953723,
    ),
  ),
  'nocache_hash' => '170355596eb222101d7-22724777',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Здравствуйте!<br/><br/>

Вы успешно зарегистрированы на сайте <?php echo $_smarty_tpl->getVariable('tdata')->value['servak'];?>
, Ваш аккаунт создан.<br/><br/>


Ваши данные для авторизации <br/>
<?php if ($_smarty_tpl->getVariable('tdata')->value['login']){?>Логин: <?php echo $_smarty_tpl->getVariable('tdata')->value['login'];?>
<?php }?> <br/>
<?php if ($_smarty_tpl->getVariable('tdata')->value['password']){?>Пароль: <?php echo $_smarty_tpl->getVariable('tdata')->value['password'];?>
<?php }?>