<?php /* Smarty version Smarty3-b7, created on 2015-07-09 17:26:12
         compiled from ".\templates\admin/admin_actions_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26415559e84842e55c1-34015011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ea5142c4c56cd128563e62d1ee81ecb350bd1c7' => 
    array (
      0 => '.\\templates\\admin/admin_actions_list.tpl',
      1 => 1436451969,
    ),
  ),
  'nocache_hash' => '26415559e84842e55c1-34015011',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Programms\OpenServer\OpenServer\domains\kaleidoscope-test.ru\req\external\smarty\plugins\modifier.date_format.php';
?><?php ob_start(); ?>
	Акции
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>

<?php ob_start(); ?>

<script type="text/javascript">
    function delRecord(page, id, get_param){
        if(confirm("Вы уверены?")){
            top.window.location = "/admin/actions/list/"+page+"/delete/"+id+"/"+get_param;
        }
    }
</script>
<?php if (!$_smarty_tpl->getVariable('data')->value){?>
    <div class="ibox-content ibox-heading">
        <h3 style="">Еще не добавлено ни одной акции!</h3>
    </div>
    <div class="row" style="margin-top:20px;">
    <div class="col-xs-3">
        <a class="btn btn-block btn-primary compose-mail" href="/admin/actions/add/">
        <i class="fa fa-plus"></i>	Добавить акцию</a>
    </div>
</div>
<?php }else{ ?> 
    <form action="" method="post" id="forma_category" enctype="multipart/form-data">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-xs-3">
                        <a class="btn btn-block btn-primary compose-mail" href="/admin/actions/add/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>">
                        <i class="fa fa-plus"></i> Добавить акцию</a>
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
                                <th>Категории</th>
                                <th>Дата начала</th>
                                <th>Дата окончания</th>
                                <th>На сайте</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</td>
                                    <td>
                                        <?php if ($_smarty_tpl->getVariable('cur')->value['category']){?>
                                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                                <?php echo $_smarty_tpl->getVariable('cur2')->value['name_category'];?>
<br/>
                                            <?php }} ?>
                                        <?php }?>
                                    </td>
                                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date'],"%d.%m.%Y");?>
</td>
                                    <td><?php if (!$_smarty_tpl->getVariable('cur')->value['date_end']){?>не указана<?php }else{ ?><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date_end'],"%d.%m.%Y");?>
<?php }?></td>
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
                                        <a href="/admin/actions/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
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
<?php }?>
<!--
	
	<table class="list" width="100%">
		<tr class="nobgr">
			<td colspan="4">
				Выводить по : <select name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');">
									<?php $_template = new Smarty_Internal_Template("admin/common/select_count_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

							  </select>
				<br /><br />
			</td>
		</tr>
		
		<tr class="nobgr">
			<td colspan="3"></td>
			<td><a class="add" href="/admin/actions/add/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>">Добавить</a></td>
		</tr>
		
		<tr class="sh">
			<td>Название</td>
			<td>Дата</td>
			<td>Показывать<br />на сайте</td>
			<td width="80" class="center">Действие</td>
		</tr>
		
		<?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['loop']['iteration']++;
?>
			<tr <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['loop']['iteration']%2==0){?>class="chet"<?php }?>>
				<td><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</td>
				<td><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('cur')->value['date'],"%d.%m.%Y");?>
</td>
				<td width="10%"><input type="checkbox" name="my_checkbox" value="<?php echo $_smarty_tpl->getVariable('cur')->value['active'];?>
" <?php if ($_smarty_tpl->getVariable('cur')->value['active']==1){?>checked<?php }?> onclick="xajax_Activate('<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
')" /></td>
				
				<td class="center">
					<a href="/admin/actions_photo/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a> 
					&nbsp;
					<a href="/admin/actions/add/<?php echo $_smarty_tpl->getVariable('page')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
					<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('page')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
', '<?php echo $_smarty_tpl->getVariable('get_param')->value;?>
');" onmouseover="this.style.cursor='pointer';"/>
				</td>
			</tr>
		<?php }} ?>
		
		<tr class="nobgr">
			<td colspan="3"></td>
			<td><a class="add" href="/admin/actions/add/<?php if ($_smarty_tpl->getVariable('get_param')->value){?><?php echo $_smarty_tpl->getVariable('get_param')->value;?>
<?php }?>">Добавить</a></td>
		</tr>
				
		<tr class="nobgr">
			<td colspan="4"><?php if ($_smarty_tpl->getVariable('pager_string')->value){?><div class="pager">Страницы: <?php echo $_smarty_tpl->getVariable('pager_string')->value;?>
</div><?php }?></td>
		</tr>
		
	</table> -->
	
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
