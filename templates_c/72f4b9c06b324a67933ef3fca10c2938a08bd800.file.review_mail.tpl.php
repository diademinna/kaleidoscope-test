<?php /* Smarty version Smarty3-b7, created on 2015-07-15 10:42:21
         compiled from ".\templates\mail/review_mail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2349955a60eddd80875-82162290%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72f4b9c06b324a67933ef3fca10c2938a08bd800' => 
    array (
      0 => '.\\templates\\mail/review_mail.tpl',
      1 => 1436946136,
    ),
  ),
  'nocache_hash' => '2349955a60eddd80875-82162290',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Поступил новый отзыв <br/><br/>

ФИО: <?php echo $_smarty_tpl->getVariable('tdata')->value['fio'];?>
 <br/>
Сообщение: <?php echo $_smarty_tpl->getVariable('tdata')->value['text'];?>
 <br/>
<?php if ($_smarty_tpl->getVariable('tdata')->value['email']){?>E-mail: <?php echo $_smarty_tpl->getVariable('tdata')->value['email'];?>
 <br/><?php }?>