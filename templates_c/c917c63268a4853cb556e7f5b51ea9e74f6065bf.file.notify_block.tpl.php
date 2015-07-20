<?php /* Smarty version Smarty3-b7, created on 2015-07-18 22:35:44
         compiled from "./templates/common/notify_block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153097026155aaaa90599610-76502373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c917c63268a4853cb556e7f5b51ea9e74f6065bf' => 
    array (
      0 => './templates/common/notify_block.tpl',
      1 => 1437229354,
    ),
  ),
  'nocache_hash' => '153097026155aaaa90599610-76502373',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('notes')->value)&&count($_smarty_tpl->getVariable('notes')->value)>0){?>
	<br />
	<div class="notify">
		<ul>
			<?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('notes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value){
?>
			  <li><b><?php echo $_smarty_tpl->getVariable('note')->value;?>
</b></li>
			<?php }} ?>
		</ul>
	</div>
<?php }?>