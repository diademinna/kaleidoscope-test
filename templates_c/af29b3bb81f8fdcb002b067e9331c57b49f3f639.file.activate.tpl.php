<?php /* Smarty version Smarty3-b7, created on 2015-07-18 21:05:00
         compiled from "./templates/user/activate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70863166655aa954c61e171-52122542%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af29b3bb81f8fdcb002b067e9331c57b49f3f639' => 
    array (
      0 => './templates/user/activate.tpl',
      1 => 1437229355,
    ),
  ),
  'nocache_hash' => '70863166655aa954c61e171-52122542',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>

	<h1>Активация аккаунта</h1>
		
	<br />	
	<b><?php echo $_smarty_tpl->getVariable('result')->value;?>
</b>
	<br />
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
