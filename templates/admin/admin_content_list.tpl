{capture name="content_name"}
	Контентные страницы
{/capture}

{capture name="content"}

	<script type="text/javascript" language="JavaScript">
		function deleteRecord(display, id) {
			if(confirm("Вы уверены?")) {
				url = display+""+id+"/delete/";
				top.window.location = url;
			}
		}
	</script>
	
	<table class="list" width="100%">
	
		<tr class="nobgr">
			<td colspan="2"></td>
			<td><a class="add" href="/admin/content/add/">Добавить</a></td>
		</tr>
		
		<tr class="sh">
			<td>URL (путь)</td>
			<td>Название</td>
			<td width="80" class="center">Действие</td>
		</tr>
		{foreach from=$data item="item" name=loop}
			<tr {if $smarty.foreach.loop.iteration%2==0}class="chet"{/if}>
				<td><a href="/content/{$item.url}/" target="_blank">/content/{$item.url}/</a></td>
				<td>{$item.name}</td>
				<td class="center">
					<a href="/admin/content/add/{$item.id}/edit/"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
					<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="deleteRecord('/admin/content/list/', '{$item.id}');"   onmouseover="this.style.cursor='pointer';"/>
				</td>
			</tr>
		{/foreach}
		
		<tr class="nobgr">
			<td colspan="2"></td>
			<td><a class="add" href="/admin/content/add/">Добавить</a></td>
		</tr>
		
	</table>
	
{/capture}

{include file="admin/common/base_page.tpl"}