<?php /* Smarty version Smarty3-b7, created on 2015-06-16 15:27:32
         compiled from ".\templates\common/errors_block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7540558016343c4533-27370227%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ff45ae003f8ad0283ca945445ece7ed5f0779a9' => 
    array (
      0 => '.\\templates\\common/errors_block.tpl',
      1 => 1434457647,
    ),
  ),
  'nocache_hash' => '7540558016343c4533-27370227',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('errors')->value)&&count($_smarty_tpl->getVariable('errors')->value)>0){?>
	<div class="errors_block" style="color:#d70000;">
		<ul>
			<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
?>
				<li style="background:none; list-style-type:disc;"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</li>
			<?php }} ?>
		</ul>
	</div>
<?php }?>
