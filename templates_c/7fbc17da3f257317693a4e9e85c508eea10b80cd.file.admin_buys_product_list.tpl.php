<?php /* Smarty version Smarty3-b7, created on 2015-07-18 00:07:00
         compiled from ".\templates\admin/admin_buys_product_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:566355a96e74512b28-89772540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fbc17da3f257317693a4e9e85c508eea10b80cd' => 
    array (
      0 => '.\\templates\\admin/admin_buys_product_list.tpl',
      1 => 1437167147,
    ),
  ),
  'nocache_hash' => '566355a96e74512b28-89772540',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Часто покупаемые товары
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

<?php if (!$_smarty_tpl->getVariable('data')->value){?>
   товаров нет
<?php }else{ ?> 
    <form action="" method="post" id="forma_category" enctype="multipart/form-data">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Кол-во покупок</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getVariable('cur')->value['buys'];?>
</td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?>  
        </div>
    </form>
<?php }?>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
