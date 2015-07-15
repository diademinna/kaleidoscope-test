<?php /* Smarty version Smarty3-b7, created on 2015-07-14 19:11:12
         compiled from ".\templates\admin/admin_review_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1425255a534a0e7bfe3-89878002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f6a0309b4492fd38974e99e10b25f63db60874f' => 
    array (
      0 => '.\\templates\\admin/admin_review_add.tpl',
      1 => 1436890271,
    ),
  ),
  'nocache_hash' => '1425255a534a0e7bfe3-89878002',
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
            <label class="col-sm-2 control-label">ФИО* :</label>
            <div class="col-sm-10">
                <input name="fio" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['fio'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail :</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['email'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Дата :</label>
            <div class="col-sm-10">
                <input name="date" id="date" class="form-control" type="text" value="<?php echo $_smarty_tpl->getVariable('data')->value['date'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Отзыв :</label>
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
                        <a href="/uploaded/review/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
.<?php echo $_smarty_tpl->getVariable('data')->value['ext'];?>
" target="_blank"><img src="/uploaded/review/<?php echo $_smarty_tpl->getVariable('data')->value['id'];?>
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
