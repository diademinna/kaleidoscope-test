<?php /* Smarty version Smarty3-b7, created on 2015-07-18 22:35:44
         compiled from "./templates/mail/review_mail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1782096555aaaa902ee090-23037056%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48b9ddc37410757ea6e4ae117ba2eff58ff1c8a8' => 
    array (
      0 => './templates/mail/review_mail.tpl',
      1 => 1437229355,
    ),
  ),
  'nocache_hash' => '1782096555aaaa902ee090-23037056',
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