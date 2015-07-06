{capture name="content_name"}
	Редактировать - {$data.name}
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
				<td>Контент:</td>
				<td><textarea name="text" class="tiny">{$data.text}</textarea></td>
			</tr>
			
			<tr>
				<td>Тайтл:</td>
				<td><textarea name="title">{$data.title}</textarea></td>
			</tr>
			
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="id" value="{$data.id}"/>
					<input type="hidden" name="submitted" value="1"/>
					<input type="image" src="/img/admin/btn_send.png" name="submit" class="submit">
				</td>
			</tr>
		</table>
	</form>
{/capture}

{include file="admin/common/base_page.tpl"}