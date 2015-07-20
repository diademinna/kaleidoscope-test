<?php /* Smarty version Smarty3-b7, created on 2015-07-17 12:04:32
         compiled from ".\templates\admin/admin_main_category_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:620355815e923841c3-82618409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b704f3095e25536174bf9cc089fb9b22b2f53be6' => 
    array (
      0 => '.\\templates\\admin/admin_main_category_list.tpl',
      1 => 1436257098,
    ),
  ),
  'nocache_hash' => '620355815e923841c3-82618409',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Разделы на главной
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>


<?php ob_start(); ?>
<div class="ibox-title">
	<h5>Укажите категории на главной странице</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal">
        <?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        <div class="form-group">
            <label class="col-sm-2 control-label">1 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat1">
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['main']=="1"){?>
                            <option selected="selected" style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }else{ ?>
                            <option style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <?php if ($_smarty_tpl->getVariable('cur2')->value['main']=="1"){?>
                                    <option selected="selected" value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }?>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">2 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat2">
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['main']=="2"){?>
                            <option selected="selected" style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }else{ ?>
                            <option style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <?php if ($_smarty_tpl->getVariable('cur2')->value['main']=="2"){?>
                                    <option selected="selected" value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }?>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">3 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat3">
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['main']=="3"){?>
                            <option selected="selected" style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }else{ ?>
                            <option style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <?php if ($_smarty_tpl->getVariable('cur2')->value['main']=="3"){?>
                                    <option selected="selected" value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }?>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">4 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat4">
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['main']=="4"){?>
                            <option selected="selected" style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }else{ ?>
                            <option style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <?php if ($_smarty_tpl->getVariable('cur2')->value['main']=="4"){?>
                                    <option selected="selected" value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }?>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">5 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat5">
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['main']=="5"){?>
                            <option selected="selected" style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }else{ ?>
                            <option style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <?php if ($_smarty_tpl->getVariable('cur2')->value['main']=="5"){?>
                                    <option selected="selected" value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }?>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">6 категория* :</label>
            <div class="col-sm-10">
                <select class="form-control m-b" name="cat6">
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['main']=="6"){?>
                            <option selected="selected" style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }else{ ?>
                            <option style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['subcategory']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['subcategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <?php if ($_smarty_tpl->getVariable('cur2')->value['main']=="6"){?>
                                    <option selected="selected" value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }else{ ?>
                                    <option value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                                <?php }?>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <input type="hidden" name="submitted" value="1" />
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
</div>

	<!--<form action="" method="post" enctype="multipart/form-data">

		<?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name"><?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
</textarea></td>
			</tr>

			<tr>
				<td>Контент	<br />(если необходим):</td>
				<td><textarea name="text" class="tiny"><?php echo $_smarty_tpl->getVariable('data')->value['text'];?>
</textarea></td>
			</tr>

			<tr>
				<td>Изображение (превью)<br />(если необходимо):</td>
				<td>
					<input type="file" name="image" />
					<select name="type_resize">
						<option value="1">Обрезать края</option>
						<option value="2">Добавлять пустые поля</option>
					</select>

					<br /><br />
					<div id="photo">
						<?php if ($_smarty_tpl->getVariable('data')->value['ext']){?>
							<a href="/uploaded/category/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/category/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" class="photo" /></a>
							&nbsp;<a href="" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
'); return false;"><img src="/img/admin/del.png" title="Удалить фото" alt="Удалить фото"></a>
							<input type="hidden" name="ext" value="<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" />
						<?php }?>
					</div>
				</td>
			</tr>

			<tr>
				<td>Тайтл <br />(если необходим):</td>
				<td><textarea name="title"><?php echo $_smarty_tpl->getVariable('data')->value['title'];?>
</textarea></td>
			</tr>

			<tr>
				<td></td>
				<td>
					<input type="hidden" name="submitted" value="1" />
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
-->
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content"]=ob_get_clean();?>

<?php $_template = new Smarty_Internal_Template("admin/common/base_page.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

