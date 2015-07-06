{capture name="content"}
	<h1>Обратная связь</h1>
	
	{if $errors}{include file="common/errors_block.tpl"}{/if}
	{if $notes}{include file="common/notify_block.tpl"}{/if}
	
	<form action="" name="feedback" method="POST">
	
	<table class="forma">
		<tr>
			<td colspan="2"><i>Поля, помеченные знаком <span class="red">*</span>, являются обязательными для заполнения.</i><br /></td>
		</tr>
		
		<tr>
			<td>ФИО: <span class="red">*</span></td>
			<td><input type="text" name="fio" value="{$fio}" class="content_input" /></td>
		</tr>
		<tr>
			<td>Телефон: </td>
			<td><input type="text" name="phone" value="{$phone}" class="content_input" /></td>
		</tr>
		<tr>
			<td>Эл. почта: </td>
			<td><input type="text" name="email" value="{$email}" class="content_input" /></td>
		</tr>
		<tr>
			<td>Сообщение: <span class="red">*</span></td>
			<td><textarea rows="5" name="message" scrolling="no" class="content_input">{$message}</textarea></td>
		</tr>
		<tr>
			<td>Код подтверждения: <span class="red">*</span></td>
			<td><img src="/kcaptcha/" />  <br>   <input type="text" name="kcaptcha" /></td>
		</tr>
		
		<tr>
			<td></td>
			<td>				
				<input type="hidden" name="submitted" value="1"/>
				<input type="image" src="/img/btn_send.png" name="submit">
			</td>
		</tr>
	</table>
	
	</form>
{/capture}

{include file="common/base_page.tpl"}