<?php /* Smarty version Smarty3-b7, created on 2015-07-14 16:19:30
         compiled from ".\templates\admin/admin_contacts_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1219555a50c62c061c3-67581209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e19d00aa103f4d6dd3a30ca7cf42343e3497fe8' => 
    array (
      0 => '.\\templates\\admin/admin_contacts_list.tpl',
      1 => 1436879969,
    ),
  ),
  'nocache_hash' => '1219555a50c62c061c3-67581209',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Контакты
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/contacts/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
	</script>
<?php if (!$_smarty_tpl->getVariable('data')->value){?>
<div class="ibox-content ibox-heading">
    <h3 style="">Еще не добавлено ни одного контакта!</h3>
</div>
<div class="row" style="margin-top:20px;">
    <div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/contacts/add/">
    <i class="fa fa-plus"></i>	Добавить контакт</a>
</div>
</div>
<?php }else{ ?> 
     <form action="" method="post" id="forma_category" enctype="multipart/form-data">
         <div class="ibox float-e-margins">
             
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
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->getVariable('cur')->value['name_place'];?>
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
                                        <a href="/admin/contacts/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                       
                                    </td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
    </form>
<?php }?>

<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
