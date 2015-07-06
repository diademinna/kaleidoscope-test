{capture name="content_name"}
	Обратная связь (сообщения)
{/capture}

{capture name="content"}

	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")) {
				top.window.location = "/admin/callback_user/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
	</script>

	
	<table class="list" width="100%">
		<tr class="nobgr">
			<td colspan="6">
				Выводить по : <select name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '{$get_param}');">
									{include file="admin/common/select_count_page.tpl"}
							  </select>
				<br /><br />
			</td>
		</tr>
		
		<tr class="sh">
			<td>ФИО</td>
			<td>Телефон</td>
			<td>Email</td>
			<td>Дата</td>
			<td>Сообщение</td>
			<td width="50" class="center">Действие</td>
		</tr>
		
		{foreach from=$data item=cur name=loop}
			<tr {if $smarty.foreach.loop.iteration%2==0}class="chet"{/if}>
				<td>{$cur.fio}</td>
				<td>{$cur.tel}</td>
				<td>{if $cur.email}{$cur.email}{/if}</td>
				<td>{$cur.date|date_format:"%d-%m-%Y"} </td>
				<td>{if $cur.text}{$cur.text}{else}-{/if}</td>				
				
				<td class="center">					
					<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"/>
				</td>
			</tr>
		{/foreach}
						
		<tr class="nobgr">
			<td colspan="6">{if $pager_string}<div class="pager">Страницы: {$pager_string}</div>{/if}</td>
		</tr>
		
	</table>
	
{/capture}

{include file="admin/common/base_page.tpl"}