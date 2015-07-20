<?php /* Smarty version Smarty3-b7, created on 2015-07-18 21:01:37
         compiled from "./templates/mail/registration_confirm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139692600455aa9481066225-44896399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e220093f796a24c7ec6ce59d4b16029e45d4cdc' => 
    array (
      0 => './templates/mail/registration_confirm.tpl',
      1 => 1437229355,
    ),
  ),
  'nocache_hash' => '139692600455aa9481066225-44896399',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Здравствуйте!<br/><br/>

Вы успешно зарегистрированы на сайте <?php echo $_smarty_tpl->getVariable('tdata')->value['servak'];?>
, Ваш аккаунт создан.<br/><br/>

Для активации Вашего аккаунта, пожалуйста, перейдите по данному адресу http://<?php echo $_smarty_tpl->getVariable('tdata')->value['servak'];?>
/activate/?checkSum=<?php echo $_smarty_tpl->getVariable('tdata')->value['checkSum'];?>
&id=<?php echo $_smarty_tpl->getVariable('tdata')->value['id'];?>
<br/>
Ссылка для активации вашего аккаунта будет доступна в течение трех суток.<br/><br/>

Ваши данные для авторизации <br/>
<?php if ($_smarty_tpl->getVariable('tdata')->value['login']){?>Логин: <?php echo $_smarty_tpl->getVariable('tdata')->value['login'];?>
<?php }?> <br/>
<?php if ($_smarty_tpl->getVariable('tdata')->value['password']){?>Пароль: <?php echo $_smarty_tpl->getVariable('tdata')->value['password'];?>
<?php }?>