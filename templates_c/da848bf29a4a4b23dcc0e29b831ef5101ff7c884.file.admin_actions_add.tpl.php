<?php /* Smarty version Smarty3-b7, created on 2015-07-09 17:38:08
         compiled from ".\templates\admin/admin_actions_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17909559e87502fc9d6-41954774%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da848bf29a4a4b23dcc0e29b831ef5101ff7c884' => 
    array (
      0 => '.\\templates\\admin/admin_actions_add.tpl',
      1 => 1436452685,
    ),
  ),
  'nocache_hash' => '17909559e87502fc9d6-41954774',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php ob_start(); ?>
	Акции / <?php if ($_smarty_tpl->getVariable('data')->value['name']){?>Редактировать - <?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
<?php }else{ ?>Добавить<?php }?>
<?php  $_smarty_tpl->smarty->_smarty_vars['capture']["content_name"]=ob_get_clean();?>


<?php ob_start(); ?>

	
	<script type="text/javascript">	
		jQuery(function($){
			$.datepicker.regional['ru'] = {
				closeText: 'Закрыть',
				prevText: '',
				nextText: '',
				currentText: 'Сегодня',
				monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
				'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
				monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
				'Июл','Авг','Сен','Окт','Ноя','Дек'],
				dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
				dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
				dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
				dateFormat: 'yy-mm-dd', firstDay: 1,
				isRTL: false};
			$.datepicker.setDefaults($.datepicker.regional['ru']);
		}); 
	
		$(document).ready(function(){
			$('#date').datepicker({dateFormat:'dd-mm-yy', changeMonth:true, changeYear:true });//, yearRange: "1950:2020"
			$('#date_end').datepicker({dateFormat:'dd-mm-yy', changeMonth:true, changeYear:true });//, yearRange: "1950:2020"
		});
	</script>
	
<div class="ibox-title">
    <h5>Форма для добавления / редактирования акции</h5>
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
        <div class="form-group">
            <label class="col-sm-2 control-label">Дата начала :</label>
            <div class="col-sm-10">
                <input name="date" id="date" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['date'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Дата окончания :</label>
            <div class="col-sm-10">
                <input name="date_end" id="date_end" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['date_end'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Категория товаров:</label>
            <div class="col-sm-10">
                <select name="id_category[]" multiple="multiple" size="8"> 
                    <option value="0">--- Выберите ---</option>
                    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
?>
                        <option <?php ob_start();?><?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('data_select_category')->value[$_tmp1]){?> selected="selected"<?php }?> style="font-weight: 700;" value="<?php echo $_smarty_tpl->getVariable('cur')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur')->value['name'];?>
</option>
                        <?php if ($_smarty_tpl->getVariable('cur')->value['child']){?>
                            <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cur')->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
?>
                                <option <?php ob_start();?><?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_smarty_tpl->getVariable('data_select_category')->value[$_tmp2]){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('cur2')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('cur2')->value['name'];?>
</option>
                            <?php }} ?>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Текст для страницы товара :</label>
            <div class="col-sm-10">
                <textarea name="text_product" class="tiny"><?php echo $_smarty_tpl->getVariable('data')->value['text_product'];?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Анонс :</label>
            <div class="col-sm-10">
                <textarea name="anons" class="tiny"><?php echo $_smarty_tpl->getVariable('data')->value['anons'];?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Контент :</label>
            <div class="col-sm-10">
                <textarea name="text" class="tiny"><?php echo $_smarty_tpl->getVariable('data')->value['text'];?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Изображение (превью): <br /> 280 х 170 - гориз. <br /> 100 х 170 - верт.</label>
            <div class="col-sm-10">
                <input  type="file" name="image" />
                <br /><br />
                <div id="photo">
                    <?php if ($_smarty_tpl->getVariable('data')->value['ext']){?>
                        <a href="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
_sm.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/actions/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
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

<!--

	<form action="" method="post" enctype="multipart/form-data">
	
		<?php $_template = new Smarty_Internal_Template("common/errors_block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

	
		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name"><?php echo $_smarty_tpl->getVariable('data')->value['name'];?>
</textarea></td>
			</tr>
			
			<tr>
				<td>Дата:</td>
				<td><input type="text" name="date" id="date" value="<?php echo $_smarty_tpl->getVariable('data')->value['date'];?>
" class="sm" /></td>
			</tr>
			
			<tr>
				<td>Анонс:</td>
				<td>(если анонс новости <b>не указан</b> новость выводиться <b>полностью</b> )<br /><textarea name="anons" class="tiny"><?php echo $_smarty_tpl->getVariable('data')->value['anons'];?>
</textarea></td>
			</tr>
			
			<tr>
				<td>Контент:</td>
				<td><textarea name="text" class="tiny"><?php echo $_smarty_tpl->getVariable('data')->value['text'];?>
</textarea></td>
			</tr>
			
			<tr>
				<td>Изображение:</td>
				<td>
				
					<input type="file" name="image"/>
					
					<select name="type_resize">
						<option value="1">Обрезать края</option>
						<option value="2">Добавлять пустые поля</option>
					</select>
					
					<br /><br />
					<div id="photo">
						<?php if ($_smarty_tpl->getVariable('data')->value['ext']){?>
							<a href="/uploaded/news/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/news/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
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
				<td>Тайтл:</td>
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
