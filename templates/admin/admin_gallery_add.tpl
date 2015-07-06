{capture name="content_name"}
	Галерея / {if $data.name}Редактировать - {$data.name}{else}Добавить{/if}
{/capture}


{capture name="content"}

	<form action="" method="post" enctype="multipart/form-data">
	
		{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
			<tr>
				<td>Название:</td>
				<td><textarea name="name">{$data.name}</textarea></td>
			</tr>
			
			<tr>
				<td>Контент
					<br />(если необходим):</td>
				<td><textarea name="text" class="tiny">{$data.text}</textarea></td>
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
						{if $data.ext}
							<a href="/uploaded/gallery/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/gallery/{$data.id}_sm.{$data.ext}" class="photo" /></a>
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
		
{/capture}

{include file="admin/common/base_page.tpl"}