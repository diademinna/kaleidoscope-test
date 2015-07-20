<?php /* Smarty version Smarty3-b7, created on 2015-07-17 12:27:10
         compiled from ".\templates\admin/admin_services_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3131455a8ca6e7b0ac2-50773315%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9dcbf2fb305a0d19fb793d8fe74f3ab49fbef972' => 
    array (
      0 => '.\\templates\\admin/admin_services_list.tpl',
      1 => 1437125227,
    ),
  ),
  'nocache_hash' => '3131455a8ca6e7b0ac2-50773315',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Услуги
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

<script type="text/javascript">
    function delRecord(page, id, get_param){
        if(confirm("Вы уверены?")){
            top.window.location = "/admin/services/list/"+page+"/delete/"+id+"/"+get_param;
        }
    }
    
    $(function(){
            $("#sortable").sortable({
                    opacity:0.8, revert:true, axis:'y'
            });
            $("#sortable_product").sortable({
                    opacity:0.8, revert:true, axis:'y'
            });
    });
    $(document).ready(function(){
            $("#sortable").sortable({
                      update : function(){
                            var mass_sort = $('#sortable').sortable('toArray');
                            xajax_Sort(mass_sort, $('#min_pos').val());
                      }
            });
            $("#sortable_product").sortable({
                      update : function(){
                            var mass_sort = $('#sortable_product').sortable('toArray');
                            xajax_SortProduct(mass_sort, $('#min_pos_product').val());
                      }
            });
    });
</script>
<?php if (!$_smarty_tpl->getVariable('data')->value){?>
    <div class="ibox-content ibox-heading">
        <h3 style="">Еще не добавлено ни одной услуги!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    <div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/services/add/">
        <i class="fa fa-plus"></i>	Добавить услугу</a>
    </div>
</div>
<?php }else{ ?> 
    <form action="" method="post" id="forma_category" enctype="multipart/form-data">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-xs-3">
                        <a class="btn btn-block btn-primary compose-mail" href="/admin/services/add/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>">
                        <i class="fa fa-plus"></i> Добавить услугу</a>
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
                                <th>На сайте</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                 <tr id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
                                    <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</td>
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
                                        <a href="/admin/services/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
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
