<?php /* Smarty version Smarty3-b7, created on 2015-06-15 22:28:12
         compiled from ".\templates\admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21483557f274cc57672-02414042%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a9885c5bcda6f411b3ce3673ac269dc6071d4ba' => 
    array (
      0 => '.\\templates\\admin/index.tpl',
      1 => 1434379334,
    ),
  ),
  'nocache_hash' => '21483557f274cc57672-02414042',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	&nbsp;
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>
	<br />Добро пожаловать в админку сайта!<br /><br /><br />
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
