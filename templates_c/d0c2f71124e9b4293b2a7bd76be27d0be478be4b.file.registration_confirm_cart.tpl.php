<?php /* Smarty version Smarty3-b7, created on 2015-07-18 22:24:25
         compiled from "./templates/mail/registration_confirm_cart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179922706155aaa7e96267a0-99330150%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0c2f71124e9b4293b2a7bd76be27d0be478be4b' => 
    array (
      0 => './templates/mail/registration_confirm_cart.tpl',
      1 => 1437229355,
    ),
  ),
  'nocache_hash' => '179922706155aaa7e96267a0-99330150',
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