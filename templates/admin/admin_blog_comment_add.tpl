{capture name="content_name"}
	Редактировать - Комментарии блогов
{/capture}

{capture name="content"}
	<form action="" method="post" enctype="multipart/form-data">
	
	{include file="common/errors_block.tpl"}
	
		<table class="edit" width="100%">
			
			<tr>
				<td>Ник:</td>
				<td><textarea name="name">{$data.name}</textarea></td>
			</tr>	
			
			<tr>
				<td>Комментарий:</td>
				<td><textarea name="text">{$data.text}</textarea></td>
			</tr>
			
			<tr>
				<td>Дата:<br />(ГГГГ-ММ-ДД ЧЧ:ММ:СС)</td>
				<td><input type="text" name="date" id="date" value="{$data.date}" style="width:150px;" /></td>
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