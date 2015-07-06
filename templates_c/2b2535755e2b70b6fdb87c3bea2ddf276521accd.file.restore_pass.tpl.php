<?php /* Smarty version Smarty3-b7, created on 2015-07-02 15:09:24
         compiled from ".\templates\mail/restore_pass.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27966559529f4e01bf0-62196074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b2535755e2b70b6fdb87c3bea2ddf276521accd' => 
    array (
      0 => '.\\templates\\mail/restore_pass.tpl',
      1 => 1434379336,
    ),
  ),
  'nocache_hash' => '27966559529f4e01bf0-62196074',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Здравствуйте!<br/><br/>

Вы успешно прошли процедуру восстановления пароля на сайте <?php echo $_smarty_tpl->getVariable('tdata')->value['servak'];?>
<br/><br/>

Ваш новый пароль: <?php echo $_smarty_tpl->getVariable('tdata')->value['pass_new'];?>
