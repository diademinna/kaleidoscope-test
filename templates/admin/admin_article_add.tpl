{capture name="content_name"}
	Статьи / {if $data.name}Редактировать - {$data.name}{else}Добавить{/if}
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
				<td>Анонс:</td>
				<td><textarea name="anons" class="tiny">{$data.anons}</textarea></td>
			</tr>
			
			<tr>
				<td>Контент:</td>
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
					{if $data.ext}
						<a href="/uploaded/article/{$data.id}.{$data.ext}" target="_blank"><img src="/uploaded/article/{$data.id}_sm.{$data.ext}" class="photo" /></a>
						&nbsp;<a href="" onclick="xajax_deleteImage('{$page}', '{$data.id}', '{$get_param}'); return false;"><img src="/img/admin/del.png" title="Удалить фото" alt="Удалить фото"></a>
					{/if}
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
					<input type="hidden" name="ext" value="{$data.ext}" />
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
		
{/capture}

{include file="admin/common/base_page.tpl"}