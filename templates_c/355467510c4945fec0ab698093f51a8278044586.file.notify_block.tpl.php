<?php /* Smarty version Smarty3-b7, created on 2015-07-15 10:42:24
         compiled from ".\templates\common/notify_block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:810455a60ee05dc0e1-83785482%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '355467510c4945fec0ab698093f51a8278044586' => 
    array (
      0 => '.\\templates\\common/notify_block.tpl',
      1 => 1436257098,
    ),
  ),
  'nocache_hash' => '810455a60ee05dc0e1-83785482',
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