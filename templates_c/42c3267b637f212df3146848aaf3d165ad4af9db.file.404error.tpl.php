<?php /* Smarty version Smarty3-b7, created on 2015-07-18 17:23:39
         compiled from "./templates/common/404error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62831343755aa616b24fcd9-78248808%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42c3267b637f212df3146848aaf3d165ad4af9db' => 
    array (
      0 => './templates/common/404error.tpl',
      1 => 1437229354,
    ),
  ),
  'nocache_hash' => '62831343755aa616b24fcd9-78248808',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	<?php $_smarty_tpl->assign("page_title","Ошибка 404. Error 404.",null,null);?>
	<h1>Данной страницы не существует</h1>
	<p>Нам очень жаль, но данная страница не активна или находится в разработке, нажмите кнопку "назад" окна вашего браузера</p><p>Попробуйте перейти по данной ссылке позже.</p>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
