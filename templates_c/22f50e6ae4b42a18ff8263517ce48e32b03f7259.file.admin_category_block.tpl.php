<?php /* Smarty version Smarty3-b7, created on 2015-07-02 11:50:11
         compiled from ".\templates\admin/admin_category_block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:279895594fb4369cbb2-61288792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22f50e6ae4b42a18ff8263517ce48e32b03f7259' => 
    array (
      0 => '.\\templates\\admin/admin_category_block.tpl',
      1 => 1435827008,
    ),
  ),
  'nocache_hash' => '279895594fb4369cbb2-61288792',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="" method="post" id="forma_category" enctype="multipart/form-data">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <div class="row">
            <div class="col-xs-3">
                <a class="btn btn-block btn-primary compose-mail" href="/admin/category/add/<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
/">
                <i class="fa fa-plus"></i> Добавить категорию</a>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Название</th>
                        <th>На сайте</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                    <tr id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
                        <td>
                            <div class="checkbox choose">
                                <input id="male1<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" type="checkbox" name="checkbox_choose[<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
]" value="1">
                                <label for="male1<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" class="label_checkbox"></label>
                            </div>
                        </td>
                        <td>
                            <?php if (!$_smarty_tpl->getVariable('level')->value){?>
                            <a href="/admin/category/list/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/" title="Перейти в этот раздел"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a>
                            <?php }else{ ?>
                                <?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>

                            <?php }?>
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
                            <a href="/admin/category/add/<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/">
                                <i class="fa fa-pencil" title="Редактировать" alt="Редактировать"></i></a> &nbsp &nbsp
                                <i class="fa fa-times" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
');" onmouseover="this.style.cursor='pointer';"></i>
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
           <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Дополнительный функционал</th>
                    </tr>
                    <tr class="nobgr">
                        <td>
                            Перенести выбранные категории в &nbsp;
                            <select style="width:300px;" class="form-control m-b-xs" name="select_category">
                                    <option value="">...выберите...</option>
                                    <option value="0">Корневой уровень каталога</option>
                                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category_all')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                                            <option value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                                    <?php }} ?>
                            </select>
                            &nbsp;
                            <a style="width:300px;" class="btn btn-block btn-info" href="#" onclick="if(confirm('Перенести выбранные категории. Вы уверены?')) xajax_ChangeCategory(xajax.getFormValues('forma_category')); return false;">выполнить</a>

                        </td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</form>



<!--<form action="" method="post" id="forma_category" enctype="multipart/form-data">
<table class="list" width="100%">
	<tr class="nobgr">
		<td colspan="2" class="zag">КАТЕГОРИИ</td>
	</tr>

	<tr class="nobgr">
		<td></td>
		<td style="text-align:right;"><a class="add" href="/admin/category/add/<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
/">Добавить</a></td>
	</tr>

	<tr class="nobgr">
		<td colspan="2">
			<div class="sort_zag">
				<ul>
					<li>
						<div style="width:3%;" class="sh"><div class="padd"></div></div>
						<div style="width:67%;" class="sh"><div class="padd">Название</div></div>
						<div style="width:15%;" class="sh"><div class="padd">На сайте</div></div>
						<div style="width:15%;" class="sh"><div class="padd">Действие</div></div>
						<div class="clean"></div>
					</li>
				</ul>
			</div>
		</td>
	</tr>

	<tr class="nobgr">
		<td colspan="2">

			<div class="sort_list">

				<ul id="sortable"  class="sort">
					<?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
						<li id="item_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
">
							<div style="width:3%;"><div class="padd choose"><input type="checkbox" name="checkbox_choose[<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
]" value="1"></div></div>
							<div style="width:67%;"><div class="padd"><a href="/admin/category/list/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/" title="Перейти в этот раздел"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</a></div></div>

							<div style="width:15%;"><div class="padd">
								<input type="checkbox" name="my_checkbox" value="<?php echo $_smarty_tpl->getVariable('cur')->value['active'];?>
" <?php if ($_smarty_tpl->getVariable('cur')->value['active']==1){?>checked<?php }?> onclick="xajax_Activate('<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
')" />
							</div></div>


							<div style="width:15%;"><div class="padd">
								<a href="/admin/category/add/<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
/edit/<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
/"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>&nbsp;&nbsp;
								<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
', '<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
');" onmouseover="this.style.cursor='pointer';"/>
							</div></div>

							<div class="clean"></div>
							<?php $_smarty_tpl->assign("min_pos",$_smarty_tpl->getVariable('cur')->value['pos'],null,null);?>
						</li>
					<?php }} ?>
				</ul>
				<input type="hidden" id="min_pos" value="<?php echo $_smarty_tpl->getVariable('min_pos')->value;?>
">  
			</div>

		</td>
	</tr>

	<tr class="nobgr">
		<td></td>
		<td style="text-align:right;"><a class="add" href="/admin/category/add/<?php echo $_smarty_tpl->getVariable('id_category')->value;?>
/">Добавить</a></td>
	</tr>


	

</table>
</form>->
