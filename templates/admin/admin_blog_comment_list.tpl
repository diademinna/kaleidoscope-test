{capture name="content_name"}
	Комментарии блогов
{/capture}

{capture name="content"}
	<script type="text/javascript">
		function delRecord(page, id, get_param){
			if(confirm("Вы уверены? Если вы удалите комментарий на который ответили, то они тоже удалятся!")) {
				top.window.location = "/admin/blog_comment/list/"+page+"/delete/"+id+"/"+get_param;
			}
		}
	</script>
	
	<table class="list" width="100%">
	
		<tr class="nobgr">
			<td colspan="7">
				Выводить по : <select name="select_count_page" onchange="xajax_ChangeCountPage(this.value, '{$get_param}');">
									{include file="admin/common/select_count_page.tpl"}
							  </select>
				<br /><br />
			</td>
		</tr>
		
		{*
		<tr class="nobgr">
			<td colspan="6"></td>
			<td><a class="add" href="/admin/blog_comment/add/{$page}/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
		*}
		
		<tr class="sh">
			<td>Дата</td>
			<td>Ник</td>
			<td>Сообщение</td>
			<td>Блог</td>
			<td width="80" class="center">Действие</td>
		</tr>
		{foreach from=$data item=cur name=loop}
			{assign var="cur_blog_parent_id" value=$cur.blog_parent_id}
			<tr {if $smarty.foreach.loop.iteration%2==0}class="chet"{/if}>
				<td>{$cur.date|date_format:"%d-%m-%Y"} <br /><span style="font-size:10px; color:#888;">{$cur.date|date_format:"%H:%M:%S"}</span></td>
				<td>{$cur.name}</td>				
				<td>{$cur.text}</td>
				<td><a href="/blog/{$data_blog_1ur.$cur_blog_parent_id.url}/{$cur.blog_url}/" target="_blank" style="font-size:10px;">{$cur.blog_name}</a></td>
				<td class="center">
					<a href="/admin/blog_comment/add/{$page}/edit/{$cur.id}/{if $get_param}{$get_param}{/if}"><img src="/img/admin/edit.png"  title="Редактировать" alt="Редактировать" /></a>
					<img src="/img/admin/del.png" title="Удалить" alt="Удалить" onclick="delRecord('{$page}', '{$cur.id}', '{$get_param}');" onmouseover="this.style.cursor='pointer';"/>
				</td>
			</tr>
		{/foreach}
		
		{*
		<tr class="nobgr">
			<td colspan="6"></td>
			<td><a class="add" href="/admin/blog_comment/add/{$page}/{if $get_param}{$get_param}{/if}">Добавить</a></td>
		</tr>
		*}
		
		<tr class="nobgr">
			<td colspan="7">{if $pager_string}<div class="pager">Страницы: {$pager_string}</div>{/if}</td>
		</tr>
	</table>
{/capture}

{include file="admin/common/base_page.tpl"}