<?php /* Smarty version Smarty3-b7, created on 2015-06-25 15:41:05
         compiled from ".\templates\mail/registration_confirm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24874558bf6e141a946-53139363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15cb74308a1b80ecea1c64b2e15e9c1164275e26' => 
    array (
      0 => '.\\templates\\mail/registration_confirm.tpl',
      1 => 1435235702,
    ),
  ),
  'nocache_hash' => '24874558bf6e141a946-53139363',
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