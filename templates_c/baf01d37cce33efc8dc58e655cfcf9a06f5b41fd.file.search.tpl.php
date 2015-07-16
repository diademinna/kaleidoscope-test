<?php /* Smarty version Smarty3-b7, created on 2015-07-15 23:01:38
         compiled from ".\templates\search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:629855a6bc222c73a3-79025710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baf01d37cce33efc8dc58e655cfcf9a06f5b41fd' => 
    array (
      0 => '.\\templates\\search.tpl',
      1 => 1436990496,
    ),
  ),
  'nocache_hash' => '629855a6bc222c73a3-79025710',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
    <div class="container-login">
        <div class="navigation">
            <a href="/"><i class="fa fa-home"></i></a>
            <i class="fa fa-chevron-right"></i>Страница поиска
        </div>
        <br />
        <div class='find-word__stroka'>Вы искали: <span class='find-word'><?php echo $_GET['submitted'];?>
</span></div>


	<?php if ($_smarty_tpl->getVariable('error')->value){?>
		<?php echo $_smarty_tpl->getVariable('error')->value;?>

	<?php }else{ ?>
        <?php if ($_smarty_tpl->getVariable('result')->value){?>
            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('result')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                <div class='search-item'>
                    <div class='search-item__name'><a href="<?php echo $_smarty_tpl->getVariable('cur')->value['route'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['result_name'];?>
</a></div>
                <?php echo $_smarty_tpl->getVariable('cur')->value['result_text'];?>

                </div>
            <?php }} ?>
        <?php }else{ ?>
                Ничего не найдено <br />
        <?php }?>

	<?php }?>
    </div>	
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
