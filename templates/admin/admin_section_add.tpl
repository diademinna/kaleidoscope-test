{capture name="content_name"}
	{if $parent_id} {* ПОДРАЗДЕЛ основного раздела *}
		{if $data.name}Редактировать - {$data.name}{else}Добавить {/if}
	{else} {* ОСНОВНОЙ РАЗДЕЛ *}
		Разделы сайта / {if $data.name}Редактировать - {$data.name}{else}Добавить раздел{/if}
	{/if}
{/capture}


{capture name="content"}
	
	
	<script type="text/javascript">
		function changeFlagNosection(){ // при нажатии на чекбокс
			if($("#flag_nosection").prop("checked")){ // у раздела нет подразделов
				$('.hidden').fadeIn();
			}
			else{ // стандартно с подразделами.
				$('.hidden').fadeOut();
			}
		}
	</script>
	

	<form action="" method="post" enctype="multipart/form-data">
	
		{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name">{$data.name}</textarea></td>
			</tr>
			
			<tr>
				<td>URL {if !$parent_id}раздела{else}подраздела{/if}:<br /><span class="alert"><b>(не обязательное)</b></span><br /><span class="alert">(только<br />англ. прописные буквы<br />цифры и подчеркивание)</span></td>
				<td><textarea name="url">{$data.url}</textarea></td>
			</tr>
			
			
			<tr>
				<td></td>
				<td>
					{if !$parent_id} {* ЕСЛИ нет ПОДРАЗДЕЛА основного раздела *}
						<div class="alert"><br /><b>Данный раздел будет без подразделов. <input type="checkbox" onclick="changeFlagNosection();" id="flag_nosection" name="flag_nosection" class="checkbox" value="1" {if $data.flag_nosection==1}checked{/if} /></b></div>
					{/if}
				</td>
			</tr>
			
			
			<tr class="hidden" {if !$data.flag_nosection AND !$parent_id}style="display:none;"{/if}>
				<td>Контент:</td>
				<td><textarea name="text" class="tiny">{$data.text}</textarea></td>
			</tr>

			<tr class="hidden" {if !$data.flag_nosection AND !$parent_id}style="display:none;"{/if}>
				<td>Изображение (превью)<br />(если необходимо):</td>
				<td>				
					<input type="file" name="image" />					
					<select name="type_resize">
						<option value="1">Обрезать края</option>
						<option value="2">Добавлять пустые поля</option>
					</select>

					<br /><br />
					<div id="photo">
						{if $data.ext}
							<a href="/uploaded/section/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/section/{$data.id}_sm.{$data.ext}" class="photo" /></a>
							&nbsp;<a href="" onclick="if(confirm('Вы уверены?')) xajax_deleteImage('{$data.id}'); return false;"><img src="/img/admin/del.png" title="Удалить фото" alt="Удалить фото"></a>
							<input type="hidden" name="ext" value="{$data.ext}" />
						{/if}
					</div>
				</td>
			</tr>

			<tr class="hidden" {if !$data.flag_nosection AND !$parent_id}style="display:none;"{/if}>
				<td>Тайтл <br />(если необходим)</td>
				<td><textarea name="title">{$data.title}</textarea></td>
			</tr>
			
			
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="submitted" value="1" />		
					<input type="hidden" name="parent_id" value="{$parent_id}" />		
					<input type="hidden" name="id_section" value="{$id_section}" />		
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
		
{/capture}

{include file="admin/common/base_page.tpl"}