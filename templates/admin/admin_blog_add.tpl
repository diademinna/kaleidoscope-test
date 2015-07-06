{capture name="content_name"}
	{if $parent_id} {* ПОДРАЗДЕЛ основного раздела *}
		{if $data.name}Редактировать - {$data.name}{else}Добавить {/if}
	{else} {* ОСНОВНОЙ РАЗДЕЛ *}
		Блоги / {if $data.name}Редактировать - {$data.name}{else}Добавить раздел{/if}
	{/if}
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
	
	
	{* MULTI AUTOCOMPLETE *}
	{literal}	
	<script type="text/javascript">
		$(document).ready(function(){	
			function split( val ) {
				return val.split( /,\s*/ );
			}
			function extractLast( term ) {
				return split( term ).pop();
			}
			// don't navigate away from the field on tab when selecting an item
			$("#tag_field")
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "ui-autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength:2,
				source: function( request, response ) {
					var last_term = extractLast(request.term);
					//alert(last_term);
					if(last_term.length>1){
						$.ajax({
							url: "/admin/blog/ajax/autocomplete/",
							async: false,
							data: 'term='+last_term,
							dataType: "json",
							success: function(data){
								response(data);
							}							
						});
					}
				},
				focus: function() {// prevent value inserted on focus
					return false; 
				},
				select: function(event, ui) {
					var terms = split(this.value);
					terms.pop();// remove the current input
					terms.push(ui.item.value);// add the selected item					
					terms.push("");// add placeholder to get the comma-and-space at the end
					this.value = terms.join(", ");
					return false;
				}
			});
		});
	</script>
	{/literal}



	
	<form action="" method="post" enctype="multipart/form-data">
	
		{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name">{$data.name}</textarea></td>
			</tr>
			
			<tr>
				<td>URL {if !$parent_id}раздела{else}{/if}:<br /><span class="alert"><b>(не обязательное)</b></span><br /><span class="alert">(только<br />англ. прописные буквы<br />цифры и подчеркивание)</span></td>
				<td><textarea name="url">{$data.url}</textarea></td>
			</tr>
		
			{if $parent_id} {* 2 уровень *}
				<tr>
					<td>Дата:</td>
					<td><input type="text" name="date" id="date" value="{$data.date}" class="sm" /></td>
				</tr>
				
				<tr>
					<td>Теги:<br />(через зяпятую)</td>
					<td>
						<input type="text" name="tag" value="{$data.tag}" style="width:99%;" id="tag_field" />
					</td>
				</tr>
				
				<tr>
					<td>Анонс:</td>
					<td>{*(если анонс <b>не указан</b> новость блога выводиться <b>полностью</b> )<br />*}<textarea name="anons" class="tiny">{$data.anons}</textarea></td>
				</tr>
				
				<tr class="hidden">
					<td>Контент до галереи:</td>
					<td><textarea name="text" class="tiny">{$data.text}</textarea></td>
				</tr>
				
				<tr class="hidden">
					<td>Контент после галереи:</td>
					<td><textarea name="text2" class="tiny">{$data.text2}</textarea></td>
				</tr>
				
				
				<tr class="hidden">
					<td>Изображение (превью):</td>
					<td>
						<input type="file" name="image" />					
						<select name="type_resize">
							<option value="1">Обрезать края</option>
							<option value="2">Добавлять пустые поля</option>
						</select>
						
						<br /><br />
						<div id="photo">
							{if $data.ext}
								<a href="/uploaded/blog/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/blog/{$data.id}_sm.{$data.ext}" class="photo" /></a>
								&nbsp;<a href="" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"><img src="/img/admin/del.png" title="Удалить фото" alt="Удалить фото"></a>
								<input type="hidden" name="ext" value="{$data.ext}" />
							{/if}
						</div>
					</td>
				</tr>
			{/if}
			
			<tr class="hidden">
				<td>Тайтл <br />(если необходим)</td>
				<td><textarea name="title">{$data.title}</textarea></td>
			</tr>
			
			
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="submitted" value="1" />		
					<input type="hidden" name="parent_id" value="{$parent_id}" />		
					<input type="hidden" name="id" value="{$id}" />		
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
		
{/capture}

{include file="admin/common/base_page.tpl"}