<?php /* Smarty version Smarty3-b7, created on 2015-07-06 17:07:44
         compiled from ".\templates\admin/admin_product_block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32343559a8bb01c1227-19792143%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2df700d28d3e9217bbd2445d364b0effc0cbc3f' => 
    array (
      0 => '.\\templates\\admin/admin_product_block.tpl',
      1 => 1436111233,
    ),
  ),
  'nocache_hash' => '32343559a8bb01c1227-19792143',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_cost')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.cost.php';
?><?php ob_start(); ?>
	Список продуктов 
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>
<script type="text/javascript">
    function delRecord(page, id, get_param){
            if(confirm("Вы уверены?")){
                    top.window.location = "/admin/product/list/"+page+"/delete/"+id+"/"+get_param;
            }
    }
</script>
<?php if (!$_smarty_tpl->getVariable('data_product')->value){?>
    <div class="ibox-content ibox-heading">
            <h3 style="">Еще не добавлено ни одного продукта!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    <div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/product/add/">
        <i class="fa fa-plus"></i>	Добавить продукт</a>
    </div>
</div>
<?php }else{ ?>  
<form action="" method="post" id="forma_category" enctype="multipart/form-data">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="row">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/product/add/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>">
                <i class="fa fa-plus"></i> Добавить продукт</a>
            </div>
            <div class="col-xs-2">
                Выводить по :
            </div>    
            <div class="col-xs-3">
                 
                <select class="form-control m-b" name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');">
                    <?php $_template = new Smarty_Internal_Template("admin/common/select_count_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

                </select>	
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Артикул</th>
                        <th>Цена</th>
                        <th>Старая цена</th>
                        <th>На сайте</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                    <tr id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
                        
                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</td>
                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['code'];?>
</td>
                        <td><?php if (smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['price'])){?><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['price']);?>
<?php }else{ ?>не указана<?php }?></td>
                        <td><?php if (smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['old_price'])){?><?php echo smarty_modifier_cost($_smarty_tpl->getVariable('cur')->value['old_price']);?>
<?php }else{ ?>не указана<?php }?></td>
                        <td>
                            <div class="checkbox">
                                <input id="male<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" type="checkbox" name="my_checkbox" value="<?php echo $_smarty_tpl->getVariable('cur')->value['active'];?>
" <?php if ($_smarty_tpl->getVariable('cur')->value['active']==1){?>checked<?php }?> onclick="xajax_Activate('<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
')">
                                <label class="label_checkbox" for="male<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"></label>
                            </div>
                        </td>
                        <td style="font-size:18px;">
                            <a href="/admin/product/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>">
                                <a href="/admin/product_photo/add/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a>&nbsp;&nbsp;
                                 <a href="/admin/product/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('page')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
', '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');" onmouseover="this.style.cursor='pointer';"></i>
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



