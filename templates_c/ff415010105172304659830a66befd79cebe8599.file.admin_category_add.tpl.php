<?php /* Smarty version Smarty3-b7, created on 2015-07-07 12:34:24
         compiled from ".\templates\admin/admin_category_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12701559af12ba0bc88-20938952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff415010105172304659830a66befd79cebe8599' => 
    array (
      0 => '.\\templates\\admin/admin_category_add.tpl',
      1 => 1436257098,
    ),
  ),
  'nocache_hash' => '12701559af12ba0bc88-20938952',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Каталог / <?php if ($_smarty_tpl->getVariable('data')->value['name']){?>Редактировать - <?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
<?php }else{ ?>Добавить категорию<?php }?>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>


<?php ob_start(); ?>
<div class="ibox-title">
	<h5>Форма для добавления категории</h5>
</div>
<div class="ibox-content">
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

		<div class="form-group">
			<label class="col-sm-2 control-label">Название* :</label>
			<div class="col-sm-10">
				<input name="name" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
" />
			</div>
		</div>
                <?php if ($_smarty_tpl->getVariable('data_product_param')->value){?>
		<div class="form-group">
                    <label class="col-sm-2 control-label">Параметры для товара* :</label>
                    <div class="col-sm-10">
                         <input id="optionsRadios_0" type="radio" name="id_group_param" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" <?php if ($_smarty_tpl->getVariable('data')->value['id_group_param']==0){?> checked=""<?php }?>> Не указывать<br />
                        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_product_param')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                            <input id="optionsRadios_<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" type="radio" name="id_group_param" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
" <?php if ($_smarty_tpl->getVariable('cur')->value['id']==$_smarty_tpl->getVariable('data')->value['id_group_param']){?> checked=""<?php }?>> <?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
<br />
                        <?php }} ?>
                    </div>
		</div>
                <?php }?>
		<div class="form-group">
			<label class="col-sm-2 control-label">Контент <br />(если необходим):</label>
			<div class="col-sm-10">
				<textarea name="text" class="tiny" type="text"><?php echo $_smarty_tpl->getVariable('data')->value['text'];?>
</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Изображение (превью):</label>
			<div class="col-sm-10">
				<input  type="file" name="image" />

				<br /><br />
				<div id="photo">
					<?php if ($_smarty_tpl->getVariable('data')->value['ext']){?>
						<a href="/uploaded/category/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/category/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" class="photo" /></a>
						&nbsp;<i onmouseover="this.style.cursor='pointer';" class="fa fa-times" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
'); return false;"></i>
						<input type="hidden" name="ext" value="<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" />
					<?php }?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Тайтл:</label>
			<div class="col-sm-10">
				<input name="title" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['title'];?>
" />
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

