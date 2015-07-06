<?php /* Smarty version Smarty3-b7, created on 2015-07-05 18:07:09
         compiled from ".\templates\admin/admin_user_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95715599481d35dd03-72781640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'debe94f55f790fba616dd5dc987c94df2fa61dee' => 
    array (
      0 => '.\\templates\\admin/admin_user_list.tpl',
      1 => 1436108821,
    ),
  ),
  'nocache_hash' => '95715599481d35dd03-72781640',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
?><?php ob_start(); ?>
	Покупатели
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>
	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/user/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
                $(document).ready(function(){
                    $('.fa.fa-info').click(function(){
                        var pr = $(this).parent().parent().next().css('display');
                        if (pr == 'none')
                            $(this).parent().parent().next().show();
                        else
                            $(this).parent().parent().next().hide();
                    });
                });
	</script>
<?php if (!$_smarty_tpl->getVariable('data')->value){?>
    <div class="ibox-content ibox-heading">
            <h3 style="">Еще не зарегистрировано ни одного покупателя!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    
</div>
<?php }else{ ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="row">
                
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
                            <th>E-mail</th>
                            <th>ФИО</th>
                            <th>Дата регистрации</th>
                            <th>Город</th>
                            <th>Телефон</th>
                            <th>Активность</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['email'];?>
</td>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
 <?php echo $_smarty_tpl->getVariable('cur')->value['last_name'];?>
</td>
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date'],"%d-%m-%Y");?>
</td>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['city'];?>
</td>
                            <td><?php echo $_smarty_tpl->getVariable('cur')->value['phone'];?>
</td>
                            <td><?php if ($_smarty_tpl->getVariable('cur')->value['activate']==1){?>ДА<?php }else{ ?>нет<?php }?></td>
                            <td style="font-size:18px;">
                                
                                <i style="cursor: pointer;" title="Полная информация" alt="Полная информация" class="fa fa-info"></i>
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('page')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
', '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');" onmouseover="this.style.cursor='pointer';"></i></td>
                        </tr>
                        <tr class="more_info" style="display: none;">
                            <td>
                                <table style="border-collapse: separate;border-spacing: 15px 5px;">
                                    <tr>
                                        <td>Имя : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Фамилия : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['last_name'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Название компании : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['name_company'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Логин : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['login'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['email'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Телефон : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['phone'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Город : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['city'];?>
</td>
                                    </tr>
                                    <tr>
                                        <td>Адрес : </td>
                                        <td><?php echo $_smarty_tpl->getVariable('cur')->value['address'];?>
</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php }} ?>
                </table>
            </div> 
        </div>
        <?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager"><?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?> 
    </div>
<?php }?>
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
