<?php /* Smarty version Smarty3-b7, created on 2015-07-15 16:15:05
         compiled from ".\templates\admin/admin_portfolio_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2258655a65cd9bc69c8-01189874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '017441f22fc3b83a4f0aca447775d7ccfdfd70d4' => 
    array (
      0 => '.\\templates\\admin/admin_portfolio_list.tpl',
      1 => 1436966098,
    ),
  ),
  'nocache_hash' => '2258655a65cd9bc69c8-01189874',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
?><?php ob_start(); ?>
	Портфолио
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

    <script type="text/javascript">
        function delRecord(page, id, get_param){
            if(confirm("Вы уверены?")) {
                top.window.location = "/admin/portfolio/list/"+page+"/delete/"+id+"/"+get_param;
            }
        }
        $(function() {			
            $( "#sortable" ).sortable({
                    opacity: 0.8,
                    revert: true,
                    axis:'y'
            });
        });		
        $(document).ready(function() { 
            $("#sortable").sortable({
                    update : function () { 
                        var mass_sort = $('#sortable').sortable('toArray');
                        xajax_Sort(mass_sort, $('#min_pos').val()); 
                    }
            });
        });
    </script>
    <?php if ($_smarty_tpl->getVariable('data')->value){?>
<form action="" method="post" id="forma_category" enctype="multipart/form-data">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="row">
                <div class="col-xs-3">
                    <a class="btn btn-block btn-primary compose-mail" href="/admin/portfolio/add/">
                    <i class="fa fa-plus"></i> Добавить</a>
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
                            <th>Дата</th>
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
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date'],"%d.%m.%Y");?>
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
                                    <a href="/admin/portfolio_photo/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a> &nbsp &nbsp
                                    <a href="/admin/portfolio/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
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
    </div>
</form>
            

    <?php }else{ ?>
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/portfolio/add/">
                <i class="fa fa-plus"></i>	Добавить</a>
            </div>
        </div>

    <?php }?>

	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
