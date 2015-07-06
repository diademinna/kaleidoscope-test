<?php /* Smarty version Smarty3-b7, created on 2015-07-06 23:01:04
         compiled from ".\templates\admin/admin_product_param_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26214559ade8068bdc0-87846522%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e629ae61ae510b90fe0fee10c40a0880a676334' => 
    array (
      0 => '.\\templates\\admin/admin_product_param_list.tpl',
      1 => 1436212863,
    ),
  ),
  'nocache_hash' => '26214559ade8068bdc0-87846522',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Параметры
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

    <script type="text/javascript">
        function delRecord(id_product_param, id){
                if(confirm("Вы уверены?")) {
                        top.window.location = "/admin/product_param/list/"+id_product_param+"/delete/"+id+"/";
                }
        }
    </script>

    <?php if ($_smarty_tpl->getVariable('data_product_param')->value){?>

        <form action="" method="post" id="forma_product_param" enctype="multipart/form-data">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-xs-3">
                            <a class="btn btn-block btn-primary compose-mail" href="/admin/product_param/add/<?php echo $_smarty_tpl->getVariable('id_product_param')->value;?>
/">
                            <i class="fa fa-plus"></i> Добавить <?php if ($_smarty_tpl->getVariable('level')->value){?> параметр <?php }else{ ?>группу параметров<?php }?></a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product_param')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                <tr id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
                                    <td>
                                        <?php if (!$_smarty_tpl->getVariable('level')->value){?>
                                        <a href="/admin/product_param/list/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/" title="Перейти в этот раздел"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                                        <?php }else{ ?>
                                            <?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>

                                        <?php }?>
                                    </td>
                                    <td style="font-size:18px;">
                                        <a href="/admin/product_param/add/<?php echo $_smarty_tpl->getVariable('id_product_param')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/">
                                            <i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                            <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('id_product_param')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
');" onmouseover="this.style.cursor='pointer';"></i>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    <?php }elseif(!$_smarty_tpl->getVariable('data_product_param')->value){?>
        <?php if ($_smarty_tpl->getVariable('id_product_param')->value==0){?>
            <div class="ibox-content ibox-heading">
                <h3 style="">Не добавлено ни одной группы параметров!</h3>
            </div>
        <?php }?>
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/product_param/add/<?php echo $_smarty_tpl->getVariable('id_product_param')->value;?>
/">
                <?php if ($_smarty_tpl->getVariable('level')->value){?>
                    <i class="fa fa-plus"></i>	Добавить параметр
                <?php }else{ ?>
                    <i class="fa fa-plus"></i>	Добавить группу параметров
                <?php }?>
                </a>
            </div>
        </div>
    <?php }?>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

