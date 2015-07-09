<?php /* Smarty version Smarty3-b7, created on 2015-07-09 17:45:46
         compiled from ".\templates\actions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24076559e891a199e45-63521700%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36e1d490666718ea50534afdc30a4bc923e5e7e5' => 
    array (
      0 => '.\\templates\\actions.tpl',
      1 => 1436453144,
    ),
  ),
  'nocache_hash' => '24076559e891a199e45-63521700',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
?><?php ob_start(); ?>
    <?php if ($_smarty_tpl->getVariable('data_actions')->value){?> 
        <div class="container-login">
            <div class="navigation">
                <a href="/"><i class="fa fa-home"></i></a>
                <i class="fa fa-chevron-right"></i>Акции
            </div>
            
            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_actions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                ffdss
            <?php }} ?>
            <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager_string"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>
            
        </div>
		
		
	<?php }else{ ?> 

		<h1><?php echo $_smarty_tpl->getVariable('data_item')->value['name'];?>
</h1>
		
		<?php if ($_smarty_tpl->getVariable('data_item')->value){?>
			<div class="actions_one">
				<div class="date">Дата: <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('data_item')->value['date'],"%d.%m.%Y");?>
</div>
				<?php if ($_smarty_tpl->getVariable('data_item')->value['ext']){?>
					<div class="img"><a onclick="return hs.expand(this, config1)" href="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('data_item')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('data_item')->value['ext'];?>
" align="left"><img src="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('data_item')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data_item')->value['ext'];?>
" /></a></div>
				<?php }?>
				<div class="text user_content"><?php echo $_smarty_tpl->getVariable('data_item')->value['text'];?>
</div>
			</div>
			<div class="clear"></div>
		<?php }?>	
		
		
		
		
	<?php }?>
		
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
