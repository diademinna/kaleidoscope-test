<?php /* Smarty version Smarty3-b7, created on 2015-06-25 16:03:21
         compiled from ".\templates\user/success_registration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7532558bfc19865eb3-08957287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36e146e9d11594dd9e7387f75651aafc04205c8a' => 
    array (
      0 => '.\\templates\\user/success_registration.tpl',
      1 => 1435237399,
    ),
  ),
  'nocache_hash' => '7532558bfc19865eb3-08957287',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>

    <div class="container-login" style="text-align: center;">
	<h1>Регистрация прошла успешно</h1><br />
	
	<div style="text-align:center; font-size: 18px; margin:50px 0 90px 0; line-height: 26px;">
	    <p>Поздравляем Вас с успешной регистрацией на нашем сайте.<br />				
	    На вашу электронную почту было отправлено письмо для подтверждения регистрации.</p>
	</div>
	
    </div>

	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
