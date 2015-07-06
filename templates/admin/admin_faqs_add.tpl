{capture name="content_name"}
	Вопрос-ответ / {if $data.fio}Редактировать{else}Добавить{/if}
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

	<form action="" method="post" enctype="multipart/form-data">
	
		{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
			<tr>
				<td>Имя:</td>
				<td><textarea name="fio">{$data.fio}</textarea></td>
			</tr>
			
			<tr>
				<td>Вопрос:</td>
				<td><textarea name="question" class="tiny">{$data.question}</textarea></td>
			</tr>
			
			<tr>
				<td>Ответ:<br /><br /></td>
				<td><textarea name="answer" class="tiny" >{$data.answer}</textarea></td>
			</tr>
			
			<tr>
				<td>Дата:</td>
				<td><input type="text" name="date" id="date" value="{$data.date}" class="sm" /></td>
			</tr>
			
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" value="{$data.email}" /></td>
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
{/capture}

{include file="admin/common/base_page.tpl"}