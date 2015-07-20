<?php /* Smarty version Smarty3-b7, created on 2015-07-18 22:37:33
         compiled from "./templates/mail/service.tpl" */ ?>
<?php /*%%SmartyHeaderCode:43787704355aaaafd2e5677-31111545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffdddd0dfa3bef44b78cfa6c56a6026596f06373' => 
    array (
      0 => './templates/mail/service.tpl',
      1 => 1437229355,
    ),
  ),
  'nocache_hash' => '43787704355aaaafd2e5677-31111545',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
Поступила заявка на услугу<br/><br/>

Название услуги: <b><?php echo $_smarty_tpl->getVariable('tdata')->value['name_service'];?>
</b><br /><br />
ФИО покупателя: <?php echo $_smarty_tpl->getVariable('tdata')->value['fio'];?>
<br/>
E-mail: <?php echo $_smarty_tpl->getVariable('tdata')->value['email'];?>
<br/>
Контактный телефон: <?php echo $_smarty_tpl->getVariable('tdata')->value['phone'];?>
<br/>
Комментарий: <?php echo $_smarty_tpl->getVariable('tdata')->value['text'];?>

