{capture name="content_name"}
	Новости
{/capture}

{capture name="content"}

	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены?")){
				top.window.location = "/admin/news/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
	</script>

	
	<table class="list" width="100%">
		<tr class="nobgr">
			<td colspan="4">
				Выводить по : <select name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '{$get_param}');">
									{include file="admin/common/select_count_page.tpl"}
							  </select>
				<br /><br />
			</td>
		</tr>
		
		<tr class="nobgr">
			<td colspan="3"></td>
			<td><a class="add" href="/admin/news/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
		
		<tr class="sh">
			<td>Название</td>
			<td>Дата</td>
			<td>Показывать<br />на сайте</td>
			<td width="80" class="center">Действие</td>
		</tr>
		
		{foreach from=$data item=cur name=loop}
			<tr {if $smarty.foreach.loop.iteration%2==0}class="chet"{/if}>
				<td>{$cur.name}</td>
				<td>{$cur.date|date_format:"%d.%m.%Y"}</td>
				<td width="10%"><input type="checkbox" name="my_checkbox" value="{$cur.active}" {if $cur.active==1}checked{/if} onclick="xajax_Activate('{$cur.id}')" /></td>
				
				<td class="center">
					<a href="/admin/news_photo/add/{$page}/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/photo.png"  title="Галерея" alt="Галерея" /></a> 
					&nbsp;
					<a href="/admin/news/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
					<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"/>
				</td>
			</tr>
		{/foreach}
		
		<tr class="nobgr">
			<td colspan="3"></td>
			<td><a class="add" href="/admin/news/add/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
				
		<tr class="nobgr">
			<td colspan="4">{if $pager_string}<div class="pager">Страницы: {$pager_string}</div>{/if}</td>
		</tr>
		
	</table>
	
{/capture}

{include file="admin/common/base_page.tpl"}