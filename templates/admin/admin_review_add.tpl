{capture name="content_name"}
	Акции / {if $data.name}Редактировать - {$data.name}{else}Добавить{/if}
{/capture}


{capture name="content"}

	{literal}
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
	{/literal}
<div class="ibox-title">
    <h5>Форма для добавления / редактирования акции</h5>
</div>
<div class="ibox-content">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {include file="common/errors_block.tpl"}
        <div class="form-group">
            <label class="col-sm-2 control-label">ФИО* :</label>
            <div class="col-sm-10">
                <input name="fio" class="form-control" type="text" value="{$data.fio}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail :</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" type="text" value="{$data.email}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Дата :</label>
            <div class="col-sm-10">
                <input name="date" id="date" class="form-control" type="text" value="{$data.date}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Отзыв :</label>
            <div class="col-sm-10">
                <textarea name="text" class="tiny">{$data.text}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Изображение (превью): <br /> 280 х 170 - гориз. <br /> 100 х 170 - верт.</label>
            <div class="col-sm-10">
                <input  type="file" name="image" />
                <br /><br />
                <div id="photo">
                    {if $data.ext}
                        <a href="/uploaded/review/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/review/{$data.id}_sm.{$data.ext}" class="photo" /></a>
                        &nbsp;<i onmouseover="this.style.cursor='pointer';" class="fa fa-times" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"></i>
                        <input type="hidden" name="ext" value="{$data.ext}" />
                    {/if}
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
	
		{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name">{$data.name}</textarea></td>
			</tr>
			
			<tr>
				<td>Дата:</td>
				<td><input type="text" name="date" id="date" value="{$data.date}" class="sm" /></td>
			</tr>
			
			<tr>
				<td>Анонс:</td>
				<td>(если анонс новости <b>не указан</b> новость выводиться <b>полностью</b> )<br /><textarea name="anons" class="tiny">{$data.anons}</textarea></td>
			</tr>
			
			<tr>
				<td>Контент:</td>
				<td><textarea name="text" class="tiny">{$data.text}</textarea></td>
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
						{if $data.ext}
							<a href="/uploaded/news/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/news/{$data.id}_sm.{$data.ext}" class="photo" /></a>
							&nbsp;<a href="" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"><img src="/img/admin/del.png" title="Удалить фото" alt="Удалить фото"></a>
							<input type="hidden" name="ext" value="{$data.ext}" />
						{/if}
					</div>
				</td>
			</tr>
			
			<tr>
				<td>Тайтл:</td>
				<td><textarea name="title">{$data.title}</textarea></td>
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
		
{/capture}

{include file="admin/common/base_page.tpl"}